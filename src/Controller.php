<?php

namespace liansu\core_plus;

use liansu\core\Response;
use liansu\core_plus\traits\TControllerView;

class Controller
{
    use TControllerView;

    protected $assigns = [];

    public function assign($key, $value)
    {
        $this->assigns[$key] = $value;
    }

    public function success($msg = '成功', $data = [], $sufAction = 'close_and_refresh') // 这块能不能做成一个本地化的语言模块？
    {
        $data['__cmds'] = [];
        Response::json(Response::SUCCESS, $msg, $data);
    }

    public function error($msg = '失败', $data = [], $stat = 1)
    {
        $data['__cmds'] = [];
        Response::json($stat, $msg, $data);
    }

    public function json($data)
    {
        Response::printf($data);
    }
}
