<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>
        <div class="container mx-auto mt-4">

            <h1 class="title">Andraikitra</h1>
            <button id="createBtn" class="action-btn btn">Hamorona Andraikitra</button>

            <table class="responsibilities-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Anarana</th>
                    <th>Hetsika</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($responsibilities as $responsibility): ?>
                    <tr class="table-row" data-id="<?= $responsibility['id'] ?>"
                        data-name="<?= $responsibility['name'] ?>">
                        <td><?= $responsibility['id'] ?></td>
                        <td><?= $responsibility['name'] ?></td>
                        <td>
                            <button class="action-btn btn edit-btn" data-action="edit">Manova</button>
                            <button class="action-btn btn delete-btn" data-action="delete">Mamafa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Create Modal -->
        <div id="createModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Famoronana Andraikitra</h2>
                <form id="createForm" method="POST" action="<?= path("/responsibilities/create") ?>">
                    <label for="createName">Anarana:</label>
                    <input type="text" id="createName" name="name" placeholder="Anarana ny andraikitra" required>
                    <button type="submit" class="confirm-btn">hoforonina</button>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Fanovana Andraikitra</h2>
                <form id="editForm" method="POST" action="<?= path("/responsibilities/update") ?>">
                    <input type="hidden" name="id" id="editId">
                    <label for="editName">Anarana:</label>
                    <input type="text" id="editName" name="name" placeholder="Anarana ny andraikitra" required>
                    <button type="submit" class="confirm-btn">Hovaina</button>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Fanenkena Famafana</h2>
                <p>Tena ho fafainao marina ve ny andraikitra?</p>
                <form id="deleteForm" method="POST" action="<?= path("/responsibilities/delete") ?>">
                    <input type="hidden" name="id" id="deleteId">
                    <div class="cancel-btn-group-delete">
                        <button type="button" class="cancel-btn btn delete-btn">Tsia</button>
                        <button type="submit" class="confirm-btn btn">Eny</button>
                    </div>
                </form>
            </div>
        </div>


        <footer>
            <p>&copy; <?= date("Y") ?> My Application. All rights reserved.</p>
        </footer>

    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

