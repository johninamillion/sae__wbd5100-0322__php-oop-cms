<?php

namespace SAE\PHPCMS\Model\Traits;

trait Users {

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