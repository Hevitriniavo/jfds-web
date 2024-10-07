<?= include_component("sidebar") ?>
<div class="content">
    <h1>Events</h1>

    <button id="openCreateModal" class="btn">Add Event</button>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($events)): ?>
            <tr>
                <td colspan="7" class="no-data">No events found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($events as $event): ?>
                <tr data-id="<?= $event['id'] ?>"
                    data-name="<?= $event['name'] ?>"
                    data-description="<?= $event['description'] ?>"
                    data-start_date="<?= $event['start_date'] ?>"
                    data-end_date="<?= $event['end_date'] ?>"
                    data-location="<?= $event['location'] ?>">
                    <td><?= $event['id'] ?></td>
                    <td><?= $event['name'] ?></td>
                    <td><?= $event['description'] ?></td>
                    <td><?= $event['start_date'] ?></td>
                    <td><?= $event['end_date'] ?></td>
                    <td><?= $event['location'] ?></td>
                    <td>
                        <button class="editButton btn">Edit</button>
                        <button class="deleteButton btn">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Create Modal -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span id="closeCreateModal" class="close">&times;</span>
            <h2>Create Event</h2>
            <form id="createForm" action="<?= path('events/create') ?>" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Event Name" required>

                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Event Description" required></textarea>

                <label for="start_date">Start Date</label>
                <input type="datetime-local" id="start_date" name="start_date" required>

                <label for="end_date">End Date</label>
                <input type="datetime-local" id="end_date" name="end_date" required>

                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Event Location">

                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span id="closeUpdateModal" class="close">&times;</span>
            <h2>Update Event</h2>
            <form id="updateForm" action="<?= path('events/update') ?>" method="POST">
                <input type="hidden" id="updateId" name="id">

                <label for="updateName">Name</label>
                <input type="text" name="name" id="updateName" placeholder="Event Name" required>

                <label for="updateDescription">Description</label>
                <textarea name="description" id="updateDescription" placeholder="Event Description" required></textarea>

                <label for="updateStartDate">Start Date</label>
                <input type="datetime-local" name="start_date" id="updateStartDate" required>

                <label for="updateEndDate">End Date</label>
                <input type="datetime-local" name="end_date" id="updateEndDate" required>

                <label for="updateLocation">Location</label>
                <input type="text" name="location" id="updateLocation" placeholder="Event Location">

                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span id="closeDeleteModal" class="close">&times;</span>
            <h2>Delete Event</h2>
            <p>Are you sure you want to delete this event?</p>
            <form id="deleteForm" action="<?= path('events/delete') ?>" method="POST">
                <input type="hidden" id="deleteId" name="id">
                <button type="submit" class="btn">Delete</button>
            </form>
        </div>
    </div>
</div>
