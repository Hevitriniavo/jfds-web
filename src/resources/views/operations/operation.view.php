<?= include_component("sidebar") ?>
<div class="content">
    <h1>Operations</h1>

    <button id="openCreateModal" class="btn">Add Operation</button>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Ticket Count</th>
            <th>Operation Date</th>
            <th>Ticket Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($operations)): ?>
            <tr>
                <td colspan="6" class="no-data">No operations found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($operations as $operation): ?>
                <tr data-id="<?= $operation['id'] ?>" data-name="<?= $operation['name'] ?>" data-ticket-count="<?= $operation['ticket_count'] ?>" data-description="<?= $operation['description'] ?>" data-operation-date="<?= $operation['operation_date'] ?>" data-ticket-price="<?= $operation['ticket_price'] ?>">
                    <td><?= $operation['id'] ?></td>
                    <td><?= $operation['name'] ?></td>
                    <td><?= $operation['ticket_count'] ?></td>
                    <td><?= $operation['operation_date'] ?></td>
                    <td><?= $operation['ticket_price'] ?></td>
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
            <h2>Create Operation</h2>
            <form id="createForm" action="<?= path('operations/create') ?>" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Name" required>

                <label for="ticket_count">Ticket Count</label>
                <input type="number" id="ticket_count" name="ticket_count" placeholder="Ticket Count" required>

                <label for="operation_date">Operation Date</label>
                <input type="date" id="operation_date" name="operation_date" required>

                <label for="ticket_price">Ticket Price</label>
                <input type="number" step="0.01" id="ticket_price" name="ticket_price" placeholder="Ticket Price" required>

                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>

                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span id="closeUpdateModal" class="close">&times;</span>
            <h2>Update Operation</h2>
            <form id="updateForm" action="<?= path('operations/update') ?>" method="POST">
                <input type="hidden" id="updateId" name="id">

                <label for="updateName">Name</label>
                <input type="text" id="updateName" name="name" required>

                <label for="updateTicketCount">Ticket Count</label>
                <input type="number" id="updateTicketCount" name="ticket_count" required>

                <label for="updateOperationDate">Operation Date</label>
                <input type="date" id="updateOperationDate" name="operation_date" required>

                <label for="updateTicketPrice">Ticket Price</label>
                <input type="number" step="0.01" id="updateTicketPrice" name="ticket_price" required>

                <label for="updateDescription">Description</label>
                <textarea name="description" id="updateDescription"></textarea>
                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span id="closeDeleteModal" class="close">&times;</span>
            <h2>Delete Operation</h2>
            <p>Are you sure you want to delete this operation?</p>
            <form id="deleteForm" action="<?= path('operations/delete') ?>" method="POST">
                <input type="hidden" id="deleteId" name="id">
                <button type="submit" class="btn">Delete</button>
            </form>
        </div>
    </div>
</div>
