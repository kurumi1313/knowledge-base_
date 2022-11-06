<?php
declare(strict_types=1);

namespace app\models;

use app\models\model\Model;

class InstructionModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addInstruction(array $data = []) : array
    {
        $sql = $this->qb
        ->insert('instructions')
        ->set($data)
        ->query();

        $this->db->all($sql['sql'], $sql['params']);

        return $this->db->getDataByLastChangeId($this->db->lastInsertId(), 'instructions')[0];
    }

    public function deleteInstruction(int $id) : bool
    {
        $sql = $this->qb
        ->delete('instructions')
        ->where()
        ->condition('id', $id)
        ->query();

        $this->db->all($sql['sql'], $sql['params']);

        if (empty($this->db->getDataByLastChangeId($id, 'instructions'))) return true;

        return false;
    }

    public function deleteUser(int $code) : bool
    {
        $sql = $this->qb
        ->delete('users')
        ->where()
        ->condition('code', $code)
        ->query();

        $this->db->all($sql['sql'], $sql['params']);

        if (empty($this->db->getDataByLastChangeId($code, 'users'))) return true;

        return false;
    }

    public function getInstructionData(int $id) : array
    {
        $sql = $this->qb
        ->select('instructions')
        ->where()
        ->condition('id', $id)
        ->query();

        $result = $this->db->all($sql['sql'], $sql['params']);

        return (!empty($result[0])) ? $result[0] : [];
    }

    public function getInstructionsByRole(string $role) : array
    {
        $sql = $this->qb
        ->select('instructions')
        ->where()
        ->condition('role', $role)
        ->query();

        $result = $this->db->all($sql['sql'], $sql['params']);

        return (!empty($result)) ? $result : [];
    }

    public function getAllInstructions() : array
    {
        $sql = $this->qb
        ->select('instructions')
        ->orderBy('id')
        ->query();

        $result = $this->db->all($sql['sql']);

        return (!empty($result)) ? $result : [];
    }

}