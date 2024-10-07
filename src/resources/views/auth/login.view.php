<div class="container">
    <div class="top text-center mb-5">
        <h1 class="display-6">EKAR MD PIERA SY MD PAOLY SOAVIMASOANDRO</h1>
        <h2 class="lead text-muted">Youth of the Catholic Church</h2>
    </div>

    <div class="bottom row justify-content-center">
        <div class="card col-md-8 shadow-lg p-0">
            <div class="row g-0">
                <div class="left col-md-4 text-center p-4 bg-light">
                    <div class="logo">
                        <img src="<?= path("/assets/logo.jpeg") ?>" class="img-fluid rounded-circle mb-3" alt="Logo">
                    </div>
                </div>

                <div class="col-md-8 p-4">
                    <form method="POST" action="<?= path("/auth/login") ?>">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Enter your last name">
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Names</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="Enter your first names">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Choose Your Role</label>
                            <div class="roles">
                                <?php foreach ($roles as $role): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="role_<?= htmlspecialchars($role['id']) ?>" name="role_id" value="<?= htmlspecialchars($role['id']) ?>" required>
                                        <label class="form-check-label" for="role_<?= htmlspecialchars($role['id']) ?>">
                                            <?= htmlspecialchars($role['name']) ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="responsibility" class="form-label">Choose Your Responsibility</label>
                            <select class="form-select" id="responsibility" name="responsibility_id">
                                <option value="" disabled selected>Select a Responsibility</option>
                                <?php foreach ($responsibilities as $responsibility): ?>
                                    <option value="<?= $responsibility['id'] ?>"><?= htmlspecialchars($responsibility['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
