<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Controller;
use SAE\PHPCMS\Session;

final class Logout extends Controller {

    /**
     * Index
     *
     * @access  public
     * @return  void
     */
    public function index() : void {
        Session::unset( 'login' );
        $this->redirect( '/login' );
    }

}