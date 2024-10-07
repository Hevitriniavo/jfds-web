<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <h1 class="title">Attendance Records</h1>
        <button id="markAttendanceBtn" class="action-btn">Mark Attendance</button>

        <table class="attendance-table">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Activity</th>
                <th>Is Present</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($attendances as $attendance): ?>
                <tr class="table-row" data-id="<?= htmlspecialchars($attendance['id'] ?? '') ?>">
                    <td><?= htmlspecialchars($attendance['first_name'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($attendance['last_name'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($attendance['activity_name'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($attendance['is_present'] ? 'Yes' : 'No') ?></td>
                    <td>
                        <button class="action-btn update-btn" data-id="<?= htmlspecialchars($attendance['id'] ?? '') ?>" data-is-present="<?= htmlspecialchars($attendance['is_present'] ?? '0') ?>">Update</button>
                        <button class="action-btn remove-btn" data-id="<?= htmlspecialchars($attendance['id'] ?? '') ?>">Remove</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

<div id="markAttendanceModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Mark Attendance</h2>
        <form id="markAttendanceForm" method="POST" action="<?= path('/attendances/mark') ?>">
            <label for="markUserId">User:</label>
            <select id="markUserId" name="user_id" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="markActivityId">Activity:</label>
            <select id="markActivityId" name="activity_id" required>
                <?php foreach ($activities as $activity): ?>
                    <option value="<?= htmlspecialchars($activity['id']) ?>"><?= htmlspecialchars($activity['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="isPresent">Is Present:</label>
            <select id="isPresent" name="is_present" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            <button type="submit" class="confirm-btn">Mark</button>
        </form>
    </div>
</div>

<div id="updateAttendanceModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Update Attendance</h2>
        <form id="updateAttendanceForm" method="POST" action="<?= path('/attendances/update') ?>">
            <input type="hidden" name="attendance_id" id="updateAttendanceId">
            <label for="updateIsPresent">Is Present:</label>
            <select id="updateIsPresent" name="is_present"  required>
                <option  value="1">Yes</option>
                <option value="0">No</option>
            </select>

            <button type="submit" class="confirm-btn">Update</button>
        </form>
    </div>
</div>

<div id="removeAttendanceModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Remove Attendance</h2>
        <p>Are you sure you want to remove this attendance record?</p>
        <form id="removeAttendanceForm" method="POST" action="<?= path('/attendances/remove') ?>">
            <input type="hidden" name="attendance_id" id="removeAttendanceId">
            <button type="submit" class="confirm-btn">Yes, Remove</button>
            <button type="button" class="cancel-btn">Cancel</button>
        </form>
    </div>
</div>