document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript carregado');
    
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

    // Testar se o modal existe
    const modalEditar = document.getElementById('modalEditar');
    console.log('Modal encontrado:', modalEditar);
    
    if (!modalEditar) {
        console.error('ERRO: Modal não encontrado no HTML!');
        return;
    }

    const closeModal = document.getElementById('closeModal');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnGravar = document.getElementById('btnGravar');
    
    console.log('Botões:', {closeModal, btnCancelar, btnGravar});
    
    let linhaAtual = null;

    // Função para abrir modal
    function abrirModal(row) {
        console.log('Tentando abrir modal');
        linhaAtual = row;
        
        try {
            const cells = row.cells;
            
            // Preencher campos
            const editID = document.getElementById('editID');
            const editNome = document.getElementById('editNome');
            const editTelemovel = document.getElementById('editTelemovel');
            const editMorada = document.getElementById('editMorada');
            const editCargo = document.getElementById('editCargo');
            const editEspecialidade = document.getElementById('editEspecialidade');
            const editPassword = document.getElementById('editPassword');
            
            console.log('Campos:', {editID, editNome, editTelemovel, editMorada, editCargo, editEspecialidade, editPassword});
            
            if (editID) editID.value = cells[0].textContent;
            if (editNome) editNome.value = cells[1].textContent;
            if (editTelemovel) editTelemovel.value = cells[2].textContent;
            if (editMorada) editMorada.value = cells[3].textContent;
            if (editPassword) editPassword.value = '';
            
            // Cargo
            const cargoBadge = cells[4].querySelector('.badge-status');
            if (editCargo && cargoBadge) {
                if (cargoBadge.classList.contains('badge-funcionario')) {
                    editCargo.value = 'funcionario';
                } else if (cargoBadge.classList.contains('badge-admGes')) {
                    editCargo.value = 'admGes';
                }
            }
            
            // Especialidade
            const especialidadeBadge = cells[5].querySelector('.badge-status');
            if (editEspecialidade && especialidadeBadge) {
                if (especialidadeBadge.classList.contains('badge-mecanico')) {
                    editEspecialidade.value = 'mecanico';
                } else if (especialidadeBadge.classList.contains('badge-eletricista')) {
                    editEspecialidade.value = 'eletricista';
                }
            }
            
            modalEditar.classList.add('show');
            console.log('Modal aberto com sucesso');
            
        } catch (error) {
            console.error('Erro ao abrir modal:', error);
        }
    }

    // Função para fechar modal
    function fecharModal() {
        modalEditar.classList.remove('show');
        linhaAtual = null;
    }

    // Event listener para botões de editar
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-editar')) {
            console.log('Botão editar clicado');
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
                
                const editNome = document.getElementById('editNome');
                const editTelemovel = document.getElementById('editTelemovel');
                const editMorada = document.getElementById('editMorada');
                const editCargo = document.getElementById('editCargo');
                const editEspecialidade = document.getElementById('editEspecialidade');
                
                if (editNome) cells[1].textContent = editNome.value;
                if (editTelemovel) cells[2].textContent = editTelemovel.value;
                if (editMorada) cells[3].textContent = editMorada.value;
                
                // Cargo
                if (editCargo) {
                    const cargoValue = editCargo.value;
                    const cargoBadge = cells[4].querySelector('.badge-status');
                    if (cargoBadge) {
                        cargoBadge.classList.remove('badge-funcionario', 'badge-admGes');
                        if (cargoValue === 'funcionario') {
                            cargoBadge.classList.add('badge-funcionario');
                            cargoBadge.textContent = 'Funcionário';
                        } else if (cargoValue === 'admGes') {
                            cargoBadge.classList.add('badge-admGes');
                            cargoBadge.textContent = 'AdmGes';
                        }
                    }
                }
                
                // Especialidade
                if (editEspecialidade) {
                    const especialidadeValue = editEspecialidade.value;
                    const especialidadeBadge = cells[5].querySelector('.badge-status');
                    if (especialidadeBadge) {
                        especialidadeBadge.classList.remove('badge-mecanico', 'badge-eletricista');
                        if (especialidadeValue === 'mecanico') {
                            especialidadeBadge.classList.add('badge-mecanico');
                            especialidadeBadge.textContent = 'Mecânico';
                        } else if (especialidadeValue === 'eletricista') {
                            especialidadeBadge.classList.add('badge-eletricista');
                            especialidadeBadge.textContent = 'Eletricista';
                        }
                    }
                }
                
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