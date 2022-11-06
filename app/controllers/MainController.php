<?php
declare(strict_types=1);

namespace app\controllers;

use app\controllers\controller\Controller;
use app\models\InstructionModel;

class MainController extends Controller
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->model = new InstructionModel();
    }

    public function main()
    {
        $vars = [
            'scripts'   => [],
            'styles'    => [
                'main'
            ],
        ];

        $this->view->render(['main'], $vars);
    }

    public function standarts()
    {
        $vars = [
            'scripts'   => [],
            'styles'    => [
                'documentations'
            ],
        ];

        $this->view->render(['Standarts'], $vars);
    }

    public function licenses()
    {
        $vars = [
            'scripts'   => [],
            'styles'    => [
                'documentations'
            ],
        ];

        $this->view->render(['Licenses'], $vars);
    }

    public function laws()
    {
        $vars = [
            'scripts'   => [],
            'styles'    => [
                'documentations'
            ],
        ];

        $this->view->render(['Laws'], $vars);
    }

    public function faq()
    {
        $vars = [
            'scripts'   => [
                'FAQ'
            ],
            'styles'    => [
                'faq'
            ],
        ];

        $this->view->render(['FAQ'], $vars);
    }

    public function search()
    {
        if (!empty($_POST))
        {
            $search_param = mb_strtolower(trim(htmlspecialchars($_POST['s'])));

            if (!empty($search_param))
            {
                $role = $_SESSION['userInfo']['role'];

                $getAllInstructions = ($role === 'admin') ? $this->model->getAllInstructions() : $this->model->getInstructionsByRole($role);

                $reg = "#$search_param#";

                $result = [];
                $i = 0;

                foreach ($getAllInstructions as $key => $value)
                {
                    if ((preg_match($reg, mb_strtolower($value['header']))) || (preg_match($reg, mb_strtolower($value['theme'])))) 
                    {
                        $result[$i] = $getAllInstructions[$key];
                        $i++;
                    }
                }

                if (!empty($result))
                {
                    $this->view->js_redirect("/instructions", "showresult", ['result' => $result]);
                }

                $this->view->message('error', 'Ничего не найдено!');
            }
        }

        $this->view->message('error', 'Что-то пошло не так!');
    }
}