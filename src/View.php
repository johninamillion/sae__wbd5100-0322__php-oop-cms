<?php

namespace SAE\PHPCMS;

use SAE\PHPCMS\View\Messages;

/**
 * View
 *
 * View is a class initialized in the controller and should be used there to build the view with templates.
 * This class is final and should not be used as a parent class
 *
 * @final
 */
final class View {

    /**
     * Messages
     *
     * @access  public
     * @var     Messages|NULL
     */
    public ?Messages $Messages = NULL;

    /**
     * @access  public
     * @constructor
     */
    public function __construct() {
        $this->Messages = new Messages();
    }

    /**
     * Document Title
     *
     * @access  private
     * @var     string|NULL
     */
    private ?string $document_title = NULL;

    /**
     * Check if the template exists
     *
     * @access  private
     * @param   string  $template_part
     * @return  bool
     */
    private function templateExists( string $template_part ) : bool {

        return file_exists( $template_part );
    }

    /**
     * Get template part
     *
     * @access  public
     * @param   string  $template_part
     * @return  bool
     */
    public function getTemplatePart( string $template_part ) : bool {
        /** @var string $template_file */
        $template_file = APP_TEMPLATE_DIR . DIRECTORY_SEPARATOR . "{$template_part}.php";

        if ( !$this->templateExists( $template_file ) ) {
            trigger_error(
                sprintf(
                    'The template file (%s) doesn\'t exist.',
                    $template_file
                ),
                E_USER_WARNING
            );

            return FALSE;
        }

        include_once $template_file;

        return TRUE;
    }

    /**
     * Get document title
     *
     * @access  public
     * @return  string|NULL
     */
    public function getTitle() : ?string {

        return $this->document_title;
    }

    /**
     * Set document title
     *
     * @access  public
     * @param   string  $title
     * @return  void
     */
    public function setTitle( string $title ) : void {

        $this->document_title = $title;
    }

}