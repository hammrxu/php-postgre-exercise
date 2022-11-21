<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostIndex extends Layout
{
    protected function renderPage(Context $context): string
    {
        $postWrap = "<ul>";
        //test with title first
        foreach ($context->posts as $post) {
            $postWrap .= "
            <li>
                <span>
                <a href='/posts/" . $post["id"] . "'>" . $post["title"] . "</a>" .
                
                " by  " .
                
                $post["full_name"] . 

                "<br/>Last modified at: " . 

                $post['modified_at'] . 

                "</span>
                
                &nbsp;
            </li>
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

        