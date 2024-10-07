<?php

namespace App\Core\Repository;

use App\Connection\Connection;
use Exception;
use PDO;
use PDOException;

class CrudRepository
{
    protected QueryBuilder $queryBuilder;
    protected PDO $pdo;

    private static array $instances = [];

    private function __construct(string $table)
    {
        $this->queryBuilder = new QueryBuilder($table);
        $this->pdo = Connection::getInstance()->getPdo();
    }

    public static function getInstance(?string $table = null): ?self
    {

        if (!isset(self::$instances[$table])) {
            self::$instances[$table] = new self($table);
        }

        return self::$instances[$table];
    }


    public function create(array $data): bool
    {
        $query = $this->queryBuilder->create($data);
        return $this->execute($query);
    }

    public function read(array $columns = ['*']): array
    {
        $query = $this->queryBuilder->select($columns)->buildQuery();
        return $this->fetchAll($query);
    }

    public function update(array $data, array $wheres = []): bool
    {
        $query = $this->queryBuilder->update($data, $wheres);
        return $this->execute($query);
    }

    public function delete(array $params): bool
    {
        $query = $this->queryBuilder->delete($params);
        return $this->execute($query);
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->queryBuilder->where($column, $operator, $value);
        return $this;
    }



    public function transaction(callable $callback): void
    {
        try {
            $this->pdo->beginTransaction();
            $callback($this);
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e->getMessage();
        }
    }

    private function execute(string $query): bool
    {
        try {
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function fetchAll(string $query): array
    {
        try {
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function find(array $conditions): ?array
    {
        foreach ($conditions as $column => $value) {
            $this->where($column, '=', $value);
        }
        $query = $this->queryBuilder->buildQuery();
        $result = $this->fetchAll($query);

        return !empty($result) ? $result[0] : null;
    }


    public function select(array $columns = ['*']): self
    {
        $this->queryBuilder->select($columns);
        return $this;
    }


    public function fetchMembersWithDetails(): array
    {
        $query = "
            SELECT members.*, regions.name AS region_name, associations.name AS association_name , committees.name AS committee_name 
            FROM members
            LEFT JOIN committees ON members.committee_id = committees.id 
            LEFT JOIN regions ON members.region_id = regions.id 
            LEFT JOIN associations ON members.association_id = associations.id
        ";

        return $this->fetchAll($query);
    }

    public function fetchUserWithSacrament(): array
    {
        $query = "
            SELECT users.*, users.id as user_id,sacraments.id AS sacrament_id, sacraments.name AS sacrament_name, user_sacraments.sacrament_date,  user_sacraments.location
            FROM users
            INNER JOIN user_sacraments ON users.id = user_sacraments.user_id
            INNER JOIN sacraments ON user_sacraments.sacrament_id = sacraments.id
        ";

        return $this->fetchAll($query);
    }


    public function fetchAttendancesWithActivityUser(): array
    {
        $query = "
        SELECT activities.*, 
               users.id as user_id, 
               users.last_name, 
               users.first_name, 
               activities.id AS activity_id,
               activities.name AS activity_name,
               activities.start_date,
               attendances.is_present
        FROM users
        LEFT JOIN attendances ON users.id = attendances.user_id
        LEFT JOIN activities ON attendances.activity_id = activities.id
    ";

        return $this->fetchAll($query);
    }




    public function query(string $sql, array $params = []): array
    {
        try {
            $stmt = $this->pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue($key + 1, $value);
            }

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

}

