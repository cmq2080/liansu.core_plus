<?php

/**
 * 描述：
 * Created at 2021/7/17 21:33 by mq
 */

namespace liansu\traits;

use liansu\interfaces\IViewHandler;
use liansu\config\LiansuViewHandler;
use liansu\facade\View;

trait TControllerView
{
    protected IViewHandler $viewHandler;

    public function setViewHandler(IViewHandler $viewHandler)
    {
        $this->viewHandler = $viewHandler;

        return $this;
    }

    public function getViewHandler()
    {
        if (empty($this->viewHandler)) {
            $this->viewHandler = new LiansuViewHandler();
        }

        return $this->viewHandler;
    }

    public function fetch($reqFile = null, $args = [])
    {
        $viewHandler = $this->getViewHandler();

        // 合并参数
        $args = array_merge($this->assigns, $args);
        return View::fetch($viewHandler, $reqFile, $args);
    }

    public function display($reqFile = null, $args = [])
    {
        $viewHandler = $this->getViewHandler();

        // 合并参数
        $args = array_merge($this->assigns, $args);
        View::display($viewHandler, $reqFile, $args);
    }
}
