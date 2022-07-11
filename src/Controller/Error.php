<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Controller;

final class Error extends Controller {

    /**
     * Index
     *
     * @access  public
     * @param   int|NULL    $code
     * @return  void
     */
    public function index( ?int $code = 404 ): void {
        $this->setResponseCode( $code );

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'error/404' );
        $this->View->getTemplatePart( 'footer' );
    }

}