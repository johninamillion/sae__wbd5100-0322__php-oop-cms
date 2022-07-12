<?php

namespace SAE\PHPCMS;

final class Application {

    const DEFAULT_CONTROLLER    = 'Index';
    const DEFAULT_METHOD        = 'index';
    const ERROR_CONTROLLER      = 'Error';

    /**
     * Associative array of url request
     *
     * @access  private
     * @var     array|NULL
     */
    private ?array $url = NULL;

    /**
     * Create a string of a controller class with namespace
     *
     * @access  private
     * @param   string|NULL $request
     * @return  string
     */
    private function createControllerClass( ?string $request ) : string {
        /** @var string $controller */
        $controller = ucfirst( $request ?? self::DEFAULT_CONTROLLER );

        return "SAE\\PHPCMS\\Controller\\{$controller}";
    }

    /**
     * Check if a controller exists
     *
     * @access  private
     * @param   string|NULL $controller
     * @return  bool
     */
    private function controllerExists( ?string $controller ) : bool {

        return !is_null( $controller ) && class_exists( $controller );
    }

    /**
     * Check if an argument is valid and not empty
     *
     * @param   string|NULL $argument
     * @return  bool
     */
    private function isValidArgument( ?string $argument ) : bool {

        return !empty( $argument );
    }

    /**
     * Check if a controller method exists
     *
     * @access  private
     * @param   string|NULL $controller
     * @param   string|NULL $method
     * @return  bool
     */
    private function methodExists( ?string $controller, ?string $method ) : bool {

        return !is_null( $method ) && method_exists( $controller, $method );
    }

    /**
     * Sanitize controller
     *
     * @access  private
     * @param   string|NULL     $request
     * @return  string
     */
    private function sanitizeController( ?string $request ) : string {
        /** @var string $controller */
        $controller = $this->createControllerClass( $request );
        /** @var string $error */
        $error = $this->createControllerClass( self::ERROR_CONTROLLER );

        return $this->controllerExists( $controller ) ? $controller : $error;
    }

    /**
     * Sanitize controller method
     *
     * @access  private
     * @param   string|NULL $request
     * @param   string|NULL $method
     * @return  string
     */
    private function sanitizeControllerMethod( ?string $request, ?string $method ) : string {
        /** @var string $controller */
        $controller = $this->createControllerClass( $request );
        /** @var string $default */
        $default = self::DEFAULT_METHOD;

        return $this->methodExists( $controller, $method ) ? $method : $default;
    }

    /**
     * Parse url and return an associative array with controller, method and argument as keys
     *
     * @access  private
     * @return  array
     */
    private function parseUrl() : array {
        /** @var string $url */
        $url = filter_input( INPUT_GET, '_url' ) ?? '';
        /** @var string $url_lower */
        $url_lower = strtolower( $url );
        /** @var string $url_parts */
        $url_parts = explode( '/', $url_lower );

        /** @var string|NULL $controller */
        $controller = $url_parts[ 0 ] !== '' ? $url_parts[ 0 ] : NULL;
        /** @var string|NULL $method */
        $method = $url_parts[ 1 ] ?? NULL;
        /** @var string|NULL $argument */
        $argument = $url_parts[ 2 ] ?? NULL;

        return [
            'controller'    =>  $this->sanitizeController( $controller ),
            'method'        =>  $this->sanitizeControllerMethod( $controller, $method ),
            'argument'      =>  $argument,
        ];
    }

    /**
     * Construct
     *
     * @access  public
     * @constructor
     */
    public function __construct() {
        // parse url
        $this->url = $this->parseUrl();
    }

    /**
     * Run application
     *
     * @access  public
     * @return  void
     */
    public function run() : void {
        // start session
        Session::start();
        // handle session timeout
        Authorize::loginTimeout();

        /** @var string $controller */
        $controller = $this->url[ 'controller' ];
        /** @var string $method */
        $method = $this->url[ 'method' ];
        /** @var string|NULL $argument */
        $argument = $this->url[ 'argument' ];

        if ( $this->isValidArgument( $argument ) ) {
            ( new $controller() )->{$method}( $argument );
        }
        else {
            ( new $controller() )->{$method}();
        }
    }

}