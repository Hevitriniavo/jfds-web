<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class AttendanceController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('attendances');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $attendances = $this->repository->fetchAttendancesWithActivityUser();
        $users = CrudRepository::getInstance("users")->read(["id", "first_name", "last_name"]);
        $activities = CrudRepository::getInstance("activities")->read(["id", "name"]);

        return views("attendances/attendance.view", [
            "attendances" => $attendances,
            "users" => $users,
            "activities" => $activities
        ]);
    }

    public function create(): void
    {
        $userId = $_POST['user_id'] ?? null;
        $activityId = $_POST['activity_id'] ?? null;
        $isPresent = $_POST['is_present'] ?? null;
        $rules = [
            'user_id' => 'required|int',
            'activity_id' => 'required|int',
            'is_present' => 'required',
        ];

        $validationErrors = $this->validator->validate([
            'user_id' => $userId,
            'activity_id' => $activityId,
            'is_present' => $isPresent,
        ], $rules);

        if (empty($validationErrors)) {
            $data = [
                'user_id' => $userId,
                'activity_id' => $activityId,
                'is_present' => $isPresent,
            ];

            if ($this->repository->create($data)) {
                addFlashMessage("success", "Attendance recorded successfully.");
                $this->redirect();
            } else {
                addFlashMessage("error", "Failed to record attendance.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }

    private function redirect(): void
    {
        redirect("/attendances");
    }

    public function update(): void
    {
        $attendanceId = $_POST['attendance_id'] ?? null;
        $isPresent = $_POST['is_present'] ?? null;

        $rules = [
            'attendance_id' => 'required|int',
            'is_present' => 'required',
        ];

        $validationErrors = $this->validator->validate([
            'attendance_id' => $attendanceId,
            'is_present' => $isPresent,
        ], $rules);

        if (empty($validationErrors)) {
            $data = [
                'is_present' => $isPresent,
            ];

            $updated = $this->repository->update($data, ['id' => $attendanceId]);

            if ($updated) {
                addFlashMessage("success", "Attendance updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update attendance.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }

    public function remove(): void
    {
        $attendanceId = $_POST['attendance_id'] ?? null;

        $rules = [
            'attendance_id' => 'required|int',
        ];

        $validationErrors = $this->validator->validate([
            'attendance_id' => $attendanceId,
        ], $rules);

        if (empty($validationErrors)) {
            if ($this->repository->delete(["id" => $attendanceId])) {
                addFlashMessage("success", "Attendance removed successfully.");
            } else {
                addFlashMessage("error", "Failed to remove attendance.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }
}
