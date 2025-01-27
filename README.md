# PediCalc - Calculadora de Medicamentos Pediátricos 👶💊

Sistema web para cálculo de doses pediátricas e geração de prescrições médicas de forma rápida e segura.

## 🌟 Funcionalidades

- Cálculo automático de doses baseado no peso da criança
- Prescrições padronizadas para diversas condições pediátricas
- Interface amigável e intuitiva
- Categorização de doenças por especialidade
- Sistema de busca de medicamentos
- Geração de prescrições em formato imprimível
- Suporte a múltiplas condições médicas

## 🔧 Tecnologias Utilizadas

- PHP 7.4+
- MySQL 5.7+
- HTML5
- CSS3
- JavaScript
- Bootstrap 5
- jQuery
- Font Awesome
- SweetAlert2

## 📋 Pré-requisitos

- Servidor web (Apache/Nginx)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Composer (para gerenciamento de dependências)

## 🚀 Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/pedicalc.git
```

2. Importe o banco de dados:
```bash
mysql -u seu_usuario -p nome_do_banco < database/medicamentos_pediatricos.sql
```

3. Configure o arquivo de conexão:
```php
// config.php
$db_config = [
    'host' => 'localhost',
    'user' => 'seu_usuario',
    'pass' => 'sua_senha',
    'db'   => 'medicamentos_pediatricos'
];
```

4. Inicie o servidor local:
```bash
php -S localhost:8000
```

## 📁 Estrutura do Projeto

```
pedicalc/
├── assets/
│   ├── css/
│   │   └── styles.css
│   ├── js/
│   │   └── scripts.js
│   └── img/
├── database/
│   └── medicamentos_pediatricos.sql
├── includes/
│   ├── config.php
│   └── calculos.php
├── index.php
├── buscar_doencas.php
├── gerar_prescricao.php
└── README.md
```

## 🎯 Categorias de Doenças

- Infecções Respiratórias
- Doenças Gastrointestinais
- Condições Dermatológicas
- Problemas Neurológicos
- Doenças Infecciosas e Febris
- Condições Ortopédicas e Traumáticas
- Outras Condições Pediátricas

## 🔒 Segurança

- Validação de dados de entrada
- Proteção contra SQL Injection
- Sanitização de saída
- Controle de acesso básico

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## ✨ Contribuição

1. Faça um Fork do projeto
2. Crie uma Branch para sua Feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a Branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 👥 Autores

* **Cleuton Messias** - *Desenvolvimento Inicial* - [GitHub](https://github.com/seu-usuario)

## 📧 Contato

Cleuton Messias - cleuton.messias@email.com

Link do projeto: [https://github.com/seu-usuario/pedicalc](https://github.com/seu-usuario/pedicalc)

## 🙏 Agradecimentos

* Equipe médica consultora
* Comunidade de desenvolvedores
* Todos os contribuidores do projeto 