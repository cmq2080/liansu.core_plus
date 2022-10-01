<?php

/**
 * 描述：
 * Created at 2021/7/17 21:33 by mq
 */

namespace liansu\core_plus\trait_;

use liansu\view\interface_\ViewHandlerInterface;

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
        $file = $this->getFile($file);
        if (is_array($args) === true) {
            $this->assigns = array_merge($this->assigns, $args);
        }
        return $this->viewHandler->fetch($file, $this->assigns);
    }

    public function display($file = null, $args = null)
    {
        $file = $this->getFile($file);
        if (is_array($args) === true) {
            $this->assigns = array_merge($this->assigns, $args);
        }
        $this->viewHandler->display($file, $this->assigns);
    }
}
