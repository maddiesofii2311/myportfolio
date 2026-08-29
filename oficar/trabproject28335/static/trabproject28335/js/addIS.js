document.getElementById('servico_id').addEventListener('change', function() {
    const servicoId = this.value;
    
    if (servicoId) {
        // Faz uma chamada ao Django para buscar o preço
        fetch(`/get-preco-servico/${servicoId}/`)
            .then(response => response.json())
            .then(data => {
                if (data.preco) {
                    document.getElementById('preco_unitario').value = data.preco;
                    atualizarSubtotal();
                } else {
                    alert("Serviço não encontrado!");
                }
            });
    }
});

function atualizarSubtotal() {
    const preco = parseFloat(document.getElementById('preco_unitario').value) || 0;
    const qtd = parseInt(document.getElementById('quantidade').value) || 0;
    document.getElementById('subtotal').value = (preco * qtd).toFixed(2);
}

document.getElementById('quantidade').addEventListener('input', atualizarSubtotal);