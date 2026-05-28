📋 Sobre o Projeto
Dashboard intuitivo e responsivo que permite visualizar, filtrar e gerenciar incidentes do Zabbix de forma eficiente. Com integração completa à API do Zabbix, o sistema oferece funcionalidades avançadas para equipes de NOC/SOC.

Principais Funcionalidades

 *Autenticação Segura - Login integrado com Zabbix API
 *Dashboard em Tempo Real - Atualização automática a cada 60 segundos
 *Filtros Inteligentes - Severidade e duração configuráveis
 *Sistema de Checklist - Marque incidentes já atendidos
 *Captura de Screenshots - Gere imagens das linhas de incidente
 *Integração WhatsApp - Envie notificações formatadas
 *Reconhecimento ITSM - Templates para abertura de chamados
 *Dark Mode - Tema escuro automático
 *Design Responsivo - Funciona em desktop, tablet e mobile


Tecnologias Utilizadas
Backend

PHP 7.4+ - Linguagem principal
cURL - Requisições HTTP para API Zabbix
Sessions - Gerenciamento de autenticação

Frontend

HTML5 - Estrutura semântica
Tailwind CSS 3.x - Framework CSS utilitário
JavaScript ES6+ - Interatividade e lógica
html2canvas - Captura de screenshots

Integrações

Zabbix API (JSON-RPC) - Comunicação com servidor Zabbix
WhatsApp Web API - Envio de mensagens


Requisitos
Servidor

PHP >= 7.4
Apache/Nginx
Extensões PHP:

curl
json
session


Zabbix

Zabbix Server >= 5.0
API habilitada
Usuário com permissões de leitura

