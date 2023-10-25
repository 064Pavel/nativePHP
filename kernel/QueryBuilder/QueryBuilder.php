<?php

namespace App\Kernel\QueryBuilder;

use App\Kernel\Contracts\QueryBuilderInterface;
use App\Kernel\Database\Database;
use PDO;

class QueryBuilder implements QueryBuilderInterface
{
    private Database $db;
    private PDO $pdo;

    protected string $table; 
    protected array $select = ['*']; 
    protected array $where = [];
    protected array $orderBy = [];
    protected ?int $limit = null; 

    protected array $joins = [];
    protected array $groupBy = [];
    protected array $having = [];
    protected array $havingParams = [];

    public function __construct(Database $database)
    {
        $this->db = $database;
        $this->pdo = $database->getPDO();
    }

    public function table(string $table): static
    {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns = ['*']): static
    {
        $this->select = $columns;
        return $this;
    }

    public function where(string $column, string $operator, string $value): static
    {
        $this->where[] = [$column, $operator, $value];
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): static
    {
        $this->orderBy[] = [$column, $direction];
        return $this;
    }

    public function limit(int $count): static
    {
        $this->limit = $count;
        return $this;
    }

    public function get(): array
    {
        $query = "SELECT " . implode(', ', $this->select) . " FROM " . $this->table;
        if (!empty($this->where)) {
            $query .= " WHERE ";
            foreach ($this->where as $condition) {
                $query .= $condition[0] . " " . $condition[1] . " " . $this->pdo->quote($condition[2]) . " AND ";
            }
            $query = rtrim($query, " AND ");
        }
        if (!empty($this->orderBy)) {
            $query .= " ORDER BY ";
            foreach ($this->orderBy as $order) {
                $query .= $order[0] . " " . $order[1] . ", ";
            }
            $query = rtrim($query, ", ");
        }
        if (!empty($this->limit)) {
            $query .= " LIMIT " . $this->limit;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function first(): ?array
    {
        $results = $this->limit(1)->get();
        return empty($results) ? null : $results[0];
    }

    public function delete($id): int
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = " . (int)$id;
        return $this->pdo->exec($query);
    }

    public function create(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_map(fn ($value) => $this->pdo->quote($value), $data));
        $query = "INSERT INTO " . $this->table . " ($columns) VALUES ($values)";
        return $this->pdo->exec($query);
    }

    public function update(int $id, array $data): bool
    {
        $setClause = [];
        foreach ($data as $column => $value) {
            $setClause[] = "$column = " . $this->pdo->quote($value);
        }
        $setClause = implode(', ', $setClause);

        $query = "UPDATE " . $this->table . " SET $setClause WHERE id = " . (int)$id;
        return $this->pdo->exec($query);
    }

    public function join(string $table, string $first, string $operator, string $second, string $type = 'inner'): static
    {
        $joinClause = "$type JOIN $table ON $first $operator $second";
        $this->joins[] = $joinClause;
        return $this;
    }

    public function groupBy(string $column): static
    {
        $this->groupBy[] = $column;
        return $this;
    }

    public function having(string $column, string $operator, string $value): static
    {
        $havingClause = "$column $operator :having_value";
        $this->having[] = $havingClause;
        $this->havingParams[':having_value'] = $value;
        return $this;
    }

}