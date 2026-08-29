document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('.os-table tbody');
    
    // Função para contar os status
    function contarStatus() {
        const rows = table.querySelectorAll('tr');
        let emCurso = 0;
        let concluida = 0;
        let pendente = 0;
        
        rows.forEach(row => {
            const statusBadge = row.querySelector('td:last-child .badge-status');
            if (statusBadge) {
                if (statusBadge.classList.contains('badge-emcurso')) {
                    emCurso++;
                } else if (statusBadge.classList.contains('badge-concluida')) {
                    concluida++;
                } else if (statusBadge.classList.contains('badge-pendente')) {
                    pendente++;
                }
            }
        });
        
        return { emCurso, concluida, pendente };
    }
    
    // Função para atualizar o gráfico
    function atualizarGrafico() {
        const stats = contarStatus();
        const total = stats.emCurso + stats.concluida + stats.pendente;
        
        if (total === 0) return;
        
        // Calcular percentagens
        const percEmCurso = (stats.emCurso / total) * 100;
        const percConcluida = (stats.concluida / total) * 100;
        const percPendente = (stats.pendente / total) * 100;
        
        // Atualizar o gráfico
        const grafico = document.querySelector('.chart-placeholder');
        if (grafico) {
            grafico.style.background = `conic-gradient(
                #ffcc00 0% ${percEmCurso}%,
                #404040 ${percEmCurso}% ${percEmCurso + percConcluida}%,
                #ff9966 ${percEmCurso + percConcluida}% 100%
            )`;
        }
    }
    
    // Função para reorganizar a tabela
    function reorganizarTabela() {
        const rows = Array.from(table.querySelectorAll('tr'));
        
        // Separar linhas concluídas e não concluídas
        const naoConcluidas = [];
        const concluidas = [];
        
        rows.forEach(row => {
            const statusBadge = row.querySelector('td:last-child .badge-status');
            if (statusBadge && statusBadge.classList.contains('badge-concluida')) {
                concluidas.push(row);
            } else {
                naoConcluidas.push(row);
            }
        });
        
        // Limpar tabela
        table.innerHTML = '';
        
        // Adicionar primeiro as não concluídas, depois as concluídas
        naoConcluidas.forEach(row => table.appendChild(row));
        concluidas.forEach(row => table.appendChild(row));
    }
    
    // Criar dropdown de status
    function criarDropdown(badge) {
        // Remover dropdown existente se houver
        const dropdownExistente = document.querySelector('.status-dropdown');
        if (dropdownExistente) {
            dropdownExistente.remove();
        }
        
        const dropdown = document.createElement('div');
        dropdown.className = 'status-dropdown';
        dropdown.innerHTML = `
            <div class="status-option" data-status="emcurso">
                <span class="badge-status badge-emcurso">Em Curso</span>
            </div>
            <div class="status-option" data-status="concluida">
                <span class="badge-status badge-concluida">Concluída</span>
            </div>
            <div class="status-option" data-status="pendente">
                <span class="badge-status badge-pendente">Pendente</span>
            </div>
        `;
        
        // Posicionar dropdown
        const rect = badge.getBoundingClientRect();
        dropdown.style.position = 'absolute';
        dropdown.style.top = (rect.bottom + window.scrollY + 5) + 'px';
        dropdown.style.left = (rect.left + window.scrollX) + 'px';
        dropdown.style.zIndex = '1000';
        
        document.body.appendChild(dropdown);
        
        // Event listener para cada opção
        dropdown.querySelectorAll('.status-option').forEach(option => {
            option.addEventListener('click', function() {
                const novoStatus = this.dataset.status;
                
                // Remover todas as classes de status
                badge.classList.remove('badge-emcurso', 'badge-concluida', 'badge-pendente');
                
                // Adicionar nova classe e texto
                if (novoStatus === 'emcurso') {
                    badge.classList.add('badge-emcurso');
                    badge.textContent = 'Em Curso';
                } else if (novoStatus === 'concluida') {
                    badge.classList.add('badge-concluida');
                    badge.textContent = 'Concluída';
                } else if (novoStatus === 'pendente') {
                    badge.classList.add('badge-pendente');
                    badge.textContent = 'Pendente';
                }
                
                // Remover dropdown
                dropdown.remove();
                
                // Reorganizar tabela
                reorganizarTabela();
                
                // Atualizar gráfico
                atualizarGrafico();
                
                // Re-adicionar event listeners
                adicionarEventListeners();
            });
        });
        
        // Fechar dropdown ao clicar fora
        setTimeout(() => {
            document.addEventListener('click', function fecharDropdown(e) {
                if (!dropdown.contains(e.target) && e.target !== badge) {
                    dropdown.remove();
                    document.removeEventListener('click', fecharDropdown);
                }
            });
        }, 10);
    }
    
    // Adicionar event listeners aos badges de status
    function adicionarEventListeners() {
        const statusBadges = document.querySelectorAll('.badge-status');
        
        statusBadges.forEach(badge => {
            // Remover event listeners antigos
            const novoBadge = badge.cloneNode(true);
            badge.parentNode.replaceChild(novoBadge, badge);
            
            novoBadge.style.cursor = 'pointer';
            
            novoBadge.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                criarDropdown(this);
            });
        });
    }
    
    // Inicializar
    reorganizarTabela();
    atualizarGrafico();
    adicionarEventListeners();

    // Dropdown do user
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
            // Adicionar a lógica de logout
            // Por exemplo: window.location.href = '/logout';
            if (confirm('Tem a certeza que deseja sair?')) {
                alert('A sair da aplicação...');
                // window.location.href = '/logout'; 
            }
        });
    }

    //Para página Minhas OS Funcionários - permitir scroll na tabela
    if (document.querySelector('.main-content-funcionario')) {
        document.documentElement.style.overflow = 'visible';
        document.body.style.overflow = 'visible';
        document.getElementById('wrapper').style.overflow = 'visible';
        document.getElementById('wrapper').style.height = 'auto';
        document.getElementById('page-content-wrapper').style.overflow = 'visible';
        document.getElementById('page-content-wrapper').style.height = 'auto';
    }
});