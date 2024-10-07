    <?= include_component("sidebar") ?>

    <div class="content">
        <div class="container">
            <h1 class="title">Users</h1>
            <a id="createBtn" class="action-btn" href="<?= path("/users/create/form") ?>">Add User</a>

            <table class="users-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>CIN</th>
                    <th>Photo</th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>APV</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr class="table-row"
                        data-id="<?= $user['id'] ?>"
                        data-role_id="<?= $user['role_id'] ?>"
                        data-first_name="<?= htmlspecialchars($user['first_name'] ?? '', ENT_QUOTES) ?>"
                        data-last_name="<?= htmlspecialchars($user['last_name'] ?? '', ENT_QUOTES) ?>"
                        data-cin="<?= htmlspecialchars($user['cin'] ?? '', ENT_QUOTES) ?>"
                        data-username="<?= htmlspecialchars($user['username'] ?? '', ENT_QUOTES) ?>"
                        data-gender="<?= htmlspecialchars($user['gender'] ?? '', ENT_QUOTES) ?>"
                        data-birth_date="<?= htmlspecialchars($user['birth_date'] ?? '', ENT_QUOTES) ?>"
                        data-address="<?= htmlspecialchars($user['address'] ?? '', ENT_QUOTES) ?>"
                        data-photo="<?= htmlspecialchars($user['photo'] ?? '', ENT_QUOTES) ?>"
                        data-qr_code="<?= htmlspecialchars($user['qr_code'] ?? '', ENT_QUOTES) ?>"
                        data-apv="<?= htmlspecialchars($user['apv'] ?? '', ENT_QUOTES) ?>"
                        data-responsibility_id="<?= $user['responsibility_id'] ?>">
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['first_name'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['last_name'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['cin'] ?? '', ENT_QUOTES) ?></td>

                        <td><img src="<?= pubUrl("assets".DIRECTORY_SEPARATOR.$user['photo'])?>" alt="User Photo"
                                 style="width: 50px; height: auto;"></td>
                        <td><?= htmlspecialchars($user['birth_date'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['address'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['username'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['gender'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['apv'] ?? '', ENT_QUOTES) ?></td>
                        <td>
                            <a class="action-btn edit-btn" data-action="edit" href="<?= path("/users/update/form?updateId=".$user['id']) ?>" >Edit</a>
                            <button class="action-btn delete-btn" data-action="delete">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <a id="createBtn" class="action-btn" href="<?= path("/roles/form") ?>">update Role</a>
            <a id="createBtn" class="action-btn" href="<?= path("/users/responsibilities/form") ?>">update responsibility</a>
        </div>

    </div>

    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this user?</p>
            <form id="deleteForm" method="POST" action="<?= path('/users/delete') ?>">
                <input type="hidden" name="id" id="deleteId">
                <input type="hidden" name="photo" id="deletePhoto">
                <button type="submit" class="confirm-btn">Yes, Delete</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>
