<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>


        <div class="container mx-auto mt-4">
                <h1>Fikambanana Masina</h1>

                <button id="openCreateModal" class="btn">Hamrona Fikambanana Masina</button>

                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kaody</th>
                        <th>Anarara</th>
                        <th>Hetsika</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($associations)): ?>
                        <tr>
                            <td colspan="4" class="no-data">Tsy misy fikambanana masina.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($associations as $association): ?>
                            <tr data-id="<?= $association['id'] ?>" data-code="<?= $association['code'] ?>" data-name="<?= $association['name'] ?>">
                                <td><?= $association['id'] ?></td>
                                <td><?= $association['code'] ?></td>
                                <td><?= $association['name'] ?></td>
                                <td>
                                    <button class="editButton btn">Manova</button>
                                    <button class="deleteButton btn">Mamafa</button>
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
                        <h2>Famoronana Fikambanana Masina</h2>
                        <form id="createForm" action="<?= path('associations/create') ?>" method="POST">
                            <label for="code">Kaody</label>
                            <input type="text" id="code" name="code" placeholder="Kaody" required>

                            <label for="name">Anarana</label>
                            <input type="text" id="name" name="name" placeholder="Anarana" required>

                            <button type="submit" class="btn">Hoforonina</button>
                        </form>
                    </div>
                </div>

                <!-- Update Modal -->
                <div id="updateModal" class="modal">
                    <div class="modal-content">
                        <span id="closeUpdateModal" class="close">&times;</span>
                        <h2>Fanovana Fikambanana Masina</h2>
                        <form id="updateForm" action="<?= path('associations/update') ?>" method="POST">
                            <input type="hidden" id="updateId" name="id">

                            <label for="updateCode">Kaody</label>
                            <input type="text" name="code" id="updateCode" placeholder="Kaody" required>

                            <label for="updateName">Name</label>
                            <input type="text" name="name" id="updateName" placeholder="Anarana" required>

                            <button type="submit" class="btn">Hovaina</button>
                        </form>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <span id="closeDeleteModal" class="close">&times;</span>
                        <h2>Fanenkena Famafana</h2>
                        <p>Tena ho fafainao marina ve ny fikambanana masina?</p>
                        <form id="deleteForm" action="<?= path('associations/delete') ?>" method="POST">
                            <input type="hidden" id="deleteId" name="id">
                            <div class="cancel-btn-group-delete">
                                <button type="submit" class="confirm-btn">Eny</button>
                                <button type="button" class="cancel-btn">Tsia</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <footer>
            <p>&copy; <?= date("Y") ?> My Application. All rights reserved.</p>
        </footer>

    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

