<?php

namespace liansu\core_plus;


class App extends \liansu\core\App
{
    protected function __construct()
    {
        parent::__construct();

        $this->baseNamespace = 'app';
        $this->defaultApp = 'index';
        $this->defaultAction = 'index';
    }

    public function run()
    {
        // $this->addInitItems(\liansu\core_plus\init\CorePlus::class);

        parent::run();
    }
}
