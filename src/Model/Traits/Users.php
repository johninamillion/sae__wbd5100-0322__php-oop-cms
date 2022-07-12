<?php

namespace SAE\PHPCMS\Model\Traits;

trait Users {

    /**
     * Create salt
     *
     * @access  private
     * @return  string
     */
    private function createSalt() : string {
        /** @var int $time */
        $time = time();
        /** @var int $rand */
        $rand = rand( 1, 99999 );

        return hash( 'sha512', "{$time}{$rand}" );
    }

    /**
     * Check if email exists
     *
     * @access  private
     * @param   string|NULL $email
     * @return  bool
     */
    private function emailExists( ?string $email ) : bool {
        /** @var string $query */
        $query = 'SELECT email FROM users WHERE email = :email;';
        /** @var \PDOStatement $Statement */
        $Statement = $this->Database->prepare( $query );
        $Statement->bindValue( ':email', $email );
        $Statement->execute();

        return $Statement->rowCount() > 0;
    }

    /**
     * Hash password
     *
     * @access  private
     * @param   string  $password
     * @param   string  $salt
     * @return  string
     */
    private function hashPassword( string $password, string $salt ) : string {

        return hash( 'sha512', "{$salt}{$password}" );
    }

    /**
     * Check if username exists
     *
     * @access  private
     * @param   string|NULL $username
     * @return  bool
     */
    private function usernameExists( ?string $username ) : bool {
        /** @var string $query */
        $query = 'SELECT username FROM users WHERE username = :username;';
        /** @var \PDOStatement $Statement */
        $Statement = $this->Database->prepare( $query );
        $Statement->bindValue( ':username', $username );
        $Statement->execute();

        return $Statement->rowCount() > 0;
    }

}