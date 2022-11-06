<?php
declare(strict_types=1);

namespace core\database\querybuilder;

class QueryBuilder
{
	private $sql = "";	
	private $result = [];

	public function select(string $table, $params = '*') : object 
    {
		$columns = '';

		if (is_array($params)) 
        {
			for ($i = 0; $i < count($params); $i++) 
            {
				if ($i === count($params) - 1) 
                {
					$columns .= $params[$i];
					break;
				}
				$columns .= $params[$i] .', ';
			}
		} 
        elseif (is_string($params)) 
        {
			$columns = $params;
		}

		$this->sql = "SELECT " . $columns . " FROM `" . $table . "`";

		return $this;
	}

	public function where() : object 
    {
		$this->sql .= " WHERE ";

		return $this;
	}

	public function condition(string $param = "id", $value = 1, string $sign = "=") : object 
    {
		$this->sql .= $param . " " . $sign . " :" . $param;

		if (!isset($this->result['params'])) 
        {
			$this->result['params'] = [
				$param => $value
			];
		} 
        else 
        {
			$this->result['params'] += [
				$param => $value
			];
		}

		return $this;
	}

	public function setNot() : object 
    {
		$this->sql .= " NOT ";

		return $this;
	}

	public function setAnd() : object 
    {
		$this->sql .= " AND ";

		return $this;
	}

	public function setOr() : object 
    {
		$this->sql .= " OR ";

		return $this;
	}

	public function insert(string $table) : object 
    {
		$this->sql = "INSERT INTO `" . $table . "`";

		return $this;
	}

	public function delete(string $table) : object 
    {
		$this->sql = "DELETE FROM `" . $table . "`";

		return $this;
	}

	public function update(string $table) : object 
    {
		$this->sql = "UPDATE `" . $table . "`";

		return $this;
	}

	public function set(array $params = []) : object 
    {
		if (!empty($params)) 
        {
			$this->sql .= " SET ";

			$lastKey = key(array_slice($params, -1, 1, true));

			foreach ($params as $key => $value) 
            {
				if (!isset($this->result['params'])) 
                {
					$this->result['params'] = [
						$key => $value
					];
				} 
                else 
                {
					$this->result['params'] += [
						$key => $value
					];
				}
					
				if ($key === $lastKey) 
                {
					$this->sql .= $key . " = " . ":" . $key;
					break;
				}

				$this->sql .= $key . " = " . ":" . $key . ", ";
			}
		}

		return $this;
	}

	public function orderBy(string $column, string $method = 'asc') : object 
    {
		$this->sql .= " ORDER BY `" . $column . "` " . mb_strtoupper($method);

		return $this;
	}

	public function query() : array 
    {
		$this->result['sql'] = $this->sql;

		$result = $this->result;

		unset($this->result['sql']);
		unset($this->result['params']);
			
		return (array) $result;
	}
}