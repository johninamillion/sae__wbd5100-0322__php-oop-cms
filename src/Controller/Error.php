<?php

namespace SAE\PHPCMS\Controller;

use SAE\PHPCMS\Controller;

final class Error extends Controller {

    /**
     * Index
     *
     * @access  public
     * @param   int|NULL    $status
     * @return  void
     */
    public function index( ?int $status = 404 ): void {
        http_response_code( $status );

        $this->View->getTemplatePart( 'header' );
        $this->View->getTemplatePart( 'error/404' );
        $this->View->getTemplatePart( 'footer' );
    }

}