<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;

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
        echo "test";
        return new Template\Importer();
    }
}