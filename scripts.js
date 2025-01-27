// Inicializar tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Animações de entrada
    document.querySelectorAll('.card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100 * index);
    });

    // Animações de hover nos cards
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.card').style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.closest('.card').style.transform = 'scale(1)';
        });
    });

    // Mascote interativo
    const mascote = document.getElementById('mascote');
    if (mascote) {
        mascote.addEventListener('click', () => mostrarAssistente());

        // Animação do mascote ao passar o mouse
        mascote.addEventListener('mouseover', () => {
            mascote.style.transform = 'scale(1.1) rotate(5deg)';
        });

        mascote.addEventListener('mouseout', () => {
            mascote.style.transform = 'scale(1) rotate(0deg)';
        });
    }

    // Adicionar botão flutuante do assistente
    const assistantButton = document.createElement('div');
    assistantButton.className = 'assistant-button';
    assistantButton.innerHTML = `
        <img src="https://cdn-icons-png.flaticon.com/512/3774/3774299.png" alt="Assistente">
        <span class="assistant-tooltip">Precisa de ajuda?</span>
    `;
    assistantButton.onclick = () => mostrarAssistente();
    document.body.appendChild(assistantButton);

    // Evento para busca ao pressionar Enter
    $('input[name="busca"]').keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            $(this).closest('form').submit();
        }
    });

    // Adicionar créditos do desenvolvedor
    const credits = document.createElement('div');
    credits.className = 'developer-credits';
    credits.innerHTML = 'Desenvolvido por Cleuton Messias';
    document.body.appendChild(credits);
});

// Funções auxiliares
function mostrarLoading() {
    const overlay = document.querySelector('.loading-overlay');
    if (overlay) {
        overlay.style.display = 'flex';
        setTimeout(() => {
            overlay.style.opacity = '1';
        }, 10);
    }
}

function esconderLoading() {
    const overlay = document.querySelector('.loading-overlay');
    if (overlay) {
        overlay.style.opacity = '0';
        setTimeout(() => {
            overlay.style.display = 'none';
        }, 300);
    }
}

function mostrarAjuda() {
    Swal.fire({
        title: 'Como usar o PediCalc',
        html: `
            <div class="text-start">
                <h5 class="mb-3">🔍 Busca por Medicamentos:</h5>
                <p><i class="fas fa-pills me-2"></i> Digite o nome do medicamento na barra de busca</p>
                <p><i class="fas fa-weight me-2"></i> Informe o peso da criança em kg</p>
                <p><i class="fas fa-calculator me-2"></i> Clique em calcular para gerar a prescrição</p>

                <h5 class="mt-4 mb-3">📋 Prescrições por Doença:</h5>
                <p><i class="fas fa-list me-2"></i> Selecione um grupo de doenças no menu</p>
                <p><i class="fas fa-stethoscope me-2"></i> Escolha a condição específica</p>
                <p><i class="fas fa-child me-2"></i> Informe idade e peso da criança</p>

                <h5 class="mt-4 mb-3">📝 Gerenciamento da Prescrição:</h5>
                <p><i class="fas fa-edit me-2"></i> Revise a prescrição gerada</p>
                <p><i class="fas fa-copy me-2"></i> Copie para a área de transferência</p>
                <p><i class="fas fa-print me-2"></i> Imprima a prescrição final</p>

                <div class="alert alert-info mt-4">
                    <i class="fas fa-info-circle me-2"></i>
                    Todas as prescrições incluem automaticamente data, observações importantes e recomendações de uso.
                </div>
            </div>
        `,
        icon: 'info',
        confirmButtonColor: '#FF6B6B',
        confirmButtonText: 'Entendi!',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    });
}

// Animações de números
function animarNumeros() {
    document.querySelectorAll('.animate-number').forEach(element => {
        const final = parseInt(element.getAttribute('data-final'));
        const duration = 1000; // 1 segundo
        const start = Date.now();
        
        const timer = setInterval(() => {
            const timePassed = Date.now() - start;
            const progress = timePassed / duration;
            
            if (progress > 1) {
                element.textContent = final;
                clearInterval(timer);
            } else {
                const current = Math.floor(progress * final);
                element.textContent = current;
            }
        }, 20);
    });
}

// Funções de busca e prescrição
function buscarDoencas(grupo) {
    if (!grupo) return;
    
    mostrarLoading();
    
    $.post('buscar_doencas.php', {grupo: grupo}, function(data) {
        esconderLoading();
        
        // Animar a saída do conteúdo atual
        const resultadoDoencas = $('#resultado-doencas');
        const resultadoMedicamentos = $('#resultado');
        
        resultadoDoencas.fadeOut(300, function() {
            resultadoDoencas.html(data).fadeIn(300);
            
            // Adicionar animação de entrada para cada linha da tabela
            resultadoDoencas.find('tr').each(function(index) {
                $(this).css({
                    opacity: 0,
                    transform: 'translateX(-20px)'
                });
                setTimeout(() => {
                    $(this).css({
                        transition: 'all 0.3s ease',
                        opacity: 1,
                        transform: 'translateX(0)'
                    });
                }, 100 * index);
            });
        });
        
        resultadoMedicamentos.fadeOut(300);
    });
}

function gerarPrescricaoPadrao(doenca) {
    Swal.fire({
        title: 'Dados do Paciente',
        html: `
            <div class="mb-3">
                <label class="form-label">Idade</label>
                <input type="text" id="idade" class="form-control" placeholder="Ex: 2 anos e 3 meses">
            </div>
            <div class="mb-3">
                <label class="form-label">Peso (kg)</label>
                <input type="number" id="peso" class="form-control" placeholder="Ex: 12.5" step="0.1">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Gerar Prescrição',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#4ECDC4',
        cancelButtonColor: '#FF6B6B',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const idade = document.getElementById('idade').value;
            const peso = document.getElementById('peso').value;
            if (!idade || !peso) {
                Swal.showValidationMessage('Por favor, preencha todos os campos');
                return false;
            }
            return { idade: idade, peso: peso }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            mostrarLoading();
            $.post('gerar_prescricao.php', {
                doenca: doenca,
                idade: result.value.idade,
                peso: result.value.peso
            }, function(response) {
                esconderLoading();
                $('.prescricao').html(response).show();
                
                // Scroll suave até a prescrição
                $('html, body').animate({
                    scrollTop: $('.prescricao').offset().top - 100
                }, 500);
                
                // Adicionar botões de ação
                $('.prescricao').append(`
                    <div class="mt-4">
                        <div class="d-flex justify-content-center gap-4">
                            <button class="btn btn-primary btn-lg action-button" onclick="copiarPrescricao()">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-copy fa-2x mb-2"></i>
                                    <span>Copiar</span>
                                </div>
                            </button>
                            <button class="btn btn-success btn-lg action-button" onclick="imprimirPrescricao()">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-print fa-2x mb-2"></i>
                                    <span>Imprimir</span>
                                </div>
                            </button>
                            <button class="btn btn-outline-primary btn-lg action-button" onclick="novaPrescricao()">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-plus fa-2x mb-2"></i>
                                    <span>Nova</span>
                                </div>
                            </button>
                        </div>
                        <div class="text-center mt-4">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Clique em Copiar para salvar a prescrição na área de transferência ou em Imprimir para gerar uma versão para impressão
                            </small>
                        </div>
                    </div>
                `);

                // Adicionar estilos específicos para os botões de ação
                const actionButtonStyles = document.createElement('style');
                actionButtonStyles.textContent = `
                    .action-button {
                        min-width: 120px;
                        padding: 15px 25px;
                        border-radius: 15px;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                    }

                    .action-button:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
                    }

                    .action-button i {
                        transition: transform 0.3s ease;
                    }

                    .action-button:hover i {
                        transform: scale(1.2);
                    }

                    .btn-primary.action-button {
                        background: linear-gradient(45deg, #4ECDC4, #45B7AF);
                        border: none;
                    }

                    .btn-success.action-button {
                        background: linear-gradient(45deg, #2ECC71, #27AE60);
                        border: none;
                    }

                    .btn-outline-primary.action-button {
                        border: 2px solid #4ECDC4;
                        color: #4ECDC4;
                    }

                    .btn-outline-primary.action-button:hover {
                        background: linear-gradient(45deg, #4ECDC4, #45B7AF);
                        color: white;
                    }

                    @media (max-width: 768px) {
                        .action-button {
                            min-width: 100px;
                            padding: 10px 20px;
                        }

                        .action-button i {
                            font-size: 1.5em;
                        }
                    }
                `;
                document.head.appendChild(actionButtonStyles);
            });
        }
    });
}

function copiarPrescricao() {
    const prescricao = document.querySelector('.prescricao').innerText;
    navigator.clipboard.writeText(prescricao).then(() => {
        Swal.fire({
            title: 'Sucesso!',
            text: 'Prescrição copiada para a área de transferência',
            icon: 'success',
            confirmButtonColor: '#4ECDC4'
        });
    }).catch(() => {
        Swal.fire({
            title: 'Erro!',
            text: 'Não foi possível copiar a prescrição',
            icon: 'error',
            confirmButtonColor: '#FF6B6B'
        });
    });
}

function imprimirPrescricao() {
    window.print();
}

function novaPrescricao() {
    $('.prescricao').fadeOut(300, function() {
        $(this).empty();
        window.location.reload();
    });
}

// Assistente Virtual
const assistenteVirtual = {
    nome: 'Dr. Pedi',
    mensagens: {
        boasVindas: 'Olá! Eu sou o Dr. Pedi, seu assistente virtual! 👋 Como posso ajudar você hoje?',
        opcoes: [
            {
                titulo: '🔍 Buscar Medicamentos',
                descricao: 'Ajudo você a encontrar e calcular doses de medicamentos',
                acao: 'buscarMed'
            },
            {
                titulo: '📋 Prescrições por Doença',
                descricao: 'Posso gerar prescrições baseadas em condições específicas',
                acao: 'prescricaoDoenca'
            },
            {
                titulo: '❓ Dúvidas Frequentes',
                descricao: 'Esclareço suas principais dúvidas sobre o sistema',
                acao: 'duvidas'
            },
            {
                titulo: '📝 Tutorial Completo',
                descricao: 'Mostro um passo a passo detalhado do sistema',
                acao: 'tutorial'
            }
        ],
        ajudaMedicamentos: 'Para buscar um medicamento, digite o nome na barra de busca. Vou te ajudar a encontrar a dose correta! 💊',
        ajudaDoencas: 'Selecione um grupo de doenças no menu e depois escolha a condição específica. Vou te ajudar com a prescrição! 🏥',
        duvidasFrequentes: [
            {
                pergunta: 'Como calcular a dose correta?',
                resposta: 'Digite o peso da criança em kg e eu farei o cálculo automaticamente, seguindo protocolos pediátricos.'
            },
            {
                pergunta: 'As prescrições são seguras?',
                resposta: 'Sim! Todas as doses são calculadas seguindo diretrizes médicas e protocolos estabelecidos.'
            },
            {
                pergunta: 'Posso imprimir a prescrição?',
                resposta: 'Sim! Após gerar a prescrição, clique no botão de impressão ou copie para a área de transferência.'
            }
        ]
    }
};

function mostrarAssistente(primeiraVez = false) {
    Swal.fire({
        title: `<div class="d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3774/3774299.png" width="50" class="me-3">
                    <span>${assistenteVirtual.nome}</span>
                </div>`,
        html: `<div class="assistant-message">
                ${assistenteVirtual.mensagens.boasVindas}
                <div class="options-grid mt-4">
                    ${assistenteVirtual.mensagens.opcoes.map(opcao => `
                        <div class="option-card" onclick="handleAssistantOption('${opcao.acao}')">
                            <h3>${opcao.titulo}</h3>
                            <p>${opcao.descricao}</p>
                        </div>
                    `).join('')}
                </div>
              </div>`,
        showCloseButton: true,
        showConfirmButton: false,
        customClass: {
            popup: 'assistant-popup',
            closeButton: 'assistant-close'
        },
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    });
}

function handleAssistantOption(acao) {
    switch(acao) {
        case 'buscarMed':
            Swal.fire({
                title: 'Busca de Medicamentos',
                html: assistenteVirtual.mensagens.ajudaMedicamentos,
                icon: 'info',
                confirmButtonText: 'Entendi!',
                confirmButtonColor: '#FF6B6B'
            });
            break;
        case 'prescricaoDoenca':
            Swal.fire({
                title: 'Prescrições por Doença',
                html: assistenteVirtual.mensagens.ajudaDoencas,
                icon: 'info',
                confirmButtonText: 'Entendi!',
                confirmButtonColor: '#FF6B6B'
            });
            break;
        case 'duvidas':
            Swal.fire({
                title: 'Dúvidas Frequentes',
                html: `<div class="faq-container">
                    ${assistenteVirtual.mensagens.duvidasFrequentes.map(duvida => `
                        <div class="faq-item">
                            <h4>❓ ${duvida.pergunta}</h4>
                            <p>💡 ${duvida.resposta}</p>
                        </div>
                    `).join('')}
                </div>`,
                confirmButtonText: 'Entendi!',
                confirmButtonColor: '#FF6B6B',
                width: '600px'
            });
            break;
        case 'tutorial':
            mostrarAjuda();
            break;
    }
}

// Estilo para o assistente
const style = document.createElement('style');
style.textContent = `
    .assistant-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background: #FF6B6B;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .assistant-button img {
        width: 35px;
        height: 35px;
        transition: transform 0.3s ease;
    }

    .assistant-button:hover {
        transform: scale(1.1);
    }

    .assistant-button:hover img {
        transform: rotate(10deg);
    }

    .assistant-tooltip {
        position: absolute;
        right: 70px;
        background: #FF6B6B;
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 14px;
        opacity: 0;
        transition: opacity 0.3s ease;
        white-space: nowrap;
    }

    .assistant-button:hover .assistant-tooltip {
        opacity: 1;
    }

    .assistant-popup {
        border-radius: 20px;
        padding: 20px;
    }

    .options-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 20px;
    }

    .option-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #FF6B6B;
    }

    .option-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .option-card h3 {
        font-size: 16px;
        margin-bottom: 8px;
        color: #FF6B6B;
    }

    .option-card p {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    .faq-container {
        text-align: left;
    }

    .faq-item {
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .faq-item h4 {
        color: #FF6B6B;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .faq-item p {
        color: #666;
        margin: 0;
    }

    .assistant-message {
        font-size: 16px;
        line-height: 1.5;
    }

    .developer-credits {
        position: fixed;
        bottom: 10px;
        left: 10px;
        font-size: 14px;
        color: #666;
        padding: 5px 10px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        z-index: 1000;
    }

    .developer-credits:hover {
        color: #FF6B6B;
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        .prescricao, .prescricao * {
            visibility: visible;
        }
        .prescricao {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .prescricao button {
            display: none;
        }
    }
`;

document.head.appendChild(style); 