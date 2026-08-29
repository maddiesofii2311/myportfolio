document.getElementById('peca_id').addEventListener('change', function() {
    const pecaId = this.value;
    
    if (pecaId) {
        // Faz uma chamada ao Django para buscar o preço da peça
        fetch(`/get-preco-peca/${pecaId}/`)
            .then(response => response.json())
            .then(data => {
                if (data.preco) {
                    // Preenche o campo 'Preço'
                    document.getElementById('preco_unitario').value = data.preco;
                    atualizarSubtotalPeca();
                } else {
                    alert("Peça não encontrada!");
                }
            });
    }
});

function atualizarSubtotalPeca() {
    const preco = parseFloat(document.getElementById('preco_unitario').value) || 0;
    const qtd = parseInt(document.getElementById('quantidade').value) || 0;
    // Preenche o campo 'Subtotal'
    document.getElementById('subtotal').value = (preco * qtd).toFixed(2);
}

// Atualiza quando o utilizador muda a quantidade
document.getElementById('quantidade').addEventListener('input', atualizarSubtotalPeca);