<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Authorize;
use SAE\PHPCMS\Controller;

final class Index extends Controller {

    /**
     * Index
     *
     * @access  public
     * @return  void
     */
    public function index() : void {
        if ( !Authorize::login() ) {
            $this->redirect( '/login' );
        }

        echo "User Area: Index->index()";
    }

}