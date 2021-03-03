<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(',', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertMultiple($table, $col, $rows)
    {
        $sql = "insert into {$table} ($col) values ";
        $paramArray = array();
        $sqlArray = array();

        foreach($rows as $row)
        {
            $sqlArray[] = '(' . implode(',', array_fill(0, count($row), '?')) . ')';
            foreach($row as $element)
            {
                $paramArray[] = $element;
            }
        }

        $sql .= implode(',', $sqlArray);
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($paramArray);
    }
}
