<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <h1 class="title">Sacrament</h1>
        <button id="createBtn" class="action-btn btn">Create Sacrament</button>

        <table class="responsibilities-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sacraments as $sacrament): ?>
                <tr class="table-row" data-id="<?= $sacrament['id'] ?>" data-name="<?= $sacrament['name'] ?>">
                    <td><?= $sacrament['id'] ?></td>
                    <td><?= $sacrament['name'] ?></td>
                    <td>
                        <button class="action-btn btn edit-btn" data-action="edit">Edit</button>
                        <button class="action-btn btn delete-btn" data-action="delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Create Sacrament</h2>
        <form id="createForm" method="POST" action="<?= path("/sacraments/create") ?>">
            <label for="createName">Name:</label>
            <input type="text" id="createName" name="name" required>
            <button type="submit" class="confirm-btn">Create</button>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit Sacrament</h2>
        <form id="editForm" method="POST" action="<?= path("/sacraments/update") ?>">
            <input type="hidden" name="id" id="editId">
            <label for="editName">Name:</label>
            <input type="text" id="editName" name="name" required>
            <button type="submit" class="confirm-btn">Save Changes</button>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this sacrament?</p>
        <form id="deleteForm" method="POST" action="<?= path("/sacraments/delete") ?>">
            <input type="hidden" name="id" id="deleteId">
            <div class="cancel-btn-group-delete">
                <button type="submit" class="confirm-btn btn">Yes, Delete</button>
                <button type="button" class="cancel-btn btn delete-btn">Cancel</button>
            </div>
        </form>
    </div>
</div>

