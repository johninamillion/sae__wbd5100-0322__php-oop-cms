<?php

namespace SAE\PHPCMS\Controller;

final class User {

    public function index() : void {
        echo "User->index()";
    }

    public function profile( ?string $username = 'Default!' ) : void {
        echo "User->profile( $username )";
    }

}