const dropZone  = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const barFill   = document.getElementById('barFill');
const pctLabel  = document.getElementById('pctLabel');
const plateNum  = document.getElementById('plateNumber');
const btnEnter  = document.querySelector('.btn-enter');

// Barra de confiança animada no arranque
setTimeout(() => { barFill.style.width = '0%'; }, 200);

// Desactiva o botão até haver matrícula reconhecida
btnEnter.style.pointerEvents = 'none';
btnEnter.style.opacity = '0.5';

// ── Drag & Drop ──
dropZone.addEventListener('dragover', e => {
  e.preventDefault();
  dropZone.classList.add('drag-over');
});
dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
dropZone.addEventListener('drop', e => {
  e.preventDefault();
  dropZone.classList.remove('drag-over');
  const file = e.dataTransfer.files[0];
  if (file) handleFile(file);
});
fileInput.addEventListener('change', () => {
  if (fileInput.files[0]) handleFile(fileInput.files[0]);
});

// ── Processar imagem ──
function handleFile(file) {
  if (file.size > 10 * 1024 * 1024) {
    alert('Ficheiro demasiado grande. Máximo: 10 MB');
    return;
  }

  // Mostra preview da imagem na zona de upload
  const reader = new FileReader();
  reader.onload = () => {
    dropZone.style.backgroundImage    = `url(${reader.result})`;
    dropZone.style.backgroundSize     = 'contain';
    dropZone.style.backgroundPosition = 'center';
    dropZone.style.backgroundRepeat   = 'no-repeat';
    dropZone.style.backgroundColor    = '#f0f0f0';
    dropZone.querySelector('.upload-icon').style.display = 'none';
    dropZone.querySelectorAll('p').forEach(p => p.style.display = 'none');
  };
  reader.readAsDataURL(file);

  // Estado de carregamento
  barFill.style.width = '0%';
  pctLabel.textContent = '...';
  plateNum.textContent = '·  ·  ·';
  btnEnter.style.pointerEvents = 'none';
  btnEnter.style.opacity = '0.5';

  // Enviar para a API OCR do backend
  const formData = new FormData();
  formData.append('imagem', file);

  fetch('/api/ocr', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
      if (data.matricula) {
        // Formata AA-00-AA → AA · 00 · AA para exibição
        const partes = data.matricula.split('-');
        plateNum.textContent = partes.join(' · ');

        const confianca = data.confianca || 92;
        barFill.style.width = confianca + '%';
        pctLabel.textContent = confianca + '%';

        // Guarda a matrícula em sessionStorage para as outras páginas
        sessionStorage.setItem('matricula', data.matricula);

        // Activa o botão de entrada
        btnEnter.style.pointerEvents = 'auto';
        btnEnter.style.opacity = '1';
      } else {
        plateNum.textContent = 'Não reconhecida';
        barFill.style.width = '0%';
        pctLabel.textContent = '0%';
        alert('Não foi possível reconhecer a matrícula.\nTenta com uma imagem mais nítida.');
      }
    })
    .catch(() => {
      plateNum.textContent = 'Erro de ligação';
      alert('Erro ao contactar o servidor. Verifica se o Flask está a correr.');
    });
}
