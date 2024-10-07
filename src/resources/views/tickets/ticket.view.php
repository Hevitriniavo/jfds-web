<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <h1 class="title">Tickets</h1>
        <button id="createBtn" class="action-btn">Create Ticket</button>

        <table class="responsibilities-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Event Name</th>
                <th>From</th>
                <th>To</th>
                <th>Paid</th>
                <th>Distribution</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tickets as $ticket): ?>
                <tr class="table-row"
                    data-id="<?= htmlspecialchars($ticket['id']) ?>"
                    data-user-id="<?= htmlspecialchars($ticket['user_id']) ?>"
                    data-event-id="<?= htmlspecialchars($ticket['event_id']) ?>"
                    data-from="<?= htmlspecialchars($ticket['from']) ?>"
                    data-to="<?= htmlspecialchars($ticket['to']) ?>"
                    data-paid="<?= htmlspecialchars($ticket['is_paid']) ?>"
                    data-distribution="<?= htmlspecialchars($ticket['distribution']) ?>"
                    data-created-at="<?= htmlspecialchars($ticket['created_at']) ?>">
                    <td><?= htmlspecialchars($ticket['id']) ?></td>
                    <td><?= htmlspecialchars($ticket['user_name']) ?></td>
                    <td><?= htmlspecialchars($ticket['event_name']) ?></td>
                    <td><?= htmlspecialchars($ticket['from']) ?></td>
                    <td><?= htmlspecialchars($ticket['to']) ?></td>
                    <td><?= $ticket['is_paid'] ? 'Yes' : 'No' ?></td>
                    <td><?= htmlspecialchars($ticket['distribution']) ?></td>
                    <td>
                        <button class="action-btn edit-btn" data-action="edit">Edit</button>
                        <button class="action-btn delete-btn" data-action="delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Create Ticket Modal -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Create Ticket</h2>
            <form id="createForm" method="POST" action="<?= htmlspecialchars(path("/tickets/create")) ?>">
                <label for="user_id">User:</label>
                <select id="user_id" name="user_id" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="event_id">Event:</label>
                <select id="event_id" name="event_id" required>
                    <?php foreach ($events as $event): ?>
                        <option value="<?= htmlspecialchars($event['id']) ?>"><?= htmlspecialchars($event['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="from">From:</label>
                <input type="number" id="from" name="from" required>

                <label for="to">To:</label>
                <input type="number" id="to" name="to" required>

                <label for="is_paid">Paid:</label>
                <input type="checkbox" id="is_paid" name="is_paid" value="1">

                <label for="distribution">Distribution:</label>
                <input type="text" id="distribution" name="distribution">

                <button type="submit" class="confirm-btn">Create</button>
            </form>
        </div>
    </div>

    <!-- Update Ticket Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Update Ticket</h2>
            <form id="updateForm" method="POST" action="<?= htmlspecialchars(path("/tickets/update")) ?>">
                <input type="hidden" id="update_ticket_id" name="ticket_id">

                <label for="update_user_id">User:</label>
                <select id="update_user_id" name="user_id" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="update_event_id">Event:</label>
                <select id="update_event_id" name="event_id" required>
                    <?php foreach ($events as $event): ?>
                        <option value="<?= htmlspecialchars($event['id']) ?>"><?= htmlspecialchars($event['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="update_from">From:</label>
                <input type="number" id="update_from" name="from" required>

                <label for="update_to">To:</label>
                <input type="number" id="update_to" name="to" required>

                <label for="update_is_paid">Paid:</label>
                <input type="checkbox" id="update_is_paid" name="is_paid" value="1">

                <label for="update_distribution">Distribution:</label>
                <input type="text" id="update_distribution" name="distribution">

                <button type="submit" class="confirm-btn">Update</button>
            </form>
        </div>
    </div>

    <!-- Delete Ticket Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <form action="<?= path("tickets/delete") ?>" method="post">
                <span class="close-btn">&times;</span>
                <input type="hidden" name="id" id="delete_id">
                <h2>Are you sure you want to delete this ticket?</h2>
                <button type="submit" id="confirmDelete" class="confirm-btn">Yes</button>
                <button type="button" class="close-btn">No</button>
            </form>
        </div>
    </div>
</div>

