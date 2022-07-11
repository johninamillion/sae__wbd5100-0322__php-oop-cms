<?php

namespace SAE\PHPCMS;

abstract class Model {

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

}