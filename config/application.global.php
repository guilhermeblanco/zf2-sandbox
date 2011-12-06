<?php

return array(
    'module_paths' => array(
        realpath(APPLICATION_ROOT . '/module'),
        realpath(APPLICATION_ROOT . '/vendor'),
    ),

    'modules' => array(
        'Application',
    ),

    'module_listener_options' => array(
        'config_cache_enabled'    => false,
        'cache_dir'               => realpath(APPLICATION_ROOT . '/data/cache'),
        'application_environment' => getenv('APPLICATION_ENV'),
    ),
);