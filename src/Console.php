<?php

namespace SAE\PHPCMS;

/**
 * Console
 *
 * Console log is an abstract with static functions to create output to the web console.
 * This class should be used statically and should not be initialized.
 *
 * @abstract
 */
abstract class Console {

    /**
     * Debug
     *
     * This method outputs a message to the web console on the debug level.
     *
     * @access  public
     * @static
     * @param   string  $message
     * @return  void
     */
    public static function debug( string $message ) : void {
        printf(
            "<script type=\"text/javascript\">console.debug( '%s' )</script>",
            $message
        );
    }

    /**
     * Error
     *
     * This method outputs an error message to the web console.
     *
     * @access  public
     * @static
     * @param   string  $message
     * @return  void
     */
    public static function error( string $message ) : void {
        printf(
            "<script type=\"text/javascript\">console.error( '%s' )</script>",
            $message
        );
    }

    /**
     * Log
     *
     * This method outputs a message to the web console.
     *
     * @access  public
     * @static
     * @param   string  $message
     * @return  void
     */
    public static function log( string $message ) : void {
        printf(
            "<script type=\"text/javascript\">console.log( '%s' )</script>",
            $message
        );
    }

    /**
     * Info
     *
     * This method outputs an informational message to the web console.
     *
     * @access  public
     * @static
     * @param   string  $message
     * @return  void
     */
    public static function info( string $message ) : void {
        printf(
            "<script type=\"text/javascript\">console.info( '%s' )</script>",
            $message
        );
    }

}