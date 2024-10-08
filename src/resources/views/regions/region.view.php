<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>

        <div class="container mx-auto mt-4">
        <h1 class="title">Faritra</h1>
        <button id="createBtn" class="action-btn create-btn">Hampiditra Faritra</button>

        <table class="regions-table">
            <thead>
            <tr>
                <th class="table-header">ID</th>
                <th class="table-header">kaody</th>
                <th class="table-header">Anarana</th>
                <th class="table-header">Hetsika</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($regions as $region): ?>
                <tr class="table-row" data-id="<?= $region['id'] ?>" data-code="<?= $region['code'] ?>"
                    data-name="<?= $region['name'] ?>">
                    <td class="table-cell" data-label="ID"><?= $region['id'] ?></td>
                    <td class="table-cell" data-label="Code"><?= $region['code'] ?></td>
                    <td class="table-cell" data-label="Name"><?= $region['name'] ?></td>
                    <td class="table-cell" data-label="Actions">
                        <button class="action-btn edit-btn" data-action="edit">manova</button>
                        <button class="action-btn delete-btn" data-action="delete">mamafa</button>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>

        <div id="createModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Famoronana Faritra</h2>
                <form id="createForm" method="POST" action="<?= path("/regions/create") ?>">
                    <label for="createCode">Kaody:</label>
                    <input type="text" id="createCode" name="code" required>
                    <label for="createName">Anarana:</label>
                    <input type="text" id="createName" name="name" required>
                    <button type="submit" class="confirm-btn">hampidirina</button>
                </form>
            </div>
        </div>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Fanovana Faritra</h2>
                <form id="editForm" method="POST" action="<?= path("/regions/update") ?>">
                    <input type="hidden" name="id" id="editId">
                    <label for="editCode">Kaody:</label>
                    <input type="text" id="editCode" name="code" required>
                    <label for="editName">Anarana:</label>
                    <input type="text" id="editName" name="name" required>
                    <button type="submit" class="confirm-btn">hovaina</button>
                </form>
            </div>
        </div>


        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Fanenkena Famafana</h2>
                <p>Tena ho fafainao marina ve ny faritra?</p>
                <form id="deleteForm" method="POST" action="<?= path("/regions/delete") ?>">
                    <input type="hidden" name="id" id="deleteId">
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

