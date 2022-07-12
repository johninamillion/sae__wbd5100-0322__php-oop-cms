<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Controller;
use SAE\PHPCMS\Model\Login as LoginModel;

final class Login extends Controller {

    /**
     * Login Model
     *
     * @access  private
     * @var     LoginModel|NULL
     */
    private ?LoginModel $Model = NULL;

    /**
     * Construct
     *
     * @access  public
     * @constructor
     */
    public function __construct() {
        $this->Model = new LoginModel();
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
            /** @var string|NULL $password */
            $password = filter_input( INPUT_POST, 'password' );

            if ( $this->Model->login( $username, $password ) ) {
                $this->redirect( '/' );
            }
        }

        $this->View->setTitle( _( 'Login' ) );
        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'login/index' );
        $this->View->getTemplatePart( 'footer' );
    }

}
