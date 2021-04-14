<?php

exec('cypress cache path', $cypressPath);
exec('cypress version --component package', $cypressVersion);

$appFile = $cypressPath.'/'.$cypressVersion.'/Cypress/resources/app/packages/server/config/app.yml';

$appContent = file_get_contents($appFile);
$appContent = str_replace('https://api.cypress.io/', getenv('CYPRESS_API_URL'), $appContent);

file_put_contents($appFile, $appContent);
