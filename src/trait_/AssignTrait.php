<?php

namespace liansu\core_plus\trait_;

trait AssignTrait
{
    public function assign($key, $value)
    {
        $this->assigns[$key] = $value;
    }
}
