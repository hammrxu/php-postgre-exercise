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
                        test1
                    </div>
HTML;
        // @codingStandardsIgnoreEnd
    }
}