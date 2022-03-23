<?php

use App\Infra\Template\TemplateHandler;

require_once __DIR__ . '/../autoload.php';

$templateHandler = new TemplateHandler();
$templateHandler->render('index');