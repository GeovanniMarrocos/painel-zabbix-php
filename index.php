<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel de Incidentes Zabbix</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- ✅ Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ✅ Script externo -->
  <script src="assets/script.js" defer></script>
</head>

<body class="bg-softLight dark:bg-softDark transition-colors font-sans min-h-screen antialiased text-gray-900 dark:text-gray-100">

  <!-- Header -->
  <header class="sticky top-0 bg-white/70 dark:bg-gray-900/60 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 shadow-sm z-10">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-semibold flex items-center gap-2">
        <img src="./assets/img/Zabbix_logo.svg.png" alt="Logo Zabbix" width="100" height="30" class="inline-block">
        Painel de Incidentes
      </h1>
      <span id="updateTime" class="text-sm text-gray-500 dark:text-gray-400"></span>
    </div>
  </header>

  <!-- Conteúdo -->
  <main class="max-w-6xl mx-auto px-6 py-10 space-y-10">

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
      <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-smooth text-center p-6 hover:shadow-lg transition">
        <h2 class="text-lg font-medium text-iosRed">Desastre</h2>
        <p id="cardDesastre" class="text-5xl font-semibold mt-2 text-iosRed">0</p>
      </div>

      <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-smooth text-center p-6 hover:shadow-lg transition">
        <h2 class="text-lg font-medium text-iosOrange">Alta</h2>
        <p id="cardAlta" class="text-5xl font-semibold mt-2 text-iosOrange">0</p>
      </div>

      <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-smooth text-center p-6 hover:shadow-lg transition">
        <h2 class="text-lg font-medium text-iosYellow">Média</h2>
        <p id="cardMedia" class="text-5xl font-semibold mt-2 text-iosYellow">0</p>
      </div>
    </div>

    <!-- Tabela -->
    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-smooth overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="incidentTable">
        <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-600 dark:text-gray-400 text-sm uppercase">
          <tr>
            <th class="px-6 py-3 text-left">Host</th>
            <th class="px-6 py-3 text-left">Evento</th>
            <th class="px-6 py-3 text-left">Severidade</th>
            <th class="px-6 py-3 text-left">Data/Hora</th>
            <th class="px-6 py-3 text-right">Ação</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
          <tr><td colspan="5" class="text-center py-8 text-gray-400 dark:text-gray-500">Carregando incidentes...</td></tr>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Rodapé -->
  <footer class="text-center text-gray-500 dark:text-gray-400 text-sm py-8">
    Desenvolvido por <span class="text-iosBlue font-medium">Geovanni Matheus</span>
  </footer>
</body>
</html>
