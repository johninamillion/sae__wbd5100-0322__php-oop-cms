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
