<?php

namespace SAE\PHPCMS;

/**
 * Model
 *
 * Controller is an abstract class contains all methods and properties that could be used in the models of this application.
 * This class should be used as parent for all models in this application.
 * This class should be used statically and should not be initialized.
 *
 * @abstract
 */
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

    /**
     * Add Error
     *
     * @access  public
     * @param   string|NULL $key
     * @param   string|NULL $message
     * @return  void
     */
    public function addError( ?string $key, ?string $message ) : void {
        $this->errors[ $key ][] = $message;
    }

    /**
     * Get Errors
     *
     * @access  public
     * @param   string|NULL $key
     * @return  array
     */
    public function getErrors( ?string $key = NULL ) : array {

        return is_null( $key ) ? $this->errors : $this->errors[ $key ];
    }

    /**
     * Has Errors
     *
     * @access  public
     * @param   string|NULL $key
     * @return  bool
     */
    public function hasErrors( ?string $key ) : bool {

        return isset( $this->errors[ $key ] ) && count( $this->errors[ $key ] ) > 0;
    }


}