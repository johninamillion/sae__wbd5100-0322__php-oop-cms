<?php

namespace SAE\PHPCMS;

abstract class Model {

    /**
     * Errors
     *
     * @access  protected
     * @var     array
     */
    protected array $errors = [];

    /**
     * Database
     *
     * @access  protected
     * @var     Database|NULL
     */
    protected ?Database $Database = NULL;

    /**
     * Construct
     *
     * @access  public
     * @constructor
     */
    public function __construct() {
        $this->Database = new Database();
    }

    public function addError( ?string $key, ?string $message ) : void {
        $this->errors[ $key ][] = $message;
    }

    public function getErrors( ?string $key = NULL ) : array {

        return is_null( $key ) ? $this->errors : $this->errors[ $key ];
    }

    public function hasErrors( ?string $key ) : bool {

        return isset( $this->errors[ $key ] ) && count( $this->errors[ $key ] ) > 0;
    }


}