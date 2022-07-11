<?php

namespace SAE\PHPCMS;

// Enable error reporting in Browser
error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

/**
 * Load autoload file
 *
 * @return  void
 */
function load_autoloader() : void {
    /** @var string $autoload_file */
    $autoload_file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

    if ( !file_exists( $autoload_file ) ) {
        trigger_error(
            sprintf(
                _( 'The autoload file (%s) doesn\'t exist. Please make sure you run composer update in the application directory.' ),
                $autoload_file
            ),
            E_USER_ERROR
        );
    }

    require_once $autoload_file;
}

/**
 * Load configuration file
 *
 * @return  void
 */
function load_config() : void {
    /** @var string $config_file */
    $config_file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';

    if ( !file_exists( $config_file ) ) {
        trigger_error(
            sprintf(
                _( 'The configuration file (%s) doesn\'t exist. Please make sure there is a valid config.php in the application directory.' ),
                $config_file
            ),
            E_USER_ERROR
        );
    }

    require_once $config_file;
}

/**
 * Run application
 *
 * Create an anonym instance of application and call run.
 *
 * @return  void
 */
function run_application() : void {
    ( new Application() )->run();
}

load_autoloader();
load_config();
run_application();