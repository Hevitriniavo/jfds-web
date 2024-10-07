<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use JetBrains\PhpStorm\NoReturn;

class StatisticController
{
    public function index(): string
    {
        return views("statistic.view");
    }

    #[NoReturn]
    public function getMemberCountByYear(): void
    {
        $userRepository = CrudRepository::getInstance("users");

        $sqlQuery = "
        SELECT 
            YEAR(created_at) AS year,
            COUNT(*) AS member_count
        FROM 
            members
        GROUP BY 
            YEAR(created_at)
        ORDER BY 
            YEAR(created_at);
        ";

        $this->sendJsonResponse($userRepository->query($sqlQuery));
    }

    #[NoReturn]
    public function getSexByYear(): void
    {
        $sql = "SELECT 
            YEAR(created_at) AS year,
            gender,
            COUNT(*) AS count
        FROM 
            users
        GROUP BY 
            YEAR(created_at), gender 
        ORDER BY 
            YEAR(created_at);
        ";

        $userRepo = CrudRepository::getInstance("users");
        $results = $userRepo->query($sql);

        $data = [];
        foreach ($results as $row) {
            $data[$row['year']][$row['gender']] = $row['count'];
        }

        $this->sendJsonResponse($data);
    }

    #[NoReturn]
    public function getSacramentByYear(): void
    {
        $sql = "
        SELECT 
            YEAR(sacrament_date) AS year,
            COUNT(*) AS sacrament_count
        FROM 
            user_sacraments
        GROUP BY 
            YEAR(sacrament_date)
        ORDER BY 
            YEAR(sacrament_date);
        ";

        $userRepo = CrudRepository::getInstance("user_sacraments");
        $this->sendJsonResponse($userRepo->query($sql));
    }

    #[NoReturn]
    public function getActivityByMonth(): void
    {
        $sql = "
    SELECT 
        DATE_FORMAT(a.start_date, '%Y-%m') AS month,
        COUNT(a.id) AS activity_count,
        SUM(IF(at.is_present = 1, 1, 0)) AS present_count,
        SUM(IF(at.is_present = 0, 1, 0)) AS absent_count
    FROM 
        activities a
    LEFT JOIN 
        attendances at ON a.id = at.activity_id
    GROUP BY 
        month
    ORDER BY 
        month;
    ";

        $activityRepo = CrudRepository::getInstance("activities");
        $this->sendJsonResponse($activityRepo->query($sql));
    }


    #[NoReturn]
    public function getBudgetByMonth(): void
    {
        $sql = "
        SELECT 
            DATE_FORMAT(date, '%Y-%m') AS month,
            SUM(amount) AS total_budget,
            SUM(CASE WHEN type = 'entrée' THEN amount ELSE 0 END) AS total_entry,
            SUM(CASE WHEN type = 'sortie' THEN amount ELSE 0 END) AS total_exit
        FROM 
            cash_registers
        GROUP BY 
            month
        ORDER BY 
            month;
        ";

        $budgetRepo = CrudRepository::getInstance("cash_registers");
        $this->sendJsonResponse($budgetRepo->query($sql));
    }

    #[NoReturn]
    public function getBudgetByYear(): void
    {
        $sql = "
        SELECT 
            YEAR(date) AS year,
            SUM(amount) AS total_budget,
            SUM(CASE WHEN type = 'entrée' THEN amount ELSE 0 END) AS total_entry,
            SUM(CASE WHEN type = 'sortie' THEN amount ELSE 0 END) AS total_exit
        FROM 
            cash_registers
        GROUP BY 
            year
        ORDER BY 
            year;
        ";

        $budgetRepo = CrudRepository::getInstance("cash_registers");
        $this->sendJsonResponse($budgetRepo->query($sql));
    }

    #[NoReturn] private function sendJsonResponse(array $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
