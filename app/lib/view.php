<?php

class View {

    private $template;

    public function load($file, $data = array())
    {
        extract($data);
        ob_start();
        include $this->template . $file .  ".tpl";

        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}