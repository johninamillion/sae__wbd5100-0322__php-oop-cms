<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Controller;
use SAE\PHPCMS\Model\Register as RegisterModel;

final class Register extends Controller {

    /**
     * Register Model
     *
     * @access  private
     * @var     RegisterModel|NULL
     */
    private ?RegisterModel $Model = NULL;

    /**
     * Construct
     *
     * @access  public
     * @constructor
     */
    public function __construct() {
        $this->Model = new RegisterModel();
        parent::__construct();
    }

    /**
     * Index
     *
     * @access  public
     * @return  void
     */
    public function index(): void {
        $this->View->setTitle( _( 'Registration' ) );
        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'register/index' );
        $this->View->getTemplatePart( 'footer' );
    }

}