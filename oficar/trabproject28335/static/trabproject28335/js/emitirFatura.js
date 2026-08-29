document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. GESTÃO DO UTILIZADOR (DROPDOWN) ---
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');
    
    if (userIcon && userDropdown) {
        userIcon.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
        
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && e.target !== userIcon) {
                userDropdown.classList.remove('show');
            }
        });
    }

    // --- 2. CONFIGURAÇÕES INICIAIS ---
    const dataEmissaoInput = document.getElementById('dataEmissao');
    if (dataEmissaoInput) {
        const hoje = new Date().toISOString().split('T')[0];
        dataEmissaoInput.value = hoje;
    }

    // --- 3. MAPEAMENTO DE CAMPOS ---
    const campos = {
        cliente: document.getElementById('clienteNome'),
        veiculo: document.getElementById('veiculo'),
        data: document.getElementById('dataAbertura'),
        funcionario: document.getElementById('funcionario'),
        listaServicos: document.getElementById('listaServicos'),
        listaPecas: document.getElementById('listaPecas'),
        subtotal: document.getElementById('faturaSubtotal'),
        total: document.getElementById('faturaTotal')
    };

    // --- 4. BUSCA AUTOMÁTICA DA OS ---
    const inputOS = document.getElementById('inputOS');
    if (inputOS) {
        inputOS.addEventListener('input', function() {
            const osId = this.value.trim();
            if (osId.length > 0) {
                fetch(`/buscar-os/${osId}/`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.sucesso) {
                            preencherInterface(data.dados);
                        } else {
                            resetInterface("OS não encontrada");
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        resetInterface("Erro na procura");
                    });
            } else {
                resetInterface("---");
            }
        });
    }

    // --- 5. FUNÇÕES AUXILIARES ---
    function preencherInterface(dados) {
        campos.cliente.innerText = dados.cliente;
        campos.veiculo.innerText = dados.veiculo;
        campos.data.innerText = dados.data_abertura;
        campos.funcionario.innerText = dados.funcionario;
        campos.subtotal.innerText = dados.total + "€";
        campos.total.innerText = dados.total + "€";

        campos.listaServicos.innerHTML = (dados.servicos && dados.servicos.length > 0) 
            ? dados.servicos.map(s => `<div style="display:flex; justify-content:space-between; padding:4px 0; font-size:0.9rem;"><span>${s.nome}</span><span>${s.preco}</span></div>`).join('')
            : "<div>Sem serviços registados.</div>";

        campos.listaPecas.innerHTML = (dados.pecas && dados.pecas.length > 0)
            ? dados.pecas.map(p => `<div style="display:flex; justify-content:space-between; padding:4px 0; font-size:0.9rem;"><span>${p.nome}</span><span>${p.preco}</span></div>`).join('')
            : "<div>Sem peças aplicadas.</div>";
    }

    function resetInterface(msg) {
        campos.cliente.innerText = msg;
        campos.veiculo.innerText = msg;
        campos.data.innerText = msg;
        campos.funcionario.innerText = msg;
        campos.listaServicos.innerHTML = `<div style="color: #999;">${msg}</div>`;
        campos.listaPecas.innerHTML = `<div style="color: #999;">${msg}</div>`;
        campos.subtotal.innerText = "0.00€";
        campos.total.innerText = "0.00€";
    }

    // --- 6. BOTÃO EMITIR FATURA (GRAVAR E REDIRECIONAR) ---
    const btnEmitirFatura = document.getElementById('btnEmitirFatura');
    if (btnEmitirFatura) {
        btnEmitirFatura.addEventListener('click', function(e) {
            e.preventDefault(); 

            // 1. Validar se a OS foi carregada corretamente
            if (campos.cliente.innerText === "---" || campos.cliente.innerText === "OS não encontrada" || campos.cliente.innerText === "Erro na procura") {
                alert('Por favor, carregue uma Ordem de Serviço válida primeiro.');
                return;
            }

            // 2. Recolher dados
            const osId = document.getElementById('inputOS').value.trim();
            const formaPagamento = document.getElementById('formaPagamento').value;
            const statusPagamento = document.getElementById('statusPagamento').value;
            const dataEmissao = document.getElementById('dataEmissao').value;
            const valorTotal = campos.total.innerText.replace('€', '').trim();

            // 3. Validação de campos de seleção
            if (formaPagamento === "Selecione..." || !statusPagamento || statusPagamento === "") {
                alert('Por favor, preencha todos os dados de pagamento.');
                return;
            }

            // 4. Obter o CSRF Token
            const csrfInput = document.querySelector('[name=csrfmiddlewaretoken]');
            if (!csrfInput) {
                alert('Erro de segurança: Token CSRF não encontrado.');
                return;
            }

            // 5. Enviar POST para o Django
            fetch('/emitir-fatura-save/', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRFToken': csrfInput.value
                },
                body: JSON.stringify({
                    os_id: osId,
                    forma_pagamento: formaPagamento,
                    status_pagamento: statusPagamento,
                    data_emissao: dataEmissao,
                    valor_total: valorTotal
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    alert('Fatura emitida com sucesso!');
                    
                    // --- ALTERAÇÃO AQUI: ---
                    // Usamos o fatura_id que o servidor nos enviou no JSON
                    // para construir a URL correta, ex: /fatura/8/
                    window.location.href = `/fatura/${data.fatura_id}/`;
                    
                } else {
                    alert('Erro ao guardar fatura: ' + data.mensagem);
                }
            })
            .catch(error => {
                console.error('Erro no POST:', error);
                alert('Ocorreu um erro ao comunicar com o servidor.');
            });
        });
    }
});