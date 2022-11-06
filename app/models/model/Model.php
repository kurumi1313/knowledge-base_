<?php
declare(strict_types=1);

namespace app\models\model;

use core\helper\Config;
use core\database\DB;
use core\database\querybuilder\QueryBuilder;

class Model 
{
    protected $db;
    protected $qb;

    public function __construct()
    {
        $this->db = new DB(Config::database());
        $this->db->connect();
        $this->qb = new QueryBuilder();
    }
    
}