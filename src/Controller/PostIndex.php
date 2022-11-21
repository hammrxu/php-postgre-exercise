<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;

class PostIndex extends Controller
{
    private array $posts = [];

    public function getContext(): Context
    {
        $context = new Context();
        $context->title = 'Posts';
        $context->posts = $this->posts;
        return $context;
    }

    public function getTemplate(): Template\Template
    {
        return new Template\PostIndex();
    }

    protected function loadData(): void
    {
        // TODO: Load posts from database here.
        // reset posts
        $this->posts = [];
        $sth = $this->db->prepare("
            SELECT 
                posts.*, 
                authors.full_name 
            FROM posts 
            LEFT JOIN 
                authors 
            ON 
                posts.author = authors.id 
            ORDER BY 
                posts.modified_at 
                ASC,
                authors.full_name

        ");
        $sth->execute();
        $posts_result = $sth->fetchALl();
        if ($posts_result) {
            $this->posts = $posts_result;
        }
    }
}
    