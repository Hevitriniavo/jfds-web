<?= include_component("sidebar") ?>
<div class="content">
    <h1>Activities</h1>

    <button id="openCreateModal" class="btn">Add Activity</button>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>Duration</th>
            <th>Location</th>
            <th>Organizer</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($activities)): ?>
            <tr>
                <td colspan="8" class="no-data">No activities found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($activities as $activity): ?>
                <tr data-id="<?= $activity['id'] ?>" data-name="<?= $activity['name'] ?>" data-description="<?= $activity['description'] ?>" data-start-date="<?= $activity['start_date'] ?>" data-duration="<?= $activity['duration'] ?>" data-location="<?= $activity['location'] ?>" data-organizer-id="<?= $activity['organizer_id'] ?>">
                    <td><?= $activity['id'] ?></td>
                    <td><?= $activity['name'] ?></td>
                    <td><?= $activity['description'] ?></td>
                    <td><?= $activity['start_date'] ?></td>
                    <td><?= $activity['duration'] ?></td>
                    <td><?= $activity['location'] ?></td>
                    <td><?= $activity['organizer_id'] ?></td>
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
            <h2>Create Activity</h2>
            <form id="createForm" action="<?= path('activities/create') ?>" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Activity Name" required>

                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Activity Description"></textarea>

                <label for="start_date">Start Date</label>
                <input type="datetime-local" id="start_date" name="start_date" required>

                <label for="duration">Duration</label>
                <input type="text" id="duration" name="duration" placeholder="Duration (e.g., 2 hours)">

                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Location">

                <label for="organizer_id">Organizer</label>
                <select id="organizer_id" name="organizer_id" required>
                    <?php if (empty($organizers)): ?>
                        <option value="" disabled selected>No organizers available</option>
                    <?php else: ?>
                        <?php foreach ($organizers as $organizer): ?>
                            <option value="<?= htmlspecialchars($organizer['id']) ?>">
                                <?= htmlspecialchars($organizer['last_name']) ?> <?= htmlspecialchars($organizer['first_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>


                <label for="isTruth">Is Truth</label>
                <select id="isTruth" name="isTruth" required>
                    <option value="TOUS">TOUS</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="FARITRA">FARITRA</option>
                    <option value="FIKAMBANANA">FIKAMBANANA</option>
                    <option value="VAOMIERAN'ASA">VAOMIERAN'ASA</option>
                </select>

                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span id="closeUpdateModal" class="close">&times;</span>
            <h2>Update Activity</h2>
            <form id="updateForm" action="<?= path('activities/update') ?>" method="POST">
                <input type="hidden" id="updateId" name="id">

                <label for="updateName">Name</label>
                <input type="text" name="name" id="updateName" placeholder="Activity Name" required>

                <label for="updateDescription">Description</label>
                <textarea name="description" id="updateDescription" placeholder="Activity Description"></textarea>

                <label for="updateStartDate">Start Date</label>
                <input type="datetime-local" name="start_date" id="updateStartDate" required>

                <label for="updateDuration">Duration</label>
                <input type="text" name="duration" id="updateDuration" placeholder="Duration (e.g., 2 hours)">

                <label for="updateLocation">Location</label>
                <input type="text" name="location" id="updateLocation" placeholder="Location">

                <label for="updateOrganizerId">Organizer</label>
                <select id="updateOrganizerId" name="organizer_id" required>
                    <?php if (empty($organizers)): ?>
                        <option value="" disabled selected>No organizers available</option>
                    <?php else: ?>
                        <?php foreach ($organizers as $organizer): ?>
                            <option value="<?= htmlspecialchars($organizer['id']) ?>">
                                <?= htmlspecialchars($organizer['last_name']) ?> <?= htmlspecialchars($organizer['first_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label for="updateIsTruth">Is Truth</label>
                <select id="updateIsTruth" name="isTruth" required>
                    <option value="TOUS">TOUS</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="FARITRA">FARITRA</option>
                    <option value="FIKAMBANANA">FIKAMBANANA</option>
                    <option value="VAOMIERAN'ASA">VAOMIERAN'ASA</option>
                </select>

                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span id="closeDeleteModal" class="close">&times;</span>
            <h2>Delete Activity</h2>
            <p>Are you sure you want to delete this activity?</p>
            <form id="deleteForm" action="<?= path('activities/delete') ?>" method="POST">
                <input type="hidden" id="deleteId" name="id">
                <button type="submit" class="btn">Delete</button>
            </form>
        </div>
    </div>
</div>

