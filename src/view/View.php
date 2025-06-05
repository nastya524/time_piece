<?php

namespace view;

class View
{
    public $tmpPath;

    public function __construct($tmpPath)
    {
        $this->tmpPath = $tmpPath;
    }

    public function render(string $tmpName, array $arr = [])
    {
        ob_start();
        extract($arr);
        include $this->tmpPath . '/' .$tmpName;
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }
}