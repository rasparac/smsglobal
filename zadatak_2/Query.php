<?php


class Query {

    protected $pdo;
    protected $query;
    protected $table;

    public function __construct(Connection $pdo, $table) {
        $this->pdo = $pdo->getPDO();
        $this->table = $table;
    }

    public function get() {
        $statement = $this->prepareAndExecute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function select(array $columns = ['*']) {
        $this->query = "SELECT " . implode(',', $columns) . ' FROM ' . $this->table;

        return $this;
    }

    public function insert(array $values, array $sanitize = []): int {
        $fields = array_keys($values);

        $this->query = "INSERT INTO " . $this->table . "(" . implode(", ", $fields) . ") VALUES (:" . implode(", :", $fields) .")";

        $values = filter_var_array($values, $sanitize);

        $this->prepareAndExecute($values);

        return (int) $this->pdo->lastInsertId();
    }

    private function prepareAndExecute(array $values = []) {
        $statement = $this->pdo->prepare($this->query);

        foreach ($values as $key => $value) {
            $statement->bindValue(":" . $key, $value);
        }

        $statement->execute();

        return $statement;
    }

}