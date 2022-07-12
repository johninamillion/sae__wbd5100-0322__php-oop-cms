<?php

namespace SAE\PHPCMS\Model;

use SAE\PHPCMS\Model;
use SAE\PHPCMS\Model\Traits\Users;
use SAE\PHPCMS\Session;

final class Login extends Model {

    use Users;

    /**
     * Get credentials by username
     *
     * @access  public
     * @param   string|NULL $username
     * @return  array
     */
    public function getCredentials( ?string $username ) : array {
        /** @var string $query */
        $query = 'SELECT id, password, salt FROM users WHERE username = :username;';

        /** @var \PDOStatement $Statement */
        $Statement = $this->Database->prepare( $query );
        $Statement->bindValue( ':username', $username );
        $Statement->execute();

        return $Statement->fetch();
    }
    /**
     * Login
     *
     * @access  public
     * @param   string|NULL $username
     * @param   string|NULL $password
     * @return  bool
     */
    public function login( ?string $username, ?string $password ) : bool {
        if ( $this->usernameExists( $username ) ) {
            /** @var array $credentials */
            $credentials = $this->getCredentials( $username );
            /** @var string $hashed_password */
            $hashed_password = $this->hashPassword( $password, $credentials[ 'salt' ] );

            if ( $hashed_password === $credentials[ 'password' ] ) {
                Session::set( 'login', [
                    'id'        => $credentials[ 'id' ],
                    'timestamp' => time()
                ] );

                return TRUE;
            }
        }

        return FALSE;
    }

}