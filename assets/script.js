
//Script jS

tailwind.config = {
  darkMode: 'media',
  theme: {
    extend: {
      fontFamily: {
        sans: ['SF Pro Display', 'Inter', 'system-ui', 'sans-serif'],
      },
      colors: {
        iosBlue: '#007aff',
        iosBlueHover: '#0a84ff',
        iosRed: '#ff3b30',
        iosOrange: '#ff9500',
        iosYellow: '#ffcc00',
        softLight: '#f5f5f7',
        softDark: '#1c1c1e',
      },
      boxShadow: {
        smooth: '0 10px 30px rgba(0,0,0,0.05)',
      }
    }
  }
};

async function carregarIncidentes() {
  const tbody = document.querySelector('#incidentTable tbody');
  tbody.innerHTML = `<tr><td colspan="5" class="text-center py-8 text-gray-400 dark:text-gray-500">Carregando incidentes...</td></tr>`;

  try {
    const res = await fetch('fetch_incidents.php');
    const json = await res.json();

    if (!json.success) throw new Error(json.error || 'Erro desconhecido');

    const incidentes = json.data;
    tbody.innerHTML = '';

    const contadores = { 'Desastre': 0, 'Alta': 0, 'Média': 0 };

    incidentes.forEach(inc => {
      // 🔹 converte severidade numérica para texto
      let severidadeNome = 'Baixa';
      switch (parseInt(inc.severity)) {
        case 5: severidadeNome = 'Desastre'; break;
        case 4: severidadeNome = 'Alta'; break;
        case 3: severidadeNome = 'Média'; break;
        case 2: severidadeNome = 'Baixa'; break;
        case 1: severidadeNome = 'Informativa'; break;
      }

      if (contadores[severidadeNome] !== undefined) contadores[severidadeNome]++;

      // 🔹 define cores do badge
      let badgeColor = 'bg-gray-200 text-gray-900';
      if (severidadeNome === 'Desastre') badgeColor = 'bg-red-100 text-red-600';
      else if (severidadeNome === 'Alta') badgeColor = 'bg-orange-100 text-orange-600';
      else if (severidadeNome === 'Média') badgeColor = 'bg-yellow-100 text-yellow-700';

      const tr = document.createElement('tr');
      tr.className = 'hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors';
      tr.innerHTML = `
        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">${inc.host || '-'}</td>
        <td class="px-6 py-4 text-gray-700 dark:text-gray-300">${inc.name}</td>
        <td class="px-6 py-4">
          <span class="px-3 py-1 rounded-full text-xs font-semibold ${badgeColor}">${severidadeNome}</span>
        </td>
        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">${inc.time}</td>
        <td class="px-6 py-4 text-right">
          <button class="copy-btn bg-iosBlue hover:bg-iosBlueHover text-white text-sm px-4 py-1.5 rounded-full shadow transition-all">📋 Copiar</button>
        </td>
      `;

      // 🔹 ação do botão copiar
      tr.querySelector('.copy-btn').addEventListener('click', () => {
        const texto = `Para conhecimento,\n\nHost: ${inc.host}\nEvento: ${inc.name}\n\nSeveridade: ${severidadeNome}\n\nData e hora de início:\t${inc.time}`;
        navigator.clipboard.writeText(texto);
        const btn = tr.querySelector('.copy-btn');
        btn.innerText = '✅ Copiado!';
        btn.classList.replace('bg-iosBlue', 'bg-green-500');
        setTimeout(() => {
          btn.innerText = '📋 Copiar';
          btn.classList.replace('bg-green-500', 'bg-iosBlue');
        }, 1800);
      });

      tbody.appendChild(tr);
    });

    // 🔹 Atualiza os contadores dos cards
    document.getElementById('cardDesastre').innerText = contadores['Desastre'];
    document.getElementById('cardAlta').innerText = contadores['Alta'];
    document.getElementById('cardMedia').innerText = contadores['Média'];

    const now = new Date();
    document.getElementById('updateTime').innerText =
      'Atualizado às ' + now.toLocaleTimeString('pt-BR');

  } catch (err) {
    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-8 text-red-500">Erro ao carregar incidentes: ${err.message}</td></tr>`;
  }
}

// 🔄 Executa ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
  carregarIncidentes();
  setInterval(carregarIncidentes, 60000); // atualiza a cada 1 min
});
