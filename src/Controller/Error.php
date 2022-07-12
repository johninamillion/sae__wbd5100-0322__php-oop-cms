<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Controller;

final class Error extends Controller {

    /**
     * Get Message
     *
     * @access  public
     * @static
     * @param   int     $code
     * @return  string|NULL
     */
    public static function getMessage( int $code ) : ?string {
        /** @var array $messages */
        $messages = [
            '400'   =>  _( "Bad Request" ),
            '401'   =>  _( "Unauthorized" ),
            '402'   =>  _( "Payment Required" ),
            '403'   =>  _( "Forbidden" ),
            '404'   =>  _( "Not Found" ),
            '405'   =>  _( "Method Not Allowed" ),
            '406'   =>  _( "Not Acceptable" ),
            '407'   =>  _( "Proxy Authentication Required" ),
            '408'   =>  _( "Request Timeout" ),
            '409'   =>  _( "Conflict" ),
            '410'   =>  _( "Gone" ),
            '411'   =>  _( "Length Required" ),
            '412'   =>  _( "Precondition Failed" ),
            '413'   =>  _( "Payload Too Large" ),
            '414'   =>  _( "URI Too Long" ),
            '415'   =>  _( "Unsupported Media Type" ),
            '416'   =>  _( "Range Not Satisfiable" ),
            '417'   =>  _( "Expectation Failed" ),
            '418'   =>  _( "I'm a teapot" ),
            '422'   =>  _( "Unprocessable Entity" ),
            '425'   =>  _( "Too Early" ),
            '426'   =>  _( "Upgrade Required" ),
            '428'   =>  _( "Precondition Required" ),
            '429'   =>  _( "Too many Requests" ),
            '431'   =>  _( "Request Header Fields Too Large" ),
            '451'   =>  _( "Unavailable For Legal Reasons" ),
        ];

        return $messages[ $code ] ?? NULL;
    }

    /**
     * Index
     *
     * @access  public
     * @param   int     $code
     * @return  void
     */
    public function index( int $code = 404 ): void {
        $this->setResponseCode( $code );

        $this->View->setTitle( sprintf( _( 'Error %1$s - %2$s' ), $code, self::getMessage( $code ) ) );

        $this->View->getTemplatePart( 'header' );
        if ( !$this->View->getTemplatePart( "error/$code" ) ) {
            printf( '<h1>%1$s - <i>%2$s</i></h1>', sprintf( _( "Error %s" ), $code ), self::getMessage( $code ) );
        }
        $this->View->getTemplatePart( 'footer' );
    }

}