<?php

namespace SAE\PHPCMS;

abstract class Controller {

    /**
     * View
     *
     * @access  protected
     * @var     View|NULL
     */
    protected ?View $View = NULL;

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
