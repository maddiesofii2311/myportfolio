document.addEventListener('DOMContentLoaded', function() {
    // Dropdown do user - específico para página de funcionário
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');
    const sairBtn = document.getElementById('sairBtn');
    
    if (userIcon && userDropdown) {
        userIcon.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
        
        // Fechar dropdown ao clicar fora
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && e.target !== userIcon) {
                userDropdown.classList.remove('show');
            }
        });
    }
    
    // Botão Sair
    if (sairBtn) {
        sairBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Tem a certeza que deseja sair?')) {
                alert('A sair da aplicação...');
                // window.location.href = 'index.html'; 
            }
        });
    }

    // Função para ordenar tabela - OS concluídas no fim
    function ordenarTabela() {
        const tbody = document.querySelector('.os-table-funcionario tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        
        rows.sort((a, b) => {
            const statusA = a.cells[4].querySelector('.badge-status');
            const statusB = b.cells[4].querySelector('.badge-status');
            
            const isConcluida_A = statusA.classList.contains('badge-concluida');
            const isConcluida_B = statusB.classList.contains('badge-concluida');
            
            // Concluídas vão para o fim
            if (isConcluida_A && !isConcluida_B) return 1;
            if (!isConcluida_A && isConcluida_B) return -1;
            
            // Manter ordem original para os restantes
            return 0;
        });
        
        // Reordenar as linhas na tabela
        rows.forEach(row => tbody.appendChild(row));
    }

    // Função para atualizar botões de edição baseado no status
    function atualizarBotoesEdicao() {
        const rows = document.querySelectorAll('.os-table-funcionario tbody tr');
        
        rows.forEach(row => {
            const statusBadge = row.cells[4].querySelector('.badge-status');
            const btnEditar = row.querySelector('.btn-editar');
            
            if (statusBadge.classList.contains('badge-concluida')) {
                // Remover botão de edição se status é concluída
                if (btnEditar) {
                    btnEditar.remove();
                }
            } else {
                // Garantir que o botão existe para status não concluídos
                if (!btnEditar) {
                    const acoesCell = row.cells[6];
                    const novoBtn = document.createElement('button');
                    novoBtn.className = 'btn-acao btn-editar';
                    novoBtn.textContent = 'Editar';
                    acoesCell.innerHTML = '';
                    acoesCell.appendChild(novoBtn);
                }
            }
        });
    }

    // Executar ordenação e atualização inicial
    ordenarTabela();
    atualizarBotoesEdicao();

    // Modal de Edição
    const modalEditar = document.getElementById('modalEditar');
    const closeModal = document.getElementById('closeModal');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnGravar = document.getElementById('btnGravar');
    const btnRemover = document.getElementById('btnRemover');
    let linhaAtual = null;

    // Função para abrir modal
    function abrirModal(row) {
        linhaAtual = row;
        const cells = row.cells;
        const idOS = cells[0].textContent.trim(); // Pega o ID
        
        document.getElementById('editID').value = idOS;
        document.getElementById('editIDVeiculo').value = cells[1].textContent;
        document.getElementById('editIDFuncionario').value = cells[2].textContent;
        document.getElementById('editDataAbertura').value = cells[3].textContent;
        document.getElementById('editDataConclusao').value = cells[4].textContent;
        document.getElementById('editDescricao').value = cells[6].textContent;
        
        // Definir status
        const statusBadge = cells[5].querySelector('.badge-status');
        if (statusBadge.classList.contains('badge-emcurso')) {
            document.getElementById('editStatus').value = 'emcurso';
        } else if (statusBadge.classList.contains('badge-pendente')) {
            document.getElementById('editStatus').value = 'pendente';
        } else if (statusBadge.classList.contains('badge-concluida')) {
            document.getElementById('editStatus').value = 'concluida';
        }

        // Atualiza o 'action' do formulário dinamicamente
        const form = document.getElementById('formEditar');
        form.action = `/editar-os/${idOS}/`;
        
        modalEditar.classList.add('show');
    }

    // Função para fechar modal
    function fecharModal() {
        modalEditar.classList.remove('show');
        linhaAtual = null;
    }

    // Event listeners para botões de editar
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-editar')) {
            const row = e.target.closest('tr');
            abrirModal(row);
        }
    });

    // Fechar modal
    closeModal.addEventListener('click', fecharModal);
    btnCancelar.addEventListener('click', fecharModal);

    // Fechar modal ao clicar fora
    modalEditar.addEventListener('click', function(e) {
        if (e.target === modalEditar) {
            fecharModal();
        }
    });

    // Gravar alterações
    btnGravar.addEventListener('click', function() {
        // Envia o formulário para o servidor
        const form = document.getElementById('formEditar');
        if (linhaAtual) {

            // Garante que o ID da OS está na URL
            const idOS = document.getElementById('editID').value;
            form.action = `/editar-os/${idOS}/`;
            
            console.log("A submeter formulário para: " + form.action);
            form.submit();

            /*const cells = linhaAtual.cells;
            
            cells[1].textContent = document.getElementById('editIDVeiculo').value;
            cells[2].textContent = document.getElementById('editDataAbertura').value;
            cells[3].textContent = document.getElementById('editDataConclusao').value;
            cells[5].textContent = document.getElementById('editDescricao').value;
            
            // Atualizar status
            const statusValue = document.getElementById('editStatus').value;
            const statusBadge = cells[4].querySelector('.badge-status');
            
            statusBadge.classList.remove('badge-emcurso', 'badge-pendente', 'badge-concluida');
            
            if (statusValue === 'emcurso') {
                statusBadge.classList.add('badge-emcurso');
                statusBadge.textContent = 'Em Curso';
            } else if (statusValue === 'pendente') {
                statusBadge.classList.add('badge-pendente');
                statusBadge.textContent = 'Pendente';
            } else if (statusValue === 'concluida') {
                statusBadge.classList.add('badge-concluida');
                statusBadge.textContent = 'Concluída';
            }
            
            fecharModal();
            
            // Atualizar botões e reordenar tabela após gravar
            atualizarBotoesEdicao();
            ordenarTabela();
            
            alert('Alterações gravadas com sucesso!');*/
        }
    });

    // Remover OS
    if (btnRemover) {
        btnRemover.addEventListener('click', function() {
            if (linhaAtual) {
                const idOS = linhaAtual.cells[0].textContent;
                
                if (confirm(`Tem a certeza que deseja remover a Ordem de Serviço ID: ${idOS}?`)) {
                    linhaAtual.remove();
                    fecharModal();
                    alert('Ordem de Serviço removida com sucesso!');
                }
            }
        });
    }

    // Funcionalidade de pesquisa de matrícula 
    const searchMatricula = document.getElementById('searchMatricula');
    if (searchMatricula) {
        searchMatricula.addEventListener('input', function(e) {
            const searchValue = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('.os-table-funcionario tbody tr');
            
            tableRows.forEach(row => {
                const matricula = row.cells[5].textContent.toLowerCase();
                if (matricula.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    /*
    // Funcionalidade de pesquisa de matrícula
    document.getElementById('searchMatricula').addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll('.os-table-funcionario tbody tr');
        
        tableRows.forEach(row => {
            const matricula = row.cells[5].textContent.toLowerCase(); // Coluna 5 é a matrícula
            if (matricula.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });*/

});