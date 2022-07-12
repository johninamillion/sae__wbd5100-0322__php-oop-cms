<?php

namespace SAE\PHPCMS\Model;

use SAE\PHPCMS\Model;

final class Register extends Model {

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

    /**
     * Validate E-Mail
     *
     * @access  private
     * @param   string|NULL $email
     * @return  bool
     */
    private function validateEmail( ?string $email ) : bool {
        // Check if the email address is empty
        if ( empty( $email ) ) {
            $this->addError( 'email', _( 'The email should not be empty' ) );
        }
        // Check if the email address is invalid
        if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $this->addError( 'email', _( 'The email is not valid' ) );
        }
        // Check if the email already exists
        if ( $this->emailExists( $email ) ) {
            $this->addError( 'email', _( 'The email already exists' ) );
        }

        return !$this->hasErrors( 'email' );
    }

    /**
     * Validate password
     *
     * @access  private
     * @param   string|NULL $password
     * @param   string|NULL $password_repeat
     * @return  bool
     */
    private function validatePassword( ?string $password, ?string $password_repeat ) : bool {
        // Check if the password is empty
        if ( empty( $password ) ) {
            $this->addError( 'password', _( 'The password should not be empty' ) );
        }
        // Check if the password is too short
        if ( strlen( $password ) < 8 ) {
            $this->addError( 'password', _( 'The password should be minimum 8 characters long' ) );
        }
        // Check if the password contain any whitespace
        if ( preg_match( '/\s/', $password ) ) {
            $this->addError( 'password', _( 'The password should not contain any whitespace' ) );
        }
        // Check if the password not contain any digits
        if ( !preg_match( '/\d/', $password ) ) {
            $this->addError( 'password', _( 'The password should contain minimum 1 digit' ) );
        }
        // Check if the password not contain any special characters
        if ( !preg_match( '/\W/', $password ) ) {
            $this->addError( 'password', _( 'The password should contain minimum 1 special character' ) );
        }
        // Check if the password not contain any lowercase characters
        if ( !preg_match( '/[a-z]/', $password ) ) {
            $this->addError( 'password', _( 'The password should contain minimum 1 lowercase character' ) );
        }
        // Check if the password not contain any uppercase characters
        if ( !preg_match( '/[A-Z]/', $password ) ) {
            $this->addError( 'password', _( 'The password should contain minimum 1 uppercase character' ) );
        }
        // Check if the password is not the same as the password repeated
        if ( $password !== $password_repeat ) {
            $this->addError( 'password', _( 'The password doesn\'t match the repeated password' ) );
        }

        return !$this->hasErrors( 'password' );
    }

    /**
     * Validate username
     *
     * @access  private
     * @param   string|NULL $username
     * @return  bool
     */
    private function validateUsername( ?string $username ) : bool {
        // Check if the username is empty
        if ( empty( $username ) ) {
            $this->addError( 'username', _( 'The username should not be empty' ) );
        }
        // Check if the username is too short
        if ( strlen( $username ) < 4 ) {
            $this->addError( 'username', _( 'The username should be minimum 4 characters long' ) );
        }
        // Check if the username is too long
        if ( strlen( $username ) > 24 ) {
            $this->addError( 'username', _( 'The username should be maximum 24 characters long' ) );
        }
        // Check if the username contains any whitespace
        if ( preg_match( '/\s/', $username ) ) {
            $this->addError( 'username', _( 'The username should not contain any whitespace' ) );
        }
        // Check if the username already exists
        if ( $this->usernameExists( $username ) ) {
            $this->addError( 'username', _( 'The username already exists' ) );
        }

        return !$this->hasErrors( 'username' );
    }

    /**
     * Register user
     *
     * @access  public
     * @param   string|NULL $username
     * @param   string|NULL $email
     * @param   string|NULL $password
     * @param   string|NULL $password_repeat
     * @return  bool
     */
    public function register( ?string $username, ?string $email, ?string $password, ?string $password_repeat ) : bool {
        /** @var bool $validate_username */
        $validate_username = $this->validateUsername( $username );
        /** @var bool $validate_email */
        $validate_email = $this->validateEmail( $email );
        /** @var bool $validate_password */
        $validate_password = $this->validatePassword( $password, $password_repeat );

        if ( $validate_username && $validate_email && $validate_password ) {
            /** @var string $salt */
            $salt = $this->createSalt();
            /** @var string $hashed_password */
            $hashed_password = $this->hashPassword( $password, $salt );

            /** @var string $query */
            $query = 'INSERT INTO users ( username, email, password, salt ) VALUES ( :username, :email, :password, :salt );';
            /** @var \PDOStatement $Statement */
            $Statement = $this->Database->prepare( $query );
            $Statement->bindValue( 'username', $username );
            $Statement->bindValue( 'email', $email );
            $Statement->bindValue( 'password', $hashed_password );
            $Statement->bindValue( 'salt', $salt );
            $Statement->execute();

            return $Statement->rowCount() > 0;
        }

        return FALSE;
    }

}