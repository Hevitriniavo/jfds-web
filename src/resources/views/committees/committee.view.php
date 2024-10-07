<?= include_component("sidebar") ?>
<div class="content">
    <h1>Committees</h1>

    <button id="openCreateModal" class="btn ">Add Committee</button>

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
        <?php if (empty($committees)): ?>
            <tr>
                <td colspan="4" class="no-data">No committees found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($committees as $committee): ?>
                <tr data-id="<?= $committee['id'] ?>" data-code="<?= $committee['code'] ?>" data-name="<?= $committee['name'] ?>">
                    <td><?= $committee['id'] ?></td>
                    <td><?= $committee['code'] ?></td>
                    <td><?= $committee['name'] ?></td>
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
            <h2>Create Committee</h2>
            <form id="createForm" action="<?= path('committees/create') ?>" method="POST">
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
            <h2>Update Committee</h2>
            <form id="updateForm" action="<?= path('committees/update') ?>" method="POST">
                <input type="hidden" id="updateId" name="id">

                <label for="updateCode">Code</label>
                <input type="text" name="code" id="updateCode" placeholder="Code" required>

                <label for="updateName">Name</label>
                <input type="text" name="name" id="updateName" placeholder="Name" required>

                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span id="closeDeleteModal" class="close">&times;</span>
            <h2>Delete Committee</h2>
            <p>Are you sure you want to delete this committee?</p>
            <form id="deleteForm" action="<?= path('committees/delete') ?>" method="POST">
                <input type="hidden" id="deleteId" name="id">
                <button type="submit" class="btn">Delete</button>
            </form>
        </div>
    </div>
</div>
