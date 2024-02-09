<?php

namespace app\Controllers;

use eftec\bladeone\BladeOne;

class BaseController {
    protected $blade;

    public function __construct(BladeOne $blade) {
        $this->blade = $blade;
    }

    public function render($template, $data = []) {
        echo $this->blade->run($template, $data);
    }
}