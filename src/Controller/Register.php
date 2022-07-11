<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Controller;

final class Register extends Controller {

    public function index(): void {
        $this->View->setTitle( _( 'Registration' ) );
        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'register/index' );
        $this->View->getTemplatePart( 'footer' );
    }

}