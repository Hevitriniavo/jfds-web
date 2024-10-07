<?= include_component("sidebar") ?>
<div class="content">
    <h1>User Role Responsibility</h1>
    <form id="responsibilityForm" method="post" action="<?= path("/users/responsibilities/update") ?>">
        <div class="form-group">
            <label for="userSelect">Select User:</label>
            <select id="userSelect" name="user_id" required>
                <option value="" disabled selected>Select a user</option> <!-- Empty option -->
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>">
                        <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="responsibilitySelect">Select Responsibility:</label>
            <select id="responsibilitySelect" name="responsibility_id">
                <option value="" disabled selected>Select a responsibility</option>
                <?php foreach ($responsibilities as $responsibility): ?>
                    <option value="<?= $responsibility['id'] ?>">
                        <?= htmlspecialchars($responsibility['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn">Update Responsibility</button>
    </form>
</div>
