<?php

namespace SAE\PHPCMS;

abstract class Controller {

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     * View
     *
     * @access  protected
     * @var     View|NULL
     */
    protected ?View $View = NULL;

    /**
     * @access  protected
     * @param   string  $method
     * @return  bool
     */
    protected function isMethod( string $method ) : bool {

        return $_SERVER[ 'REQUEST_METHOD' ] === $method;
    }

    /**
     * @access  protected
     * @param   string  $location
     * @return  void
     */
    protected function redirect( string $location ) : void {
        header( "Location: {$location}" );
    }

    /**
     * @access  protected
     * @param   int     $code
     * @return  void
     */
    protected function setResponseCode( int $code ) : void {
        http_response_code( $code );
    }

    /**
     * @access  public
     * @constructor
     */
    public function __construct() {
        $this->View = new View();
    }

    /**
     * Index
     *
     * @access  public
     * @abstract
     * @return  void
     */
    abstract public function index() : void;

}
