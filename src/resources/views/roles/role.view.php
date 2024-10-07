<?= include_component("sidebar") ?>

<div class="content">
    <div class="container">
        <h1 class="title">Roles</h1>
        <button id="createBtn" class="action-btn">Create Role</button>

        <table class="responsibilities-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($roles as $role): ?>
                <tr class="table-row"
                    data-id="<?= htmlspecialchars($role['id']) ?>"
                    data-name="<?= htmlspecialchars($role['name']) ?>">
                    <td><?= htmlspecialchars($role['id']) ?></td>
                    <td><?= htmlspecialchars($role['name']) ?></td>
                    <td>
                        <button class="action-btn edit-btn" data-action="edit">Edit</button>
                        <button class="action-btn delete-btn" data-action="delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Create Role</h2>
            <form id="createForm" method="POST" action="<?= htmlspecialchars(path("/roles/create")) ?>">
                <label for="name">Role Name:</label>
                <input type="text" id="name" name="name" required>
                <button type="submit" class="confirm-btn">Create</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Update Role</h2>
            <form id="updateForm" method="POST" action="<?= htmlspecialchars(path("/roles/update")) ?>">
                <input type="hidden" id="update_role_id" name="role_id">
                <label for="update_name">Role Name:</label>
                <input type="text" id="update_name" name="name" required>
                <button type="submit" class="confirm-btn">Update</button>
            </form>
        </div>
    </div>

    <!-- Delete Role Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <form action="<?= path("roles/delete") ?>" method="post">
                <span class="close-btn">&times;</span>
                <input type="hidden" name="id" id="delete_id">
                <h2>Are you sure you want to delete this role?</h2>
                <button type="submit" id="confirmDelete" class="confirm-btn">Yes</button>
                <button type="button" class="close-btn">No</button>
            </form>
        </div>
    </div>
</div>
