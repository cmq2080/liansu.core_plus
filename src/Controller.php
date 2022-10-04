<?php

/**
 * 描述：
 * Created at 2021/6/6 22:44 by mq
 */

namespace liansu\core_plus;

use liansu\core\Response;
use liansu\core_plus\trait_\AssignTrait;
use liansu\core_plus\trait_\ViewTrait;

class Controller
{
    use AssignTrait;
    use ViewTrait;

    protected $assigns = [];
    protected $viewHandler;

    public function __construct()
    {
        $viewHandler = new \liansu\view\LiansuViewHandler();
        $viewHandler->initialize(['tpl_dir' => App::instance()->rootDirectory . '/view', 'cache_dir' => App::instance()->runtimeDirectory . '/tmp/view']);
        $this->setViewHandler($viewHandler);
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

    public function json($stat, $msg = '', $data = [])
    {
        Response::json($stat, $msg, $data);
    }
}
