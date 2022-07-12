<?php

namespace SAE\PHPCMS;

/**
 * Authorize
 *
 * Authorize is an abstract class to authorize the user login and handle the session timeout.
 * This class could be used to handle user privileges (read, write, ...) and roles (admin, subscriber, ...).
 * This class should be used statically and should not be initialized.
 *
 * @abstract
 */
abstract class Authorize {

    /**
     * Authorize login
     *
     * @access  public
     * @static
     * @return  bool
     */
    public static function login() : bool {

        return Session::isset( 'login' );
    }

    /**
     * Login timeout
     *
     * @access  public
     * @static
     * @return  void
     */
    public static function loginTimeout() : void {
        if ( !Session::isset( 'login' ) ) {

            return;
        }

        /** @var array $login */
        $login = Session::get( 'login' );
        /** @var int $now */
        $now = time();

        if ( ( $now - $login[ 'timestamp' ] ) < SESSION_TIMEOUT ) {
            $_SESSION[ 'login' ][ 'timestamp' ] = $now;
        }
        else {
            Session::unset( 'login' );
        }
    }

}