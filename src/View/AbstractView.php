<?php

namespace IdealOctoTelegram\View;

abstract class AbstractView
{
    /**
     * @param mixed $data
     */
    abstract protected function render(mixed $data): void;

    /**
     * Captures the rendered output as a string so we can send it later
     * 
     * @param mixed $data
     */
    public function renderToString(mixed $data): string
    {
        ob_start();
        
        $this->render($data);

        $rendered = ob_get_clean();
        
        return $rendered;
    }
}