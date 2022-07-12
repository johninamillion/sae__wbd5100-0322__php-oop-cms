<?php

/*
 * Configuration File
 *
 * This file is used to define variables for application paths, database connection, session timeout and similar.
 * Write down all values that should be configurable by the owner of the application here.
 *
 * Attention:
 * Do not release any login data for the database connection publicly on GitHub or similar.
 */

define( 'APP_ROOT_DIR',     __DIR__ );
define( 'APP_PUBLIC_DIR',   __DIR__ . DIRECTORY_SEPARATOR . 'public' );
define( 'APP_TEMPLATE_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'templates' );

define( 'DATABASE_TYPE',    'mysql' );
define( 'DATABASE_HOST',    'localhost' );
define( 'DATABASE_CHARSET', 'utf8' );
define( 'DATABASE_PORT',    '3306' );
define( 'DATABASE_NAME',    'sae_5100_0322_cms' );
define( 'DATABASE_USER',    'root' );
define( 'DATABASE_PASS',    'root' );

define( 'SESSION_TIMEOUT',  180 );