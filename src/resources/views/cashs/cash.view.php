<?= include_component("sidebar") ?>
<div class="content">
    <h1>Cash Registers</h1>

    <!-- Bouton pour ouvrir le modal de création -->
    <button id="openCreateModal" class="btn">Add Cash Register</button>

    <!-- Table des cash registers -->
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Reason</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($cashRegisters)): ?>
            <tr>
                <td colspan="6" class="no-data">No cash registers found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($cashRegisters as $cashRegister): ?>
                <tr data-id="<?= $cashRegister['id'] ?>"
                    data-reason="<?= htmlspecialchars($cashRegister['reason']) ?>"
                    data-type="<?= htmlspecialchars($cashRegister['type']) ?>"
                    data-amount="<?= $cashRegister['amount'] ?>"
                    data-date="<?= $cashRegister['date'] ?>">
                    <td><?= $cashRegister['id'] ?></td>
                    <td><?= htmlspecialchars($cashRegister['reason']) ?></td>
                    <td><?= htmlspecialchars($cashRegister['type']) ?></td>
                    <td><?= number_format($cashRegister['amount'], 2) ?></td>
                    <td><?= $cashRegister['date'] ?></td>
                    <td>
                        <button class="editButton btn">Edit</button>
                        <button class="deleteButton btn">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Modal de création -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span id="closeCreateModal" class="close">&times;</span>
            <h2>Create Cash Register</h2>
            <form id="createForm" action="<?= path('cash-registers/create') ?>" method="POST">
                <label for="reason">Reason</label>
                <input type="text" id="reason" name="reason" placeholder="Reason" required>

                <label for="type">Type</label>

                <select name="type" id="type">
                    <option selected disabled>selected to type</option>
                    <option value="entréé">Entrée</option>
                    <option value="sortie">Sortie</option>
                </select>

                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" placeholder="Amount" required step="0.01">

                <label for="date">Date</label>
                <input type="date" id="date" name="date" placeholder="Date" required>

                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>

    <!-- Modal de mise à jour -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span id="closeUpdateModal" class="close">&times;</span>
            <h2>Update Cash Register</h2>
            <form id="updateForm" action="<?= path('cash-registers/update') ?>" method="POST">
                <input type="hidden" id="updateId" name="id">

                <label for="updateReason">Reason</label>
                <input type="text" name="reason" id="updateReason" placeholder="Reason" required>
                
                <label for="updateType">Type</label>
                <select name="type" id="updateType">
                    <option selected disabled>selected to type</option>
                    <option value="entréé">Entrée</option>
                    <option value="sortie">Sortie</option>
                </select>

                <label for="updateAmount">Amount</label>
                <input type="number" name="amount" id="updateAmount" placeholder="Amount" required step="0.01">

                <label for="updateDate">Date</label>
                <input type="date" name="date" id="updateDate" placeholder="Date" required>

                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>

    <!-- Modal de suppression -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span id="closeDeleteModal" class="close">&times;</span>
            <h2>Delete Cash Register</h2>
            <p>Are you sure you want to delete this cash register?</p>
            <form id="deleteForm" action="<?= path('cash-registers/delete') ?>" method="POST">
                <input type="hidden" id="deleteId" name="id">
                <button type="submit" class="btn">Delete</button>
            </form>
        </div>
    </div>
</div>

