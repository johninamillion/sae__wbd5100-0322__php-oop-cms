<?php

namespace SAE\PHPCMS\View;

final class Messages {

    /**
     * Errors
     *
     * @private
     * @var     array
     */
    private array $errors = [];

    /**
     * Get Errors
     *
     * @access  public
     * @param   string|NULL $key
     * @return  array
     */
    public function getErrors( ?string $key = NULL ) : array {

        return !is_null( $key ) ? $this->errors[ $key ] : $this->errors;
    }

    /**
     * Has Errors
     *
     * @access  public
     * @param   string|NULL $key
     * @return  bool
     */
    public function hasErrors( ?string $key = NULL ) : bool {

        return !is_null( $key ) ? count( $this->errors[ $key ] ) > 0 : count( $this->errors ) > 0;
    }

    /**
     * Print input errors
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
     * @access  public
     * @param   array   $errors
     * @return  void
     */
    public function setErrors( array $errors ) : void {
        $this->errors = $errors;
    }

}