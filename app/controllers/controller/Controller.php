<?php
declare(strict_types=1);

namespace app\controllers\controller;

use app\views\view\View;
use core\helper\Config;

class Controller 
{
    protected $data = [];
    protected $view;
    protected $model;
    protected $layout = "";
    protected $title = "";

    public function __construct(array $data)
    {
        $cfgView = Config::view();

        $this->data = $data;
        $this->layout = (!empty($data['parameters']['layout'])) ? $data['parameters']['layout'] : $cfgView['layout'];
        $this->title = (!empty($data['parameters']['title'])) ? $data['parameters']['title'] : 'No title';
        $this->view = new View($cfgView, $this->layout, $this->title);
    }

    protected function redirect(string $url)
    {
        header('Location: ' . $url);
        exit();
    }
    
}