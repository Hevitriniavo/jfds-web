<?= include_component("sidebar") ?>
<div class="content">
    <h1>Associations</h1>

    <button id="openCreateModal" class="btn">Add Association</button>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($associations)): ?>
            <tr>
                <td colspan="4" class="no-data">No associations found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($associations as $association): ?>
                <tr data-id="<?= $association['id'] ?>" data-code="<?= $association['code'] ?>" data-name="<?= $association['name'] ?>">
                    <td><?= $association['id'] ?></td>
                    <td><?= $association['code'] ?></td>
                    <td><?= $association['name'] ?></td>
                    <td>
                        <button class="editButton btn">Edit</button>
                        <button class="deleteButton btn">Delete</button>
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
            <h2>Create Association</h2>
            <form id="createForm" action="<?= path('associations/create') ?>" method="POST">
                <label for="code">Code</label>
                <input type="text" id="code" name="code" placeholder="Code" required>

                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Name" required>

                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span id="closeUpdateModal" class="close">&times;</span>
            <h2>Update Association</h2>
            <form id="updateForm" action="<?= path('associations/update') ?>" method="POST">
                <input type="hidden" id="updateId" name="id">

                <label for="updateCode">Code</label>
                <input type="text" name="code" id="updateCode" placeholder="Code" required>

                <label for="updateName">Name</label>
                <input type="text" name="name" id="updateName" placeholder="Name" required>

                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span id="closeDeleteModal" class="close">&times;</span>
            <h2>Delete Association</h2>
            <p>Are you sure you want to delete this association?</p>
            <form id="deleteForm" action="<?= path('associations/delete') ?>" method="POST">
                <input type="hidden" id="deleteId" name="id">
                <div class="cancel-btn-group-delete">
                    <button type="submit" class="confirm-btn">Yes, Delete</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
