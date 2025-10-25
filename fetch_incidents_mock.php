<?php
/**
 * Simulação de resposta da API do Zabbix
 * Compatível com PHP 5.6 - 8.0
 * Use este arquivo enquanto o acesso à API real não estiver disponível.
 */

// Garante cabeçalho JSON
header('Content-Type: application/json; charset=utf-8');

// Lista simulada de incidentes
$data = array(
    array(
        'host' => 'Aplicacao Monitora Teste',
        'evento' => 'Lentidão ao acessar a aplicação "https://TESTE.br/monitorar". A página está demorando a responder.',
        'severidade' => 'Desastre',
        'data' => '25-10-2025 01:08:52'
    ),
    array(
        'host' => 'RHSITESTE',
        'evento' => 'Conexão do IC RHSITESTE com TESTE - APP SICONTESTE - com lentidão',
        'severidade' => 'Alta',
        'data' => '25-10-2025 01:07:40'
    ),
    array(
        'host' => 'RHSICTESTE',
        'evento' => 'Conexão do IC RHSICTESTE com TESTE - APP SICONTESTE - com lentidão',
        'severidade' => 'Alta',
        'data' => '25-10-2025 01:06:15'
    ),
    array(
        'host' => 'RHSICONTESTE',
        'evento' => 'Conexão do IC RHSICONTESTE com TESTE - APP SICONTESTE - com lentidão',
        'severidade' => 'Média',
        'data' => '25-10-2025 01:04:33'
    ),
    array(
        'host' => 'ESS4TESTE066.TESTE.net',
        'evento' => 'VMware TESTE: Health status Red (3)',
        'severidade' => 'Desastre',
        'data' => '25-10-2025 01:02:10'
    ),
    array(
        'host' => 'BKP DBTESTE01.mds.net',
        'evento' => 'Utilization of housekeeper processes over 75%',
        'severidade' => 'Alta',
        'data' => '25-10-2025 00:58:55'
    ),
    array(
        'host' => 'WTESTE.TESTE.net',
        'evento' => 'Windows: The Memory Pages/sec is too high (over 1000 for 5m)',
        'severidade' => 'Média',
        'data' => '25-10-2025 00:54:21'
    )
);

// Retorna o JSON
echo json_encode($data);
