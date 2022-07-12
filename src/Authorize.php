<?php

namespace SAE\PHPCMS;

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