<?php

namespace SAE\PHPCMS\Model;

use SAE\PHPCMS\Model;
use SAE\PHPCMS\Model\Traits\Users;
use SAE\PHPCMS\Session;

final class Login extends Model {

    use Users;

    /**
     * Create password
     *
     * @access  private
     * @return  string
     */
    private function createPassword() : string {
        /** @var int $time */
        $time = time();
        /** @var int $rand */
        $rand = rand( 1, 99999 );

        return md5( "a{$time}-{$rand}Z" );
    }

    /**
     * Get credentials by username
     *
     * @access  private
     * @param   string|NULL $username
     * @return  array
     */
    private function getCredentials( ?string $username ) : array {
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

        $this->addError( 'username', _( 'Combination of username and password is incorrect' ) );

        return FALSE;
    }

    /**
     * Reset password
     *
     * @access  public
     * @param   string|NULL $email
     * @return  bool
     */
    public function reset( ?string $email ) : bool {
        if ( $this->emailExists( $email ) ) {
            /** @var string $new_password */
            $new_password = $this->createPassword();
            /** @var string $new_salt */
            $new_salt = $this->createSalt();
            /** @var string $new_hashed_password */
            $new_hashed_password = $this->hashPassword( $new_password, $new_salt );

            /** @var string $query */
            $query = 'UPDATE users SET password = :password, salt = :salt WHERE email = :email;';
            /** @var \PDOStatement $Statement */
            $Statement = $this->Database->prepare( $query );
            $Statement->bindValue( ':password', $new_hashed_password );
            $Statement->bindValue( ':salt', $new_salt );
            $Statement->bindValue( ':email', $email );
            $Statement->execute();

            // TODO: Send mail with the new password!
        }

        return FALSE;
    }

}