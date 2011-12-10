<?php
chdir(dirname(__DIR__));
require_once 'vendor/ZendFramework/library/Zend/Loader/AutoloaderFactory.php';

Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array()));

$appConfig = array_merge_recursive(
    include 'config/application.global.php',
    include 'config/application.local.php'
);

$moduleManager    = new Zend\Module\Manager($appConfig['modules']);
$listenerOptions  = new Zend\Module\Listener\ListenerOptions($appConfig['module_listener_options']);
$defaultListeners = new Zend\Module\Listener\DefaultListenerAggregate($listenerOptions);

$defaultListeners->getConfigListener()->addConfigGlobPath('config/resource/*.{global,local}.php');

$moduleManager->events()->attachAggregate($defaultListeners);
$moduleManager->loadModules();

// Create application, bootstrap, and run
$bootstrap = new Zend\Mvc\Bootstrap($defaultListeners->getConfigListener()->getMergedConfig());
$application = new Zend\Mvc\Application;

$bootstrap->bootstrap($application);

$application->run()->send();