<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;

class CalendarController
{
    private CrudRepository $activityRepository;

    public function __construct()
    {
        $this->activityRepository = CrudRepository::getInstance('activities');
    }

    public function index(): string
    {
        return views("calendars/index.view");
    }

    public function getAllActivities(): string
    {
        $events = $this->activityRepository->read();
        return $this->jsonResponse($events);
    }

    private function jsonResponse(array $data): string
    {
        header('Content-Type: application/json');
        return json_encode($data);
    }

    public function getActivityDetailsById(): string
    {
        $activityId = $this->getActivityIdFromRequest();

        if ($activityId === null) {
            return $this->jsonErrorResponse(400, 'Activity ID is required and must be a valid number.');
        }

        $activityDetails = $this->fetchActivityDetails($activityId);

        if ($activityDetails === null) {
            return $this->jsonErrorResponse(404, 'Activity not found.');
        }

        return $this->jsonResponse($activityDetails);
    }

    private function getActivityIdFromRequest(): ?int
    {
        if (!isset($_GET['activity_id']) || !is_numeric($_GET['activity_id'])) {
            return null;
        }
        return (int)$_GET['activity_id'];
    }

    private function jsonErrorResponse(int $statusCode, string $errorMessage): string
    {
        header("HTTP/1.1 $statusCode");
        return json_encode(['error' => $errorMessage]);
    }

    private function fetchActivityDetails(int $activityId): ?array
    {
        $detailsQuery = "SELECT 
        a.name AS activity_name,
        a.id AS activity_id,
        a.organizer_id AS organizer_id,
        a.description AS activity_description,
        a.start_date AS activity_start_date,
        a.location AS activity_location,
        u.first_name AS organizer_first_name,
        u.last_name AS organizer_last_name
    FROM 
        activities a
    LEFT JOIN 
        users u ON a.organizer_id = u.id
    WHERE 
        a.id = ?";

        $result = $this->activityRepository->query($detailsQuery, [$activityId]);
        return $result[0] ?? null;
    }
}
