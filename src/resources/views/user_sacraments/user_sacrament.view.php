<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <h1 class="title">User Sacraments</h1>
        <button id="attachBtn" class="action-btn">Attach User to Sacrament</button>

        <table class="sacraments-table">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Sacrament</th>
                <th>Sacrament Date</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userSacraments as $sacrament): ?>
                <tr class="table-row" data-user-id="<?= htmlspecialchars($sacrament['user_id']) ?>" data-id="<?= htmlspecialchars($sacrament['id']) ?>" data-sacrament-id="<?= htmlspecialchars($sacrament['sacrament_id']) ?>">
                    <td><?= htmlspecialchars($sacrament['first_name']) ?></td>
                    <td><?= htmlspecialchars($sacrament['last_name']) ?></td>
                    <td><?= htmlspecialchars($sacrament['sacrament_name']) ?></td>
                    <td><?= htmlspecialchars($sacrament['sacrament_date']) ?></td>
                    <td><?= htmlspecialchars($sacrament['location']) ?></td>
                    <td>
                        <button class="action-btn detach-btn"
                                data-sacrament-id="<?= htmlspecialchars($sacrament['sacrament_id']) ?>"
                                data-user-id="<?= htmlspecialchars($sacrament['user_id']) ?>">Detach</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Attach Modal -->
<div id="attachModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Attach User to Sacrament</h2>
        <form id="attachForm" method="POST" action="<?= path('/user-sacraments/attach') ?>">
            <label for="attachUserId">User:</label>
            <select id="attachUserId" name="user_id" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?= htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="attachSacramentId">Sacrament:</label>
            <select id="attachSacramentId" name="sacrament_id" required>
                <?php foreach ($sacraments as $sacrament): ?>
                    <option value="<?= htmlspecialchars($sacrament['id']) ?>"><?= htmlspecialchars($sacrament['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="sacramentDate">Date:</label>
            <input type="date" id="sacramentDate" name="sacrament_date" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <button type="submit" class="confirm-btn">Attach</button>
        </form>
    </div>
</div>

<!-- Detach Modal -->
<div id="detachModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Detach User from Sacrament</h2>
        <p>Are you sure you want to detach this user from the sacrament?</p>
        <form id="detachForm" method="POST" action="<?= path('/user-sacraments/detach') ?>">
            <input type="hidden" name="sacrament_id" id="detachSacramentId">
            <input type="hidden" name="user_id" id="detachUserId">
            <button type="submit" class="confirm-btn">Yes, Detach</button>
            <button type="button" class="cancel-btn">Cancel</button>
        </form>
    </div>
</div>
