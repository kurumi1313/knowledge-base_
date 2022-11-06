<?php
declare(strict_types=1);

namespace app\models;

use app\models\model\Model;

class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserInfoForAuth(int $codeUser) : array
    {
        $sql = $this->qb
        ->select('users')
        ->where()
        ->condition('code', $codeUser)
        ->query();

        $result = $this->db->all($sql['sql'], $sql['params']);

        return (!empty($result[0])) ? $result[0] : [];
    }
}