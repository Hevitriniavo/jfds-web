<?php

namespace App\Controller;

use App\Core\Repository\CrudRepository;
use App\Core\Validator;

readonly class TicketController
{
    private CrudRepository $repository;
    private Validator $validator;

    public function __construct()
    {
        $this->repository = CrudRepository::getInstance('tickets');
        $this->validator = Validator::getInstance();
    }

    public function index(): string
    {
        $tickets = $this->repository->read();
        $users = CrudRepository::getInstance("users")->read(["id", "first_name", "last_name"]);
        $events = CrudRepository::getInstance("events")->read(["id", "name"]);

        foreach ($tickets as &$ticket) {
            $user = array_filter($users, function ($u) use ($ticket) {
                return $u['id'] == $ticket['user_id'];
            });
            $ticket['user_name'] = !empty($user) ? reset($user)['first_name'] . ' ' . reset($user)['last_name'] : 'Unknown';
            $event = array_filter($events, function ($e) use ($ticket) {
                return $e['id'] == $ticket['event_id'];
            });
            $ticket['event_name'] = !empty($event) ? reset($event)['name'] : 'Unknown';
        }

        return views("tickets/ticket.view", [
            "tickets" => $tickets,
            "users" => $users,
            "events" => $events
        ]);
    }

    public function create(): void
    {
        $userId = $_POST['user_id'] ?? null;
        $eventId = $_POST['event_id'] ?? null;
        $from = $_POST['from'] ?? null;
        $to = $_POST['to'] ?? null;
        $isPaid = $_POST['is_paid'] ?? false;
        $distribution = $_POST['distribution'] ?? null;

        $rules = [
            'user_id' => 'required|int',
            'event_id' => 'required|int',
            'from' => 'required|int',
            'to' => 'required|int',
            'is_paid' => 'boolean',
            'distribution' => 'string',
        ];

        $validationErrors = $this->validator->validate([
            'user_id' => $userId,
            'event_id' => $eventId,
            'from' => $from,
            'to' => $to,
            'is_paid' => $isPaid,
            'distribution' => $distribution,
        ], $rules);


        if (empty($validationErrors)) {
            $data = [
                'user_id' => $userId,
                'event_id' => $eventId,
                '`from`' => $from,
                '`to`' => $to,
                'is_paid' => $isPaid == "1",
                'distribution' => $distribution,
            ];


            $isCreate = $this->repository->create($data);

            if ($isCreate) {
                addFlashMessage("success", "Ticket created successfully.");
                $this->redirect();
            } else {
                addFlashMessage("error", "Failed to create ticket.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }

    private function redirect(): void
    {
        redirect("/tickets");
    }

    public function update(): void
    {
        $eventId = (int)$_POST['event_id'] ?? null;
        $userId = (int)$_POST['user_id'] ?? null;
        $ticketId = (int)$_POST['ticket_id'] ?? null;
        $from = (int)$_POST['from'] ?? null;
        $to = (int)$_POST['to'] ?? null;
        $isPaid = $_POST['is_paid'] ?? false;
        $distribution = $_POST['distribution'] ?? null;

        $rules = [
            'id' => 'required|int',
            'user_id' => 'required|int',
            'event_id' => 'required|int',
            '`from`' => 'required|int',
            '`to`' => 'required|int',
            'is_paid' => 'boolean',
            'distribution' => 'string',
        ];

        $validationErrors = $this->validator->validate([
            'id' => $ticketId,
            'event_id' => $eventId,
            'user_id' => $userId,
            '`from`' => $from,
            '`to`' => $to,
            'is_paid' => $isPaid == "1",
            'distribution' => $distribution,
        ], $rules);

        if (empty($validationErrors)) {
            $data = [
                'event_id' => $eventId,
                'user_id' => $userId,
                '`from`' => $from,
                '`to`' => $to,
                'is_paid' => $isPaid == "1",
                'distribution' => $distribution,
            ];

            $updated = $this->repository->update($data, ['id' => $ticketId]);

            if ($updated) {
                addFlashMessage("success", "Ticket updated successfully.");
            } else {
                addFlashMessage("error", "Failed to update ticket.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }

    public function delete(): void
    {
        $ticketId = (int)$_POST['id'] ?? null;


        $rules = [
            'ticket_id' => 'required|int',
        ];

        $validationErrors = $this->validator->validate([
            'ticket_id' => $ticketId,
        ], $rules);

        if (empty($validationErrors)) {
            if ($this->repository->delete(["id" => $ticketId])) {
                addFlashMessage("success", "Ticket removed successfully.");
            } else {
                addFlashMessage("error", "Failed to remove ticket.");
            }
        } else {
            addFlashMessage("error", implode(', ', array_merge(...array_values($validationErrors))));
        }

        $this->redirect();
    }
}
