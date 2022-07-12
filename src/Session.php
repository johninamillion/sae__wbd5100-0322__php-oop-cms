<?php

namespace SAE\PHPCMS;

abstract class Session {

    /**
     * Get value by key
     *
     * @access  public
     * @static
     * @param   string  $key
     * @return  mixed
     */
    public static function get( string $key ) : mixed {

        return $_SESSION[ $key ] ?? NULL;
    }

    /**
     * Isset value by key
     *
     * @access  public
     * @static
     * @param   string  $key
     * @return  bool
     */
    public static function isset( string $key ) : bool {

        return isset( $_SESSION[ $key ] );
    }

    /**
     * Set key value
     *
     * @access  public
     * @static
     * @param   string  $key
     * @param   mixed   $value
     * @return  void
     */
    public static function set( string $key, mixed $value ) : void {
        $_SESSION[ $key ] = $value;
    }

    /**
     * Start session
     *
     * @access  public
     * @static
     * @return  void
     */
    public static function start() : void {
        session_start();
    }

}