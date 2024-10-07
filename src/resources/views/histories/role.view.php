<?= include_component("sidebar") ?>
<div class="content">
    <h1>Role Management</h1>
    <form id="roleForm" method="post" action="<?= path("/roles/users/update") ?>">
        <div class="form-group">
            <label for="userSelect">Select User:</label>
            <select id="userSelect" name="user_id" required>
                <option value="" disabled selected>Select a user</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>">
                        <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="roleSelect">Select Role:</label>
            <select id="roleSelect" name="role_id" required>
                <option value="" disabled selected>Select a role</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['id'] ?>">
                        <?= htmlspecialchars($role['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn">Update Role</button>
    </form>
</div>
