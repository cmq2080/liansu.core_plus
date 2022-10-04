<?php

/**
 * 描述：
 * Created at 2021/7/17 21:33 by mq
 */

namespace liansu\core_plus\trait_;

use liansu\core\Response;
use liansu\view\interface_\ViewHandlerInterface;
use liansu\view\View;

trait ViewTrait
{
    public function setViewHandler(ViewHandlerInterface $viewHandler)
    {
        $this->viewHandler = $viewHandler;

        return $this;
    }

    public function getViewHandler()
    {
        return $this->viewHandler;
    }

    public function fetch($file = null, $args = null)
    {
        $file = View::getFile($file);
        if (is_array($args) === true) {
            $this->assigns = array_merge($this->assigns, $args);
        }

        return View::fetch($this->viewHandler, $file, $this->assigns);
    }

    public function display($file = null, $args = null)
    {
        $file = View::getFile($file);
        if (is_array($args) === true) {
            $this->assigns = array_merge($this->assigns, $args);
        }

        Response::print(View::fetch($this->viewHandler, $file, $this->assigns));
    }
}
