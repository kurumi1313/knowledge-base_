<?php
declare(strict_types=1);

namespace app\controllers;

use app\controllers\controller\Controller;
use app\models\AdminModel;
use core\helper\Email;

class AdminController extends Controller
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->model = new AdminModel();
    }

    public function panel()
    {
        $vars = [
            'scripts'   => [],
            'styles'    => [],
        ];

        $this->view->render(['AdminPanel'], $vars);
    }

    public function login()
    {
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-login'
            ],
        ];

        $this->view->render(['AdminLogin'], $vars);
    }

    public function auth()
    {
        if (!empty($_POST))
        {
            $login = trim(htmlspecialchars($_POST['admin_login']));
            $password = trim(htmlspecialchars($_POST['admin_password']));

            $data = $this->model->getAdminInfoForAuth($login);

            if (!empty($data))
            {
                if (password_verify($password, $data['password']))
                {
                    $_SESSION['userInfo'] = $data;

                    $this->view->js_redirect("/admin/panel/instructions");
                }
            }

            $this->view->message('error', 'Неверные данные для входа!');
        }
    }

    public function user_add_page()
    {
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-forms',
                'admin-login'
            ],
        ];

        $this->view->render(['AdminUserAdd'], $vars);
    }

    public function user_delete_page()
    {
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-forms',
                'admin-login'
            ],
        ];

        $this->view->render(['AdminUserDelete'], $vars);
    }

    public function instruction_add_page()
    {
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-forms',
                'admin-login'
            ],
        ];

        $this->view->render(['AdminInstructionAdd'], $vars);
    }

    public function instruction_delete_page()
    {
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-forms',
                'admin-login'
            ],
        ];

        $this->view->render(['AdminInstructionDelete'], $vars);
    }

    public function user_add()
    {
        if (!empty($_POST))
        {
            $data = [
                'firstname' => trim(htmlspecialchars($_POST['user_firstname'])),
                'secondname' => trim(htmlspecialchars($_POST['user_secondname'])),
                'code' => trim(htmlspecialchars($_POST['user_code'])),
                'role' => trim(htmlspecialchars($_POST['user_role'])),
                'password' => password_hash(trim(htmlspecialchars($_POST['user_password'])), PASSWORD_DEFAULT),
                'email' => trim(htmlspecialchars($_POST['user_email'])),
            ];

            if (!empty($this->model->getUserByCode((int) $data['code'])))
            {
                $this->view->message('error', 'Пользователь с таким же кодом уже существует!');
            }

            if (!in_array($data['role'], $this->data['role']))
            {
                $this->view->message('error', 'Такой роли не существует!');
            }

            $result = $this->model->addNewUser($data);

            if (!empty($result))
            {
                $this->view->message('success', ['result' => $result, 'message' => 'Пользователь ' . $result['secondname'] . ' ' . $result['firstname'] . ' был добавлен!']);
            }

            $this->view->message('error', 'Что-то пошло не так!');
        }
    }

    public function admin_add_page()
    {
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-forms',
                'admin-login'
            ],
        ];

        $this->view->render(['AdminAdminAdd'], $vars);
    }

    public function admin_add()
    {
        if (!empty($_POST))
        {
            $data = [
                'firstname' => trim(htmlspecialchars($_POST['admin_firstname'])),
                'secondname' => trim(htmlspecialchars($_POST['admin_secondname'])),
                'code' => trim(htmlspecialchars($_POST['admin_code'])),
                'role' => 'admin',
                'login' => trim(htmlspecialchars($_POST['admin_login'])),
                'password' => password_hash(trim(htmlspecialchars($_POST['admin_password'])), PASSWORD_DEFAULT),
                'email' => trim(htmlspecialchars($_POST['admin_email'])),
            ];

            if (!empty($this->model->getAdminByCode((int) $data['code'])))
            {
                $this->view->message('error', 'Админ с таким же кодом уже существует!');
            }

            if (!empty($this->model->getAdminInfoForAuth($data['login'])))
            {
                $this->view->message('error', 'Админ с таким же логином уже существует!');
            }

            $result = $this->model->addNewAdmin($data);

            if (!empty($result))
            {
                $this->view->message('success', ['result' => $result, 'message' => 'Админ ' . $result['secondname'] . ' ' . $result['firstname'] . ' был добавлен!']);
            }

            $this->view->message('error', 'Что-то пошло не так!');
        }
    }

    public function admin_feedback()
    {
        if (!empty($_POST))
        {   
            $to = $this->model->getAdminEmail();
            $subject = trim(htmlspecialchars($_POST['theme_message']));
            $message = trim(htmlspecialchars($_POST['feedback_message']));

            $additional_headers = [
                'From' => $_SESSION['userInfo']['email'],
                'Reply-To' => $to,
            ];

            if ((!empty($to)) && (!empty($subject)) && (!empty($message)))
            {
                Email::send($to, $subject, $message, $additional_headers);

                $data = [
                    'aim' => $to,
                    'sender' => $_SESSION['userInfo']['email'],
                    'theme' => $subject,
                    'message' => $message,
                ];

                $result = $this->model->saveFeedbackFromUser($data);

                if (!empty($result))
                {
                    $this->view->message('success', ['message' => 'Сообщение было отправлено!']);
                }
            }

            $this->view->message('error', 'Что-то пошло не так!'); 
        }
    }

    public function admin_users_list()
    {
        $getAllUsers = $this->model->getAllUsers();
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-forms',
                'admin-login',
                'admin-lists',
            ],
            'usersList' => $getAllUsers,
        ];

        $this->view->render(['AdminUserList'], $vars);
    }

    public function admin_reports_list()
    {
        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-forms',
                'admin-login',
                'admin-lists',
            ],
        ];

        $this->view->render(['AdminReportList'], $vars);
    }
}