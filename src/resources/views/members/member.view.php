<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <h1 class="title">Members</h1>
        <button id="createBtn" class="action-btn">Create Member</button>

        <table class="members-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Region</th>
                <th>Name</th>
                <th>Association</th>
                <th>Committee</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($members as $member): ?>
                <tr class="table-row" data-id="<?= $member['id'] ?>" data-region="<?= $member['region_id'] ?>" data-name="<?= $member['name'] ?>" data-association="<?= $member['association_id'] ?>" data-committee="<?= $member['committee_id'] ?>">
                    <td><?= $member['id'] ?></td>
                    <td><?= $member['region_name'] ?? 'N/A' ?></td>
                    <td><?= $member['name'] ?? 'N/A' ?></td>
                    <td><?= $member['association_name'] ?? 'N/A' ?></td>
                    <td><?= $member['committee_name'] ?? 'N/A' ?></td>
                    <td>
                        <button class="action-btn edit-btn" data-action="edit">Edit</button>
                        <button class="action-btn delete-btn" data-action="delete">Delete</button>
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
        <h2>Create Member</h2>
        <form id="createForm" method="POST" action="<?= path("/members/create") ?>">
            <label for="createName">Name:</label>
            <input type="text" name="name" id="createName">

            <label for="createRegion">Region:</label>
            <select id="createRegion" name="region_id" required>
                <?php foreach ($regions as $region): ?>
                    <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="createAssociation">Association:</label>
            <select id="createAssociation" name="association_id" required>
                <?php foreach ($associations as $association): ?>
                    <option value="<?= $association['id'] ?>"><?= $association['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="createCommittee">Committee:</label>
            <select id="createCommittee" name="committee_id" required>
                <?php foreach ($committees as $committee): ?>
                    <option value="<?= $committee['id'] ?>"><?= $committee['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="confirm-btn">Create</button>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit Member</h2>
        <form id="editForm" method="POST" action="<?= path("/members/update") ?>">
            <input type="hidden" name="id" id="editId">

            <label for="editName">Name:</label>
            <input type="text" name="name" id="editName">

            <label for="editRegion">Region:</label>
            <select id="editRegion" name="region_id" required>
                <?php foreach ($regions as $region): ?>
                    <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="editAssociation">Association:</label>
            <select id="editAssociation" name="association_id" required>
                <?php foreach ($associations as $association): ?>
                    <option value="<?= $association['id'] ?>"><?= $association['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="editCommittee">Committee:</label>
            <select id="editCommittee" name="committee_id" required>
                <?php foreach ($committees as $committee): ?>
                    <option value="<?= $committee['id'] ?>"><?= $committee['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="confirm-btn">Save Changes</button>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this member?</p>
        <form id="deleteForm" method="POST" action="<?= path("/members/delete") ?>">
            <input type="hidden" name="id" id="deleteId">
            <button type="submit" class="confirm-btn">Yes, Delete</button>
            <button type="button" class="cancel-btn">Cancel</button>
        </form>
    </div>
</div>
