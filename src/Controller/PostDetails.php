<?php

namespace silverorange\DevTest\Controller;

use PDO;
use Parsedown;
use silverorange\DevTest\Model\Post;
use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use silverorange\DevTest\Model;

class PostDetails extends Controller
{
    private ?Model\Post $post = null;

    public function getContext(): Context
    {
        $context = new Context();
        $Parsedown = new Parsedown();

        if ($this->post === null) {
            $context->title = 'Not Found';
            $context->content = "A post with id {$this->params[0]} was not found.";
        } else {
            $context->title = $this->post->title;
            // Add $content and $author
            $context->content = $Parsedown->text($this->post->body);
            $context->author = $this->post->author;
        }
        return $context;
    }

    public function getTemplate(): Template\Template
    {
        if ($this->post === null) {
            return new Template\NotFound();
        }

        return new Template\PostDetails();
    }

    public function getStatus(): string
    {
        if ($this->post === null) {
            return $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found';
        }

        return $_SERVER['SERVER_PROTOCOL'] . ' 200 OK';
    }

    protected function loadData(): void
    {
        // TODO: Load post from database here. $this->params[0] is the post id.
        if ($this->params[0] === "" || $this->params[0] === null) {
            // Do nothing
        } else {
            $sth = $this->db->prepare(
                "
                SELECT 
                    posts.*, 
                    authors.full_name 
                AS 
                    author 
                FROM 
                    posts 
                LEFT JOIN 
                    authors 
                ON 
                    posts.author = authors.id 
                WHERE 
                    posts.id = :postID
            "
            );
            $sth->execute([':postID' => $this->params[0]]);
            $sth->setFetchMode(PDO::FETCH_CLASS, Post::class);
            $post = $sth->fetch();
            if ($post) {
                $this->post = $post;
            }
        }
    }
}
