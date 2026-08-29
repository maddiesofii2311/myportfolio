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

    // Modal de Edição
    const modalEditar = document.getElementById('modalEditar');
    const closeModal = document.getElementById('closeModal');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnGravar = document.getElementById('btnGravar');
    let linhaAtual = null;

    // Função para abrir modal
    function abrirModal(row) {
        linhaAtual = row;
        const cells = row.cells;
        
        // Atualizar os campos do modal com os dados da linha
        document.getElementById('editID').value = cells[0].textContent;
        document.getElementById('editNome').value = cells[1].textContent;
        document.getElementById('editTelemovel').value = cells[2].textContent;
        document.getElementById('editEmail').value = cells[3].textContent;
        document.getElementById('editMorada').value = cells[4].textContent;
        
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
                
                // Atualizar os dados da linha com os valores do modal
                cells[0].textContent = document.getElementById('editID').value;
                cells[1].textContent = document.getElementById('editNome').value;
                cells[2].textContent = document.getElementById('editTelemovel').value;
                cells[3].textContent = document.getElementById('editEmail').value;
                
                fecharModal();
                alert('Alterações gravadas com sucesso!');
            }
        });
    }

    // Remover funcionário
    const btnRemover = document.getElementById('btnRemover');
    if (btnRemover) {
        btnRemover.addEventListener('click', function() {
            if (linhaAtual) {
                const nomeFunc = linhaAtual.cells[1].textContent;
                const idFunc = linhaAtual.cells[0].textContent;
                
                if (confirm(`Tem a certeza que deseja remover o funcionário "${nomeFunc}" (ID: ${idFunc})?`)) {
                    // Remover a linha da tabela
                    linhaAtual.remove();
                    
                    // Fechar o modal
                    fecharModal();
                    
                    // Mostrar mensagem de sucesso
                    alert('Funcionário removido com sucesso!');
                    
                    // Adicionar código para enviar para o servidor
                    // Por exemplo: enviar um request DELETE para a API
                    // fetch('/api/funcionarios/' + idFunc, { method: 'DELETE' })
                }
            }
        });
    }
});