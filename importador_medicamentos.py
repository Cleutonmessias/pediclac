import mysql.connector
import pandas as pd
import requests
from bs4 import BeautifulSoup
import re
from typing import Dict, List
import json

class MedicamentosPediatricos:
    def __init__(self):
        self.conn = self.conectar_banco()
        self.cursor = self.conn.cursor()
        
        # Carregar regras de classificação
        self.regras_categorias = self.carregar_regras_categorias()
        
    def conectar_banco(self):
        return mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="medicamentos_pediatricos"
        )

    def carregar_regras_categorias(self) -> Dict[str, List[str]]:
        return {
            'Analgésicos/Antitérmicos': ['paracetamol', 'dipirona', 'ibuprofeno', 'acetaminofeno'],
            'Antibióticos': ['amoxicilina', 'cefalexina', 'azitromicina', 'penicilina'],
            'Anti-histamínicos': ['loratadina', 'dexclorfeniramina', 'prometazina'],
            'Antieméticos': ['ondansetrona', 'metoclopramida', 'domperidona'],
            'Broncodilatadores': ['salbutamol', 'fenoterol', 'terbutalina'],
            'Corticosteroides': ['prednisolona', 'dexametasona', 'betametasona'],
            'Vitaminas': ['vitamina', 'polivitamínico', 'ácido fólico'],
            'Antiparasitários': ['albendazol', 'mebendazol', 'ivermectina'],
            'Antitussígenos': ['dextrometorfano', 'levodropropizina'],
            'Probióticos': ['probiótico', 'lactobacillus']
        }

    def identificar_categoria(self, principio_ativo: str) -> int:
        principio_ativo = principio_ativo.lower()
        for categoria, keywords in self.regras_categorias.items():
            if any(keyword in principio_ativo for keyword in keywords):
                # Buscar ID da categoria
                self.cursor.execute("SELECT id FROM categorias_terapeuticas WHERE nome = %s", (categoria,))
                resultado = self.cursor.fetchone()
                if resultado:
                    return resultado[0]
        return None

    def validar_medicamento(self, row: pd.Series) -> bool:
        # Validações básicas
        if not row['Código CATMAT'] or not row['Princípio Ativo']:
            return False
            
        # Validar formato do código CATMAT
        if not re.match(r'BR\d{6}', str(row['Código CATMAT'])):
            return False
            
        return True

    def determinar_uso_pediatrico(self, row: pd.Series) -> tuple:
        principio_ativo = str(row['Princípio Ativo']).lower()
        forma = str(row['Forma Farmacêutica']).lower()
        concentracao = str(row['Concentração']).lower()
        
        # Regras expandidas para uso pediátrico
        regras_pediatricas = {
            'formas': ['xarope', 'suspensão', 'solução oral', 'gotas', 'suspensão oral'],
            'palavras_chave': ['infantil', 'pediátric', 'criança', 'bebê', 'lactente'],
            'concentracoes_pediatricas': ['mg/ml', 'mg/5ml', 'mg/gotas']
        }
        
        uso_pediatrico = False
        idade_minima = None
        idade_maxima = None
        peso_minimo = None
        peso_maximo = None
        
        # Verificar formas farmacêuticas apropriadas
        if any(forma_ped in forma for forma_ped in regras_pediatricas['formas']):
            uso_pediatrico = True
            idade_minima = 0
            idade_maxima = 144  # 12 anos em meses
            
        # Verificar palavras-chave
        if any(palavra in principio_ativo for palavra in regras_pediatricas['palavras_chave']):
            uso_pediatrico = True
            
        # Verificar concentrações típicas pediátricas
        if any(conc in concentracao for conc in regras_pediatricas['concentracoes_pediatricas']):
            uso_pediatrico = True
            
        # Extrair informações de idade/peso se disponíveis
        idade_match = re.search(r'(\d+)\s*(?:mese?s?|ano?s?)', principio_ativo)
        if idade_match:
            idade = int(idade_match.group(1))
            if 'ano' in idade_match.group():
                idade *= 12
            idade_minima = 0
            idade_maxima = idade
            
        peso_match = re.search(r'(\d+)\s*(?:kg|quilo)', principio_ativo)
        if peso_match:
            peso = float(peso_match.group(1))
            peso_minimo = 0
            peso_maximo = peso
            
        return uso_pediatrico, idade_minima, idade_maxima, peso_minimo, peso_maximo

    def extrair_dados_catmat(self):
        url = "https://integracao.esusab.ufsc.br/ledi/documentacao/referencias/tabela_catmat.html"
        
        try:
            response = requests.get(url)
            soup = BeautifulSoup(response.text, 'html.parser')
            table = soup.find('table')
            
            headers = []
            for th in table.find_all('th'):
                headers.append(th.text.strip())
            
            rows = []
            for tr in table.find_all('tr')[1:]:
                row = []
                for td in tr.find_all('td'):
                    row.append(td.text.strip())
                if len(row) == len(headers):
                    rows.append(row)
            
            return pd.DataFrame(rows, columns=headers)
            
        except Exception as e:
            print(f"Erro ao extrair dados CATMAT: {str(e)}")
            return None

    def extrair_dados_anvisa(self):
        # Simulação de dados da ANVISA (em um projeto real, seria necessário implementar a API real)
        try:
            # Aqui você implementaria a chamada real à API da ANVISA
            print("Extraindo dados complementares da ANVISA...")
            return None
        except Exception as e:
            print(f"Erro ao extrair dados ANVISA: {str(e)}")
            return None

    def inserir_medicamento(self, row: pd.Series):
        if not self.validar_medicamento(row):
            print(f"Medicamento inválido: {row['Código CATMAT']}")
            return None
            
        uso_pediatrico, idade_min, idade_max, peso_min, peso_max = self.determinar_uso_pediatrico(row)
        categoria_id = self.identificar_categoria(row['Princípio Ativo'])
        
        sql = """
        INSERT INTO medicamentos 
        (codigo_catmat, principio_ativo, concentracao, forma_farmaceutica, 
         unidade_fornecimento, uso_pediatrico, categoria_id, idade_minima_meses,
         idade_maxima_meses, peso_minimo, peso_maximo, fonte_dados)
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
        """
        
        values = (
            str(row['Código CATMAT']),
            str(row['Princípio Ativo']),
            str(row['Concentração']),
            str(row['Forma Farmacêutica']),
            str(row['Unidade de Fornecimento']),
            uso_pediatrico,
            categoria_id,
            idade_min,
            idade_max,
            peso_min,
            peso_max,
            'CATMAT'
        )
        
        try:
            self.cursor.execute(sql, values)
            return self.cursor.lastrowid
        except mysql.connector.Error as err:
            print(f"Erro ao inserir medicamento {row['Código CATMAT']}: {err}")
            return None

    def processar_dados(self):
        # Extrair dados das diferentes fontes
        df_catmat = self.extrair_dados_catmat()
        df_anvisa = self.extrair_dados_anvisa()
        
        if df_catmat is not None:
            total = len(df_catmat)
            print(f"Processando {total} medicamentos...")
            
            for index, row in df_catmat.iterrows():
                medicamento_id = self.inserir_medicamento(row)
                if medicamento_id:
                    print(f"Progresso: {index+1}/{total} - Inserido: {row['Princípio Ativo']}")
            
            self.conn.commit()
            print("Importação concluída com sucesso!")
        
        self.cursor.close()
        self.conn.close()

def main():
    importador = MedicamentosPediatricos()
    importador.processar_dados()

if __name__ == "__main__":
    main() 