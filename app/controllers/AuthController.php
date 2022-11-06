<?php
declare(strict_types=1);

namespace app\controllers;

use app\controllers\controller\Controller;
use app\models\LoginModel;
use app\user\User;

class AuthController extends Controller
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->model = new LoginModel();
    }

    public function login()
    {
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'user-login'
            ],
        ];

        $this->view->render(['UserLogin'], $vars);
    }

    public function auth()
    {
        if (!empty($_POST)) {
            $userCode = (int) trim(htmlspecialchars($_POST['code_s']));
            $password = trim(htmlspecialchars($_POST['password']));

            $data = $this->model->getUserInfoForAuth($userCode);

            if (!empty($data))
            {
                if (password_verify($password, $data['password']))
                {
                    $_SESSION['userInfo'] = $data;

                    $this->view->js_redirect("/instructions");
                }
            }

            $this->view->message('error', 'Неверные данные для входа!');
        }
    }

    public function logout()
    {
        unset($_SESSION['userInfo']);

        if ($this->data['queryParams']['r'] === 'admin') $this->redirect('/admin/login');
        
        $this->redirect('/login');
    }
}