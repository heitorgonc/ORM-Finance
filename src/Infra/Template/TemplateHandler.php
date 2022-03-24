<?php

namespace App\Infra\Template;

class TemplateHandler
{
    public function render($templateName, $params = [])
    {
        extract($params);

        require_once __DIR__ . '/Templates/' . $templateName;
    }
}