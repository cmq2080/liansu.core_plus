<?php

namespace liansu\controller;

use liansu\App;
use liansu\facade\Helper;
use liansu\traits\TControllerDefault;

class ApiController
{
    use TControllerDefault;

    public function __construct()
    {
        $runner = App::instance()->getRunner();
        $action = App::instance()->getAction();

        // 为最大化保障安全，白名单优先于黑名单
        $noCheckActions = $this->getNoCheckActions();
        if (empty($noCheckActions) && !empty($this->getCheckActions())) {
            $checkActions = $this->getCheckActions();
            if (!empty($checkActions)) {
                $actions = Helper::scanActions($runner);
                $noCheckActions = array_diff($actions, $this->getCheckActions());
            }
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
    protected function getNoCheckActions(): array
    {
        return [];
    }

    /**
     * 权限验证黑名单，里面的action一定检测
     */
    protected function getCheckActions(): array
    {
        return [];
    }
}
