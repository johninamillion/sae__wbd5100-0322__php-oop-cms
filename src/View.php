<?php

namespace SAE\PHPCMS;

class View {

    /**
     * Check if the tempalte exists
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
     * @return  void
     */
    public function getTemplatePart( string $template_part ) : void {
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

            return;
        }

        include_once $template_file;
    }

}