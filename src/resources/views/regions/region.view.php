<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <h1 class="title">Regions</h1>
        <button id="createBtn" class="action-btn create-btn">Create Region</button>


            <table class="regions-table">
                <thead>
                <tr>
                    <th class="table-header">ID</th>
                    <th class="table-header">Code</th>
                    <th class="table-header">Name</th>
                    <th class="table-header">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($regions as $region): ?>
                    <tr class="table-row" data-id="<?= $region['id'] ?>" data-code="<?= $region['code'] ?>" data-name="<?= $region['name'] ?>">
                        <td class="table-cell" data-label="ID"><?= $region['id'] ?></td>
                        <td class="table-cell" data-label="Code"><?= $region['code'] ?></td>
                        <td class="table-cell" data-label="Name"><?= $region['name'] ?></td>
                        <td class="table-cell" data-label="Actions">
                            <button class="action-btn edit-btn" data-action="edit">Edit</button>
                            <button class="action-btn delete-btn" data-action="delete">Delete</button>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>

    </div>
</div>

<!-- Modals -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Create Region</h2>
        <form id="createForm" method="POST" action="<?= path("/regions/create") ?>">
            <label for="createCode">Code:</label>
            <input type="text" id="createCode" name="code" required>
            <label for="createName">Name:</label>
            <input type="text" id="createName" name="name" required>
            <button type="submit" class="confirm-btn">Create</button>
        </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit Region</h2>
        <form id="editForm" method="POST" action="<?= path("/regions/update") ?>">
            <input type="hidden" name="id" id="editId">
            <label for="editCode">Code:</label>
            <input type="text" id="editCode" name="code" required>
            <label for="editName">Name:</label>
            <input type="text" id="editName" name="name" required>
            <button type="submit" class="confirm-btn">Save Changes</button>
        </form>
    </div>
</div>



<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this region?</p>
        <form id="deleteForm" method="POST" action="<?= path("/regions/delete") ?>">
            <input type="hidden" name="id" id="deleteId">
            <div class="cancel-btn-group-delete">
                <button type="submit" class="confirm-btn">Yes, Delete</button>
                <button type="button" class="cancel-btn">Cancel</button>
            </div>
        </form>
    </div>
</div>
