<?php

namespace SAE\PHPCMS;

/**
 * Controller
 *
 * Controller is an abstract class contains all methods and properties that could be used in the controllers of this application.
 * This class should be used as parent for all controllers in this application.
 * This class should be used statically and should not be initialized.
 *
 * @abstract
 */
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
     * Is Method
     *
     * Check if the request method equals the method passed as argument.
     *
     * @access  protected
     * @param   string  $method
     * @return  bool
     */
    protected function isMethod( string $method ) : bool {

        return $_SERVER[ 'REQUEST_METHOD' ] === $method;
    }

    /**
     * Redirect
     *
     * Redirect the user to another location in the application.
     *
     * @access  protected
     * @param   string  $location
     * @return  void
     */
    protected function redirect( string $location ) : void {
        header( "Location: {$location}" );
    }

    /**
     * Set Response Code
     *
     * Set a http response code.
     *
     * @access  protected
     * @param   int     $code
     * @return  void
     */
    protected function setResponseCode( int $code ) : void {
        http_response_code( $code );
    }

    /**
     * Construct
     *
     * @access  public
     * @constructor
     */
    public function __construct() {
        $this->View = new View();
    }

    /**
     * Index
     *
     * Any child of this class should contain an index method returning void.
     * This method should build a view for the controller.
     *
     * @access  public
     * @abstract
     * @return  void
     */
    abstract public function index() : void;

}
