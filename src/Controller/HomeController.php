<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;

class HomeController
{
    public function index(): string
    {
        $users = $this->getTeamMembers();
        $events = $this->getEvents();
        $activities = $this->getActivities();
        $historyPresence = $this->getPresences();

        return views("home.view", [
            "users" => $users,
            "events" => $events,
            "histories" => $historyPresence,
            "activities" => $activities
        ]);
    }

    public function getTeamMembers(): array
    {
        $sql = "
        SELECT 
            u.id AS user_id, 
            u.first_name, 
            u.last_name, 
            u.photo, 
            r.name AS role_name, 
            m.name AS member_name
        FROM users u
        LEFT JOIN roles r ON u.role_id = r.id
        LEFT JOIN member_users mu ON u.id = mu.user_id
        LEFT JOIN members m ON mu.member_id = m.id
        ";

        $repo = CrudRepository::getInstance("users");
        return $repo->query($sql);
    }

    private function getEvents(): array
    {
        $sql = "
        SELECT 
            id,
            name,
            description,
            start_date,
            end_date,
            location,
            created_at,
            updated_at
        FROM events
        ";

        $repo = CrudRepository::getInstance("events");
        return $repo->query($sql);
    }

    private function getActivities(): array
    {
        $sql = "
        SELECT 
            id,
            name,
            description,
            start_date,
            location,
            organizer_id
        FROM activities
        WHERE DATE(start_date) = CURDATE()  
        LIMIT 3  
        ";

        $repo = CrudRepository::getInstance("activities");
        return $repo->query($sql);
    }

    private function getPresences(): array
    {
        $sql = "
        SELECT 
            a.id AS activity_id,
            a.name AS activity_name,
            u.id AS user_id,
            u.first_name,
            u.last_name,
            at.is_present,
            at.created_at
        FROM attendances at
        JOIN activities a ON at.activity_id = a.id
        JOIN users u ON at.user_id = u.id
        WHERE a.start_date < NOW()  
        ";

        $repo = CrudRepository::getInstance("attendances");
        return $repo->query($sql);
    }
}
