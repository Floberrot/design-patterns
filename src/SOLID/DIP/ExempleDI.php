<?php

use App\SOLID\DIP\ExternalLoginService;
use App\SOLID\DIP\FakeLoginProvider;
use App\SOLID\DIP\User;
use App\SOLID\DIP\UserAuthService;

$authProvider = new ExternalLoginService();
$userAuthService = new UserAuthService($authProvider);

$user = new User();
$user->setEmail('john.doe@email.com');
$user->setPassword('securePassword');

$userAuthService->login($user);

$authProviderFake = new FakeLoginProvider();
$userAuthServiceFake = new UserAuthService($authProviderFake);

$userFake = new User();
$userFake->setEmail('test.test@com');
$userFake->setPassword('test123');
$userAuthServiceFake->login($userFake);
