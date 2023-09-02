<?php

/**
 * 描述：
 * Created at 2021/7/17 21:33 by mq
 */

namespace liansu\core_plus\traits;

use liansu\view\interfaces\IViewHandler;
use liansu\view\LiansuViewHandler;
use liansu\view\View;

trait TControllerView
{
    protected IViewHandler|null $viewHandler = null;

    public function setViewHandler(IViewHandler $viewHandler)
    {
        $this->viewHandler = $viewHandler;

        return $this;
    }

    public function getViewHandler()
    {
        if (!$this->viewHandler) {
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
