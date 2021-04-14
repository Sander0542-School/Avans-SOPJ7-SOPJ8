<?php

exec('npx cypress cache path', $cypressPath);
exec('npx cypress version --component package', $cypressVersion);

$appFile = $cypressPath[0].'/'.$cypressVersion[0].'/Cypress/resources/app/packages/server/config/app.yml';

echo 'Cypress config file found at: '.$appFile;

$cypressAPI = 'https://api.cypress.io/';
$newAPI = getenv('CYPRESS_API_URL');

echo 'Replacing `'.$cypressAPI.'` with `'.$newAPI.'`';

$appContent = file_get_contents($appFile);
$appContent = str_replace($cypressAPI, $newAPI, $appContent);
file_put_contents($appFile, $appContent);
