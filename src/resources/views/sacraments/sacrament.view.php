<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>


        <div class="container mx-auto mt-4">
                    <h1 class="title">Sakramenta</h1>
                    <button id="createBtn" class="action-btn btn">Hamorona Sakramenta</button>

                    <table class="responsibilities-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Anarana</th>
                            <th>Hetsika</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sacraments as $sacrament): ?>
                            <tr class="table-row" data-id="<?= $sacrament['id'] ?>" data-name="<?= $sacrament['name'] ?>">
                                <td><?= $sacrament['id'] ?></td>
                                <td><?= $sacrament['name'] ?></td>
                                <td>
                                    <button class="action-btn btn edit-btn" data-action="edit">Manova</button>
                                    <button class="action-btn btn delete-btn" data-action="delete">Mamafa</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

            <!-- Create Modal -->
            <div id="createModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>Famoronana Sakramenta</h2>
                    <form id="createForm" method="POST" action="<?= path("/sacraments/create") ?>">
                        <label for="createName">Anarana:</label>
                        <input type="text" id="createName" name="name" placeholder="Anarana ny sakramenta" required>
                        <button type="submit" class="confirm-btn">hoforonina</button>
                    </form>
                </div>
            </div>

            <!-- Edit Modal -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>Fanovana Sacramenta</h2>
                    <form id="editForm" method="POST" action="<?= path("/sacraments/update") ?>">
                        <input type="hidden" name="id" id="editId">
                        <label for="editName">Anarana:</label>
                        <input type="text" id="editName" name="name" placeholder="Anarana ny sakramenta" required>
                        <button type="submit" class="confirm-btn">Hovaina</button>
                    </form>
                </div>
            </div>

            <!-- Delete Modal -->
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>Fanenkena Famafana</h2>
                    <p>Tena ho fafaina marina ve ny sakramenta ?</p>
                    <form id="deleteForm" method="POST" action="<?= path("/sacraments/delete") ?>">
                        <input type="hidden" name="id" id="deleteId">
                        <div class="cancel-btn-group-delete">
                            <button type="button" class="cancel-btn btn delete-btn">Tsia</button>
                            <button type="submit" class="confirm-btn btn">Eny</button>
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

