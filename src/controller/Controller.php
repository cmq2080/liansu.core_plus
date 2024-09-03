<?php

namespace liansu\controller;

use liansu\traits\TControllerDefault;
use liansu\traits\TControllerView;

class Controller
{
    use TControllerDefault;
    use TControllerView;

    protected $assigns = [];

    public function __construct() // 这个必须得公共，否则App在new的时候会报错
    {
    }

    public function assign($key, $value)
    {
        $this->assigns[$key] = $value;
    }
}
