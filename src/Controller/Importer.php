<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use DirectoryIterator;
use Exception;

class Importer extends Controller
{
    public function getContext(): Context
    {
        $context = new Context();
        $context->title = 'Checkout';
        return $context;
    }

    public function getTemplate(): Template\Template
    {
        // use built-in DirectoryIterator as $iterator
        $iterator = new DirectoryIterator (dirname(dirname(dirname(__FILE__))) . '\\data');

        foreach($iterator as $fileinfo){
            // filter out json files
            if($fileinfo->getExtension() == 'json'){
                $fileContent = file_get_contents($fileinfo->getPathname());
                $data = json_decode($fileContent, true);
                
                try {
                    $sql = "
                        INSERT INTO 
                            posts (
                                id, 
                                title, 
                                body, 
                                created_at, 
                                modified_at, 
                                author) 
                            VALUES (
                                '$data[id]', 
                                '$data[title]', 
                                '$data[body]', 
                                '$data[created_at]', 
                                '$data[modified_at]', 
                                '$data[author]'
                            )
                        ";
                    $this->db->exec($sql);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
        return new Template\Importer();
    }
}