<?php
/**
 * fetch_incidents.php
 * Busca incidentes (problemas ativos) do Zabbix via API JSON-RPC usando login/senha
 */

header('Content-Type: application/json');

// Carrega as configurações
require_once 'config.php';

$zabbix_url  = ZABBIX_URL;
$zabbix_user = ZABBIX_USER;
$zabbix_pass = ZABBIX_PASS;

// Função genérica de requisição
function zabbix_api($url, $method, $params, $auth = null) {
    static $id = 1;
    $payload = [
        'jsonrpc' => '2.0',
        'method'  => $method,
        'params'  => $params,
        'id'      => $id++,
    ];
    if ($auth !== null) $payload['auth'] = $auth;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}

try {
    // 1️⃣ LOGIN
    $login = zabbix_api($zabbix_url, 'user.login', [
        'username' => $zabbix_user,
        'password' => $zabbix_pass
    ]);

    if (!isset($login['result'])) {
        throw new Exception("Erro de login: " . json_encode($login));
    }

    $auth = $login['result'];

    // 2️⃣ PEGAR PROBLEMAS ATIVOS
    $problems = zabbix_api($zabbix_url, 'problem.get', [
        'output' => ['eventid', 'name', 'severity', 'clock', 'objectid'],
        'selectAcknowledges' => 'extend',
        'sortfield' => ['eventid'],
        'sortorder' => 'DESC',
        'recent' => true,
        'limit' => 20
    ], $auth);

    if (!isset($problems['result'])) {
        throw new Exception("Erro ao buscar problemas: " . json_encode($problems));
    }

    // 3️⃣ Para cada problema, buscar o host
    $data = [];
    foreach ($problems['result'] as $p) {
        // Buscar informações do trigger/host
        $trigger = zabbix_api($zabbix_url, 'trigger.get', [
            'output' => ['description'],
            'triggerids' => $p['objectid'],
            'selectHosts' => ['host', 'name']  // ✅ selectHosts funciona em trigger.get
        ], $auth);

        $hostname = '-';
        if (isset($trigger['result'][0]['hosts'][0]['host'])) {
            $hostname = $trigger['result'][0]['hosts'][0]['host'];
        }

        $data[] = [
            'eventid'  => $p['eventid'],
            'host'     => $hostname,
            'name'     => $p['name'],
            'severity' => $p['severity'],
            'time'     => date('d/m/Y H:i:s', $p['clock'])
        ];
    }

    // 4️⃣ LOGOUT
    zabbix_api($zabbix_url, 'user.logout', [], $auth);

    echo json_encode(['success' => true, 'data' => $data], JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}