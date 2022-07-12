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
        if ( $this->isMethod( self::METHOD_POST ) ) {
            /** @var string|NULL $username */
            $username = filter_input( INPUT_POST, 'username' );
            /** @var string|NULL $email */
            $email = filter_input( INPUT_POST, 'email' );
            /** @var string|NULL $password */
            $password = filter_input( INPUT_POST, 'password' );
            /** @var string|NULL $password_repeat */
            $password_repeat = filter_input( INPUT_POST, 'password_repeat' );

            if ( $this->Model->register( $username, $email, $password, $password_repeat ) ) {
                $this->redirect( '/login' );
            }
        }

        $this->View->setTitle( _( 'Registration' ) );
        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'register/index' );
        $this->View->getTemplatePart( 'footer' );
    }

}