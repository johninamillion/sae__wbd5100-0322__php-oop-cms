<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Controller;

final class Login extends Controller {

    public function index(): void {
        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'login/index' );
        $this->View->getTemplatePart( 'footer' );
    }

}
