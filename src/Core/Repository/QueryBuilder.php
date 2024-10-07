<?php

namespace App\Core\Repository;

use RuntimeException;

class QueryBuilder
{
    protected string $table;
    private array $selectColumns = ['*'];
    private array $whereConditions = [];
    private array $joinConditions = [];
    private ?string $orderBy = null;
    private ?string $limit = null;
    private ?string $offset = null;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function select(array $columns): self
    {
        $this->selectColumns = $columns;
        return $this;
    }

    public function between(string $column, $start, $end): self
    {
        $this->whereConditions[] = "{$column} BETWEEN {$start} AND {$end}";
        return $this;
    }

    public function isGreaterThan(string $column, $value): self
    {
        return $this->where($column, '>', $value);
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->whereConditions[] = "{$column} {$operator} " . $this->quoteValue($value);
        return $this;
    }

    public function isLessThan(string $column, $value): self
    {
        return $this->where($column, '<', $value);
    }

    public function isGreaterThanOrEquals(string $column, $value): self
    {
        return $this->where($column, '>=', $value);
    }

    public function isLessThanOrEquals(string $column, $value): self
    {
        return $this->where($column, '<=', $value);
    }

    public function contains(string $column, $value): self
    {
        return $this->where($column, 'LIKE', "%{$value}%");
    }

    public function containingIgnoreCase(string $column, $value): self
    {
        return $this->where("LOWER({$column})", 'LIKE', '%' . strtolower($value) . '%');
    }

    public function join(string $table, callable $onCondition): self
    {
        $this->joinConditions[] = "JOIN {$table} ON {$onCondition()}";
        return $this;
    }

    public function leftJoin(string $table, callable $onCondition): self
    {
        $this->joinConditions[] = "LEFT JOIN {$table} ON {$onCondition()}";
        return $this;
    }

    public function rightJoin(string $table, callable $onCondition): self
    {
        $this->joinConditions[] = "RIGHT JOIN {$table} ON {$onCondition()}";
        return $this;
    }

    public function innerJoin(string $table, callable $onCondition): self
    {
        $this->joinConditions[] = "INNER JOIN {$table} ON {$onCondition()}";
        return $this;
    }

    public function fullOuterJoin(string $table, callable $onCondition, string $leftAlias = "p1", string $rightAlias = "p2"): self
    {
        $this->joinConditions[] = "LEFT JOIN {$table} AS {$leftAlias} ON {$onCondition()}";
        $this->joinConditions[] = "RIGHT JOIN {$table} AS {$rightAlias} ON {$onCondition()}";
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy = "ORDER BY {$column} {$direction}";
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = "LIMIT {$limit}";
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = "OFFSET {$offset}";
        return $this;
    }

    public function create(array $data): string
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_map(fn($value) => $this->quoteValue($value), $data));
        return "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
    }

    public function delete(array $params): string
    {
        if (empty($params)) {
            throw new RuntimeException("At least one parameter is required for deletion.");
        }

        $whereConditions = array_map(fn($value, $key) => "{$key} = " . $this->quoteValue($value), $params, array_keys($params));
        return "DELETE FROM {$this->table} WHERE " . implode(' AND ', $whereConditions);
    }

    public function update(array $data, array $wheres = []): string
    {
        $setClauses = [];
        foreach ($data as $column => $value) {
            $setClauses[] = "{$column} = " . $this->quoteValue($value);
        }
        $setClause = implode(', ', $setClauses);
        $query = "UPDATE {$this->table} SET {$setClause}";

        $whereConditions = $this->whereConditions;
        foreach ($wheres as $key => $value) {
            $whereConditions[] = "{$key} = " . $this->quoteValue($value);
        }

        if (!empty($whereConditions)) {
            $query .= ' WHERE ' . implode(' AND ', $whereConditions);
        }

        return $query;
    }


    public function buildQuery(): string
    {
        $query = "SELECT " . implode(', ', $this->selectColumns) . " FROM {$this->table}";

        if (!empty($this->joinConditions)) {
            $query .= ' ' . implode(' ', $this->joinConditions);
        }

        if (!empty($this->whereConditions)) {
            $query .= ' WHERE ' . implode(' AND ', $this->whereConditions);
        }

        if ($this->orderBy) {
            $query .= ' ' . $this->orderBy;
        }

        if ($this->limit) {
            $query .= ' ' . $this->limit;
        }

        if ($this->offset) {
            $query .= ' ' . $this->offset;
        }

        return $query;
    }

    private function quoteValue($value): string
    {
        return "'" . addslashes($value) . "'";
    }
}
