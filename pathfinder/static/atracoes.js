const params   = new URLSearchParams(window.location.search);
const route    = JSON.parse(decodeURIComponent(params.get('route') || '[]'));
const initCity = decodeURIComponent(params.get('city') || route[0] || '');

// Paletas de cores para os cards
const palettes = [
  { bg: '#d4edda', emoji: '🏛️' },
  { bg: '#cce5ff', emoji: '📚' },
  { bg: '#fff3cd', emoji: '⛪' },
  { bg: '#f8d7da', emoji: '🏰' },
  { bg: '#d1ecf1', emoji: '🌳' },
];

// Cache para não repetir chamadas ao Ollama
const cache = {};

// ── Matrícula na navbar ──
const matricula = sessionStorage.getItem('matricula') || 'AB · 12 · CD';
const chip = document.getElementById('plateChip');
if (chip) {
  const partes = matricula.split('-');
  chip.textContent = partes.length === 3 ? partes.join(' · ') : matricula;
}

// ── Sidebar com lista de cidades ──
function buildSidebar() {
  const list = document.getElementById('cityList');
  if (!list) return;
  list.innerHTML = '';
  route.forEach((city, i) => {
    const li = document.createElement('li');
    li.className = 'city-item' + (city === initCity ? ' active' : '');
    li.innerHTML = `<span class="city-num">${i + 1}</span> ${city}`;
    li.addEventListener('click', () => {
      document.querySelectorAll('.city-item').forEach(el => el.classList.remove('active'));
      li.classList.add('active');
      loadCity(city);
    });
    list.appendChild(li);
  });
}

// ── Carregar cidade via API Ollama ──
async function loadCity(city) {
  document.getElementById('cityName').textContent = city;
  document.getElementById('cityMeta').innerHTML = '<span class="meta-item">A carregar...</span>';
  document.getElementById('llmBody').textContent = 'A consultar o modelo de IA...';
  document.getElementById('llmTime').textContent = '';

  // Skeletons enquanto carrega
  document.getElementById('cardsGrid').innerHTML = `
    <div class="card skeleton"></div>
    <div class="card skeleton"></div>
    <div class="card skeleton"></div>
  `;

  // Usa cache se já foi pedido
  if (cache[city]) {
    renderCity(city, cache[city]);
    return;
  }

  try {
    const res = await fetch(`/api/atracoes?cidade=${encodeURIComponent(city)}`);
    if (!res.ok) {
      const err = await res.json();
      throw new Error(err.erro || 'Erro desconhecido');
    }
    const data = await res.json();
    cache[city] = data;
    renderCity(city, data);
  } catch (err) {
    document.getElementById('cardsGrid').innerHTML =
      `<p style="color:#e74c3c;padding:16px;grid-column:1/-1">Erro: ${err.message}</p>`;
    document.getElementById('llmBody').textContent = 'Não foi possível obter informação. Verifica se o Ollama está a correr.';
  }
}

// ── Renderizar dados da cidade ──
function renderCity(city, data) {
  document.getElementById('cityName').textContent = city;
  document.getElementById('cityMeta').innerHTML = `
    <span class="meta-item">📍 ${data.regiao || ''}</span>
    <span class="meta-item">ℹ️ ${data.descricao || ''}</span>
  `;

  const grid = document.getElementById('cardsGrid');
  grid.innerHTML = '';
  (data.atracoes || []).forEach((a, i) => {
    const p = palettes[i % palettes.length];
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `
      <div class="card-image" style="background:${p.bg}">${p.emoji}</div>
      <div class="card-body">
        <div class="card-label">ATRAÇÃO 0${i + 1}</div>
        <div class="card-title">${a.nome}</div>
        <div class="card-desc">${a.descricao}</div>
      </div>
    `;
    grid.appendChild(card);
  });

  const llmTime = document.getElementById('llmTime');
  if (llmTime) llmTime.textContent = data.elapsed ? '⚡ ' + data.elapsed : '';
  document.getElementById('llmBody').textContent = data.texto_completo || '';
}

// ── Botão voltar ──
const btnVoltar = document.getElementById('btnVoltar');
if (btnVoltar) btnVoltar.addEventListener('click', () => history.back());

// ── Inicialização ──
buildSidebar();
if (initCity) loadCity(initCity);
