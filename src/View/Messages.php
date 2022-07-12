<?php

namespace SAE\PHPCMS\View;

final class Messages {

    /**
     * Errors
     *
     * Contains all error messages sort by keys.
     *
     * @private
     * @var     array
     */
    private array $errors = [];

    /**
     * Add Error
     *
     * Push an error with a key in the errors array.
     *
     * @access  public
     * @param   string  $key
     * @param   string  $message
     * @return  void
     */
    public function addError( string $key, string $message ) : void {

        $this->errors[ $key ][] = $message;
    }

    /**
     * Get Errors
     *
     * Get errors by key if a key passed as argument or get all errors contained in the errors array.
     *
     * @access  public
     * @param   string|NULL $key
     * @return  array
     */
    public function getErrors( ?string $key = NULL ) : array {

        return !is_null( $key ) ? $this->errors[ $key ] ?? [] : $this->errors;
    }

    /**
     * Has Errors
     *
     * Check if errors exists by key if a key passed as argument or check for any errors contained in the errors array.
     *
     * @access  public
     * @param   string|NULL $key
     * @return  bool
     */
    public function hasErrors( ?string $key = NULL ) : bool {

        return !is_null( $key ) ? count( $this->errors[ $key ] ?? [] ) > 0 : count( $this->errors ) > 0;
    }

    /**
     * Print input errors
     *
     * Print errors by input name as key.
     *
     * @access  public
     * @param   string  $name
     * @return  void
     */
    public function printInputErrors( string $name ) : void {
        if ( $this->hasErrors( $name ) ) {
            /** @var array $errors */
            $errors = $this->getErrors( $name );

            echo "<ul class=\"errors\">";
            foreach( $errors as $errors_message ) {
                echo "<li class=\"errors__item\">{$errors_message}</li>";
            }
            echo "</ul>";
        }
    }

    /**
     * Set Errors
     *
     * Set errors array. Call this function in a method of a controller to pass the error messages of a model.
     *
     * @access  public
     * @param   array   $errors
     * @return  void
     */
    public function setErrors( array $errors ) : void {
        $this->errors = $errors;
    }

}