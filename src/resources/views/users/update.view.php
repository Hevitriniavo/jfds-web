<?= include_component('sidebar') ?>

<div class="content">
    <div class="container">
        <h1 class="title">Update User</h1>

        <form id="userForm" method="POST" action="<?= path('/users/update') ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name"
                       value="<?= isset($user['first_name']) ? htmlspecialchars($user['first_name'], ENT_QUOTES) : '' ?>" required>
            </div>

            <input type="hidden" id="id" name="id" value="<?= isset($user['id']) ?  htmlspecialchars($user['id'], ENT_QUOTES) : '' ?>" />
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name"
                       value="<?= isset($user['last_name']) ? htmlspecialchars($user['last_name'], ENT_QUOTES) : '' ?>" required>
            </div>

            <div class="form-group">
                <label for="cin">CIN:</label>
                <input type="text" id="cin" name="cin"
                       value="<?= isset($user['cin']) ? htmlspecialchars($user['cin'], ENT_QUOTES) : '' ?>" required>
            </div>

            <!-- Photo -->
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*">
            </div>

            <!-- Date de naissance -->
            <div class="form-group">
                <label for="birth_date">Birth Date:</label>
                <input type="date" id="birth_date" name="birth_date"
                       value="<?= isset($user['birth_date']) ? htmlspecialchars($user['birth_date'], ENT_QUOTES) : '' ?>" required>
            </div>

            <!-- Adresse -->
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3"><?= isset($user['address']) ? htmlspecialchars($user['address'], ENT_QUOTES) : '' ?></textarea>
            </div>

            <!-- Nom d'utilisateur -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"
                       value="<?= isset($user['username']) ? htmlspecialchars($user['username'], ENT_QUOTES) : '' ?>" required>
            </div>

            <!-- Genre -->
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male" <?= isset($user['gender']) && $user['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                    <option value="female" <?= isset($user['gender']) && $user['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                    <option value="other" <?= isset($user['gender']) && $user['gender'] == 'other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>

            <!-- APV -->
            <div class="form-group">
                <label for="apv">APV:</label>
                <input type="text" id="apv" name="apv"
                       value="<?= isset($user['apv']) ? htmlspecialchars($user['apv'], ENT_QUOTES) : '' ?>">
            </div>

            <!-- Responsabilité -->
            <div class="form-group">
                <label for="responsibility_id">Responsibility:</label>
                <select id="responsibility_id" name="responsibility_id">
                    <option value="">Select Responsibility</option>
                    <?php foreach ($responsibilities as $responsibility): ?>
                        <option value="<?= $responsibility['id'] ?>"
                            <?= isset($user['responsibility_id']) && $user['responsibility_id'] == $responsibility['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($responsibility['name'], ENT_QUOTES) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="submit-btn">Update User</button>
        </form>
    </div>
</div>
