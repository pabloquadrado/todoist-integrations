<?php

define('ENVIRONMENT', $_SERVER['HTTP_HOST'] == 'localhost' ? 'DEV' : 'PROD');

define('BASE_URL', ENVIRONMENT == 'DEV'
    ? 'dev-url' // domínio local
    : 'production-url' // domínio produção
);

define('API_KEY', '1234'); // api key da conta do todoist