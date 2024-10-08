<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>


        <div class="container mx-auto mt-4">
                <h1>Vaomeran'asa</h1>

                <button id="openCreateModal" class="btn ">Hampiditra vaomeran'asa</button>

                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kaody</th>
                        <th>Anarana</th>
                        <th>Hetsika</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($committees)): ?>
                        <tr>
                            <td colspan="4" class="no-data">Tsy misy vaomeran'asa.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($committees as $committee): ?>
                            <tr data-id="<?= $committee['id'] ?>" data-code="<?= $committee['code'] ?>" data-name="<?= $committee['name'] ?>">
                                <td><?= $committee['id'] ?></td>
                                <td><?= $committee['code'] ?></td>
                                <td><?= $committee['name'] ?></td>
                                <td>
                                    <button class="editButton btn">Manova</button>
                                    <button class="deleteButton btn">Mamafa</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>

                <div id="createModal" class="modal">
                    <div class="modal-content">
                        <span id="closeCreateModal" class="close">&times;</span>
                        <h2>Famoronana Vaomeran'asa</h2>
                        <form id="createForm" action="<?= path('committees/create') ?>" method="POST">
                            <label for="code">kaody</label>
                            <input type="text" id="code" name="code" placeholder="kaody" required>

                            <label for="name">Anarana</label>
                            <input type="text" id="name" name="name" placeholder="Anarana" required>

                            <button type="submit" class="btn">hoforonina</button>
                        </form>
                    </div>
                </div>

                <div id="updateModal" class="modal">
                    <div class="modal-content">
                        <span id="closeUpdateModal" class="close">&times;</span>
                        <h2>Fanovana vaomeran'asa</h2>
                        <form id="updateForm" action="<?= path('committees/update') ?>" method="POST">
                            <input type="hidden" id="updateId" name="id">

                            <label for="updateCode">Kaody</label>
                            <input type="text" name="code" id="updateCode" placeholder="Kaody" required>

                            <label for="updateName">Anarana</label>
                            <input type="text" name="name" id="updateName" placeholder="Anarana" required>

                            <button type="submit" class="btn">Hovaina</button>
                        </form>
                    </div>
                </div>

                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <span  class="close closeDeleteModal">&times;</span>
                        <h2>Fanenkena Famafana</h2>
                        <p>Tena ho fafainao marina ve ny vaomeran'asa?</p>
                        <form id="deleteForm" action="<?= path('committees/delete') ?>" method="POST">
                            <input type="hidden" id="deleteId" name="id">
                            <div class="cancel-btn-group-delete">
                                <button type="submit" class="confirm-btn" >Eny</button>
                                <button type="button" class="cancel-btn closeDeleteModal">Tsia</button>
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

