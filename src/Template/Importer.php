<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

/**
 * Template for the checkout page
 */
class Importer extends Layout
{
    protected function renderPage(Context $context): string
    {
        $content = $this->header->render($context);

        // @codingStandardsIgnoreStart
        return <<<HTML
                    <div>
                        <!-- All JSON files under data/ has been imported to databased successfully. -->
                    </div>
HTML;
        // @codingStandardsIgnoreEnd
    }
}