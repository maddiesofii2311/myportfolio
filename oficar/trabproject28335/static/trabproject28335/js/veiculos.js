document.addEventListener('DOMContentLoaded', function() {
    // --- 1. Dropdown do user (Mantido igual ao teu padrão) ---
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
                // window.location.href = '/logout/'; 
            }
        });
    }

    // --- 2. Modal de Edição de Veículos ---
    const modalEditar = document.getElementById('modalEditar');
    const closeModal = document.getElementById('closeModal');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnGravar = document.getElementById('btnGravar');
    const btnRemover = document.getElementById('btnRemover');
    let linhaAtual = null;

    // Função para abrir modal com os dados do VEÍCULO
    function abrirModal(row) {
        linhaAtual = row;
        const cells = row.cells;
        
        // Mapeamento de acordo com a tua tabela de veículos:
        // Colunas: 0:ID, 1:Cliente, 2:Marca, 3:Modelo, 4:Ano, 5:Matricula
        try {
            document.getElementById('editID').value = cells[0].textContent.trim();
            document.getElementById('editCliente').value = cells[1].textContent.trim();
            document.getElementById('editMarca').value = cells[2].textContent.trim();
            document.getElementById('editModelo').value = cells[3].textContent.trim();
            document.getElementById('editAno').value = cells[4].textContent.trim();
            document.getElementById('editMatricula').value = cells[5].textContent.trim();
            
            modalEditar.classList.add('show');
        } catch (error) {
            console.error("Erro ao preencher modal. Verifica se os IDs existem no HTML:", error);
        }
    }

    function fecharModal() {
        if (modalEditar) modalEditar.classList.remove('show');
        linhaAtual = null;
    }

    // Event listener para o botão editar (Delegado para funcionar em linhas dinâmicas)
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-editar')) {
            const row = e.target.closest('tr');
            abrirModal(row);
        }
    });

    // Fechar modal
    if (closeModal) closeModal.addEventListener('click', fecharModal);
    if (btnCancelar) btnCancelar.addEventListener('click', fecharModal);

    if (modalEditar) {
        modalEditar.addEventListener('click', function(e) {
            if (e.target === modalEditar) fecharModal();
        });
    }

    // --- 3. Ações: Gravar e Remover ---

    // Gravar alterações na tabela
    if (btnGravar) {
        btnGravar.addEventListener('click', function() {
            if (linhaAtual) {
                const cells = linhaAtual.cells;
                
                cells[1].textContent = document.getElementById('editCliente').value;
                cells[2].textContent = document.getElementById('editMarca').value;
                cells[3].textContent = document.getElementById('editModelo').value;
                cells[4].textContent = document.getElementById('editAno').value;
                cells[5].textContent = document.getElementById('editMatricula').value;
                
                fecharModal();
                alert('Veículo atualizado com sucesso!');
            }
        });
    }

    // Remover veículo
    if (btnRemover) {
        btnRemover.addEventListener('click', function() {
            if (linhaAtual) {
                const matricula = document.getElementById('editMatricula').value;
                const idVeiculo = document.getElementById('editID').value;
                
                if (confirm(`Deseja remover o veículo com matrícula "${matricula}"?`)) {
                    linhaAtual.remove();
                    fecharModal();
                    alert('Veículo removido com sucesso!');
                    // Aqui podes adicionar o fetch('/veiculos/delete/' + idVeiculo...)
                }
            }
        });
    }
});