<?php
declare(strict_types=1);

namespace app\models;

use app\models\model\Model;

class AdminModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAdminInfoForAuth(string $login) : array
    {
        $sql = $this->qb
        ->select('admins')
        ->where()
        ->condition('login', $login)
        ->query();

        $result = $this->db->all($sql['sql'], $sql['params']);

        return (!empty($result[0])) ? $result[0] : [];
    }

    public function addNewUser(array $data = []) : array
    {
        $sql = $this->qb
        ->insert('users')
        ->set($data)
        ->query();

        $this->db->all($sql['sql'], $sql['params']);

        return $this->db->getDataByLastChangeId($this->db->lastInsertId(), 'users')[0];
    }

    public function getUserByCode(int $code)
    {
        $sql = $this->qb
        ->select('users')
        ->where()
        ->condition('code', $code)
        ->query();

        $result = $this->db->all($sql['sql'], $sql['params']);

        return $result;
    }

    public function addNewAdmin(array $data = []) : array
    {
        $sql = $this->qb
        ->insert('admins')
        ->set($data)
        ->query();

        $this->db->all($sql['sql'], $sql['params']);

        return $this->db->getDataByLastChangeId($this->db->lastInsertId(), 'admins')[0];
    }

    public function getAdminByCode(int $code)
    {
        $sql = $this->qb
        ->select('admins')
        ->where()
        ->condition('code', $code)
        ->query();

        $result = $this->db->all($sql['sql'], $sql['params']);

        return $result;
    }

    public function getAdminEmail()
    {
        $sql = $this->qb
        ->select('admins', 'email')
        ->where()
        ->condition('code', 1)
        ->query();

        $result = $this->db->column($sql['sql'], $sql['params']);

        return $result;
    }

    public function saveFeedbackFromUser(array $data = []) : array
    {
        $sql = $this->qb
        ->insert('feedback')
        ->set($data)
        ->query();

        $this->db->all($sql['sql'], $sql['params']);

        return $this->db->getDataByLastChangeId($this->db->lastInsertId(), 'feedback')[0];
    }

    public function getAllUsers()
    {
        $sql = $this->qb
        ->select('users')
        ->orderBy('code')
        ->query();

        $result = $this->db->all($sql['sql']);

        return $result;
    }
}