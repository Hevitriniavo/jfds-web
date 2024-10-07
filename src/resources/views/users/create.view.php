    <?= include_component("sidebar") ?>

    <div class="content">

        <div class="container">
            <h1 class="title">Add User</h1>
            <form id="userForm" method="POST" action="<?= path('/users/create') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>

                <div class="form-group">
                    <label for="cin">CIN:</label>
                    <input type="text" id="cin" name="cin" required>
                </div>

                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>


                <div class="form-group">
                    <label for="birth_date">Birth Date:</label>
                    <input type="date" id="birth_date" name="birth_date" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" rows="3" ></textarea>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="apv">APV:</label>
                    <input type="text" id="apv" name="apv">
                </div>

                <div class="form-group">
                    <label for="responsibility_id">Responsibility:</label>
                    <select id="responsibility_id" name="responsibility_id">
                        <option value="">Select Responsibility</option>
                        <?php foreach ($responsibilities as $responsibility): ?>
                            <option value="<?= $responsibility['id'] ?>"><?= htmlspecialchars($responsibility['name'], ENT_QUOTES) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Add User</button>
            </form>
        </div>

    </div>
