<?php
declare(strict_types=1);

namespace app\controllers;

use app\controllers\controller\Controller;
use app\models\InstructionModel;
use core\error\Error;

class InstructionsController extends Controller
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->model = new InstructionModel();
    }

    public function show_instructions()
    {
        $role = $_SESSION['userInfo']['role'];

        $get_instructions_by_role = ($role === 'admin') ? $this->model->getAllInstructions() : $this->model->getInstructionsByRole($role);

        $vars = [
            'scripts'   => [],
            'styles'    => [
                'instructions'
            ],
            'instructionsData' => $get_instructions_by_role,
        ];

        $this->view->render(['Instructions'], $vars, "Инструкции для $role | Великий Кулинар");
    }

    public function create_page()
    {
        $vars = [
            'scripts'   => [],
            'styles'    => [
                'instruction-create'
            ],
        ];

        $this->view->render(['InstructionCreate'], $vars);
    }

    public function show()
    {
        $id_instruction = $this->data['pathParams']['id'];

        $get_instruction_data = $this->model->getInstructionData((int) $id_instruction);

        if (empty($get_instruction_data)) Error::give(404);

        $get_instruction_data['files'] = json_decode($get_instruction_data['files'], true);

        if ($_SESSION['userInfo']['role'] !== 'admin')
        {
            if ($_SESSION['userInfo']['role'] !== $get_instruction_data['role'])
            {
                Error::give(403);
            }
        }

        $vars = [
            'scripts'   => [],
            'styles'    => [
                'instruction-show'
            ],
            'instruction_data' => $get_instruction_data,
        ];

        $title = "Инструкция № " . $id_instruction . " | Великий Кулинар";

        $this->view->render(['InstructionShow'], $vars, $title);
    }

    public function instruction_add()
    {
        if (!empty($_POST))
        {
            $files = $_FILES['files_i'];
            $data = [
                'header' => trim(htmlspecialchars($_POST['head_i'])),
                'theme' => trim(htmlspecialchars($_POST['theme_i'])),
                'content' => trim(htmlspecialchars($_POST['content_i'])),
                'role' => $_SESSION['userInfo']['role'],
                'author' => $_SESSION['userInfo']['firstname'] . ' ' . $_SESSION['userInfo']['secondname'],
            ];

            $files_name = [
                'image' => [],
                'video' => [],
                'application' => [],
            ];

            if ((!empty($data['header'])) && (!empty($data['theme'])) && (!empty($data['content'])) && (!empty($data['role'])) && (!empty($files)))
            {
                foreach ($files["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $files["tmp_name"][$key];
                        $type = explode('/', $files["type"][$key])[0];
                        $name = "$type/" . basename(time() . $files["name"][$key]);
                        $files_name[$type] += [$key => $name];
                        move_uploaded_file($tmp_name, DIR . "/app/assets/documents/$name");
                    }
                }

                $data['files'] = json_encode($files_name);

                $result = $this->model->addInstruction($data);

                if (!empty($result))
                {
                    $this->view->message('success', ['message' => "Инструкция №" . $result['id'] . " успешно добавлена!"]);
                }
            }

            $this->view->message('error', "Что-то пошло не так!");
        }
    }

    public function user_delete()
    {
        if (!empty($_POST))
        {
            $code = trim(htmlspecialchars($_POST['code_u']));

            if (!empty($code))
            {
                $result = $this->model->deleteUser((int) $code);

                if ($result)
                {
                    $this->view->message('success', ['message' => 'Пользователь №' . $code . ' успешно удален!']);
                }
            }

            $this->view->message('error', 'Что-то пошло не так!');
        }
    }

    public function instruction_delete()
    {
        if (!empty($_POST))
        {
            $id = trim(htmlspecialchars($_POST['id_i']));

            if (!empty($id))
            {
                $result = $this->model->deleteInstruction((int) $id);

                if ($result)
                {
                    $this->view->message('success', ['message' => 'Инструкция №' . $id . ' успешно удалена!']);
                }
            }

            $this->view->message('error', 'Что-то пошло не так!');
        }
    }

    public function admin_instructions_list()
    {
        $get_all_instructions = $this->model->getAllInstructions();

        $vars = [
            'scripts'   => [
                'form'
            ],
            'styles'    => [
                'admin-forms',
                'admin-login',
                'admin-lists',
            ],
            'instructions' => $get_all_instructions,
        ];

        $this->view->render(['AdminInstructionList'], $vars);
    }
}