document.addEventListener('DOMContentLoaded', function() {
    // Dropdown do user
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');
    const sairBtn = document.getElementById('sairBtn');
    
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
    
    if (sairBtn) {
        sairBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Tem a certeza que deseja sair?')) {
                alert('A sair da aplicação...');
            }
        });
    }

    // Função para esconder/mostrar botões de editar conforme o status
    function atualizarBotoesEditar() {
        const tbody = document.querySelector('.os-table-funcionario tbody');
        const rows = tbody.querySelectorAll('tr');
        
        rows.forEach(row => {
            const statusBadge = row.cells[4].querySelector('.badge-status');
            const btnEditar = row.querySelector('.btn-editar');
            
            if (btnEditar) {
                if (statusBadge && statusBadge.classList.contains('badge-concluida')) {
                    // Esconder o botão se a OS estiver concluída
                    btnEditar.style.display = 'none';
                } else {
                    // Mostrar o botão se não estiver concluída
                    btnEditar.style.display = 'inline-block';
                }
            }
        });
    }

    // Função para ordenar a tabela - OS concluídas no fim
    function ordenarTabela() {
        const tbody = document.querySelector('.os-table-funcionario tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        
        // Separar as linhas em concluídas e não concluídas
        const naoConcluidasRows = [];
        const concluidasRows = [];
        
        rows.forEach(row => {
            const statusBadge = row.cells[4].querySelector('.badge-status');
            if (statusBadge && statusBadge.classList.contains('badge-concluida')) {
                concluidasRows.push(row);
            } else {
                naoConcluidasRows.push(row);
            }
        });
        
        // Limpar a tbody e adicionar na ordem correta
        tbody.innerHTML = '';
        naoConcluidasRows.forEach(row => tbody.appendChild(row));
        concluidasRows.forEach(row => tbody.appendChild(row));
    }
    
    // Ordenar a tabela e atualizar botões ao carregar a página
    ordenarTabela();
    atualizarBotoesEditar();

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
        
        // Preencher os campos do modal
        document.getElementById('editID').value = cells[0].textContent;
        document.getElementById('editNome').value = cells[1].textContent;
        document.getElementById('editTelemovel').value = cells[2].textContent;
        document.getElementById('editDataConclusao').value = cells[3].textContent;
        document.getElementById('editDescricao').value = cells[5].textContent;
        
        // Definir status
        const statusBadge = cells[4].querySelector('.badge-status');
        if (statusBadge.classList.contains('badge-emcurso')) {
            document.getElementById('editStatus').value = 'emcurso';
        } else if (statusBadge.classList.contains('badge-pendente')) {
            document.getElementById('editStatus').value = 'pendente';
        } else if (statusBadge.classList.contains('badge-concluida')) {
            document.getElementById('editStatus').value = 'concluida';
        }
        
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
    if (closeModal) {
        closeModal.addEventListener('click', fecharModal);
    }
    
    if (btnCancelar) {
        btnCancelar.addEventListener('click', fecharModal);
    }

    // Fechar modal ao clicar fora
    if (modalEditar) {
        modalEditar.addEventListener('click', function(e) {
            if (e.target === modalEditar) {
                fecharModal();
            }
        });
    }

    // Gravar alterações
    if (btnGravar) {
        btnGravar.addEventListener('click', function() {
            if (linhaAtual) {
                const cells = linhaAtual.cells;
                
                cells[1].textContent = document.getElementById('editNome').value;
                cells[2].textContent = document.getElementById('editTelemovel').value;
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
                alert('Alterações gravadas com sucesso!');
                
                // Reordenar a tabela e atualizar botões após gravar
                ordenarTabela();
                atualizarBotoesEditar();
            }
        });
    }

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
});