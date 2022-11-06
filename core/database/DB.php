<?php
declare(strict_types=1);

namespace core\database;

use \PDO;

class DB 
{
	private $config = [];
	private $db;

	public function __construct(array $config) 
    {
		$this->config = $config;
	}

	public function connect() : void 
    {
		try 
        {
			$this->db = new PDO('mysql:host=' . $this->config['host'] . ';dbname=' . $this->config['name'] . ';', $this->config['user'], $this->config['password']);
			$this->db->exec('SET NAMES ' . $this->config['charset']);
		} 
        catch (\PDOException $e) 
        {
			echo $e->getMessage();
			exit();
		}
	}

	private function query(string $sql, array $params = []) : object 
    {
		$stmt = $this->db->prepare($sql);
			
		if (!empty($params)) 
        {
			foreach ($params as $key => $val) 
            {
				$type = is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR;
					
				$stmt->bindValue(':' . $key, $val, $type);
			}
		}

		$stmt->execute();

		return $stmt;
	}

	public function all(string $sql, array $params = []) : array
    {
		$result = $this->query($sql, $params);

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column(string $sql, array $params = []) : string
    {
		$result = $this->query($sql, $params);

		return $result->fetchColumn();
	}

	public function lastInsertId() : int 
    {
		return (int) $this->db->lastInsertId();
	}

	public function getDataByLastChangeId(int $id, string $table) : array
	{
		return $this->all("SELECT * FROM " . $table . " WHERE id = :id", ['id' => $id]);
	}
}