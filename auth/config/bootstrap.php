<?php
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Core\Configure;
use Cake\Routing\Router;

Configure::load('CakeDC/Auth.auth');
Configure::write('Users.config', ['users']);
Plugin::load('CakeDC/Users', ['routes' => true, 'bootstrap' => true]);
//Plugin::load('DebugKit', ['bootstrap' => true, 'routes' => true, 'middleware' => true]);
//Configure::write('OneTimePasswordAuthenticator.login', true);
$oauthPath = Configure::read('OAuth.path');
if (is_array($oauthPath)) {
    Router::scope('/auth', function ($routes) use ($oauthPath) {
        $routes->connect(
            '/:provider',
            $oauthPath,
            ['provider' => implode('|', array_keys(Configure::read('OAuth.providers')))]
        );
    });
}
