<?php

namespace App\Traits;

trait GetModelName {

    public function getModelName(){
        $class_name = basename(strtr(get_class($this->model), '\\', '/'));
        return mb_strtolower($class_name);
    }
}