<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostIndex extends Layout
{
    protected function renderPage(Context $context): string
    {
        //test with title first
        $postWrap = "<ul>";
        foreach ($context->posts as $post) {
            $postWrap .= "
            <li>" .
                 $post["title"] . 
            "</li>
            <br/>
            ";
        }
        $postWrap .= "</ul>";
        // @codingStandardsIgnoreStart
        return <<<HTML
                <h1 style="text-align: center;">SHOW ALL THE POSTS HERE</h1>
                <div>
                    $postWrap
                </div>
HTML;
        // @codingStandardsIgnoreEnd
    }
}