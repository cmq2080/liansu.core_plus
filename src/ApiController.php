<?php

namespace liansu\core_plus;

use liansu\core\App;
use liansu\core\Helper;
use liansu\core\Response;

class ApiController
{
    public function __construct()
    {
        $runner = App::instance()->getRunner();
        $action = App::instance()->getAction();

        // 为最大化保障安全，白名单优先于黑名单
        $noCheckActions = $this->noCheckActions();
        if (!$noCheckActions && $this->checkActions()) {
            $actions = Helper::scanActions($runner);
            $noCheckActions = array_diff($actions, $this->checkActions());
        }
        if (!in_array($action, $noCheckActions) && $this->checkAuth() === false) {
            throw new \Exception('权限不足');
        }
    }

    protected function checkAuth(): bool
    {
        return true;
    }

    /**
     * 权限验证白名单，里面的action不用检测
     */
    protected function noCheckActions(): array
    {
        return [];
    }

    /**
     * 权限验证黑名单，里面的action一定检测
     */
    protected function checkActions(): array
    {
        return [];
    }

    public function success($msg = '成功', $data = []) // 这块能不能做成一个本地化的语言模块？
    {
        Response::json(Response::SUCCESS, $msg, $data);
    }

    public function error($msg = '失败', $data = [], $stat = 1)
    {
        Response::json($stat, $msg, $data);
    }

    public function json($data)
    {
        Response::printf($data);
    }
}
