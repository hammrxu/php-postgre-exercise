<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostDetails extends Layout
{
    protected function renderPage(Context $context): string
    {
        // @codingStandardsIgnoreStart
        return <<<HTML
            <div style="text-align:right">
                <span>Title: $context->title,</span>
                <span>Author: $context->author</span>
            </div>
            <blockquote >$context->content</blockquote>


HTML;
        // @codingStandardsIgnoreEnd
    }
}
