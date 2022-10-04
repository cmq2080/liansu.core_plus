<?php

namespace liansu\core_plus\init;

use liansu\core\interface_\RunInterface;

class CorePlus implements RunInterface
{
    public function run()
    {
        \liansu\core\App::instance()
            ->setBaseNamespace('app')
            ->setDefaultApp("index")
            ->setDefaultAction("index");
    }
}
