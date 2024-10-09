<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>

        <div class="container mx-auto mt-4">
            <h1 class="title">Mpikambana</h1>
            <button id="createBtn" class="btn btn-primary mb-3">Mamorona Mpikambana</button>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Faritra</th>
                    <th>Anarana</th>
                    <th>Fikambanana</th>
                    <th>Vaomiera</th>
                    <th>Asa</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($members as $member): ?>
                    <tr class="table-row" data-id="<?= $member['id'] ?>" data-region="<?= $member['region_id'] ?>"
                        data-name="<?= $member['name'] ?>" data-association="<?= $member['association_id'] ?>"
                        data-committee="<?= $member['committee_id'] ?>">
                        <td><?= $member['id'] ?></td>
                        <td><?= $member['region_name'] ?? 'N/A' ?></td>
                        <td><?= $member['name'] ?? 'N/A' ?></td>
                        <td><?= $member['association_name'] ?? 'N/A' ?></td>
                        <td><?= $member['committee_name'] ?? 'N/A' ?></td>
                        <td>
                            <button class="btn btn-warning edit-btn" data-action="edit">Hanova</button>
                            <button class="btn btn-danger delete-btn" data-action="delete">Hamafa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div id="createModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Mamorona Mpikambana</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createForm" method="POST" action="<?= path("/members/create") ?>">
                                <div class="mb-3">
                                    <label for="createName" class="form-label">Anarana:</label>
                                    <input type="text" name="name" id="createName" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="createRegion" class="form-label">Faritra:</label>
                                    <select id="createRegion" name="region_id" class="form-select" required>
                                        <option value="" disabled selected>Safidio ny Faritra</option>
                                        <?php foreach ($regions as $region): ?>
                                            <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="createAssociation" class="form-label">Fikambanana:</label>
                                    <select id="createAssociation" name="association_id" class="form-select" required>
                                        <option value="" disabled selected>Safidio ny Fikambanana</option>
                                        <?php foreach ($associations as $association): ?>
                                            <option value="<?= $association['id'] ?>"><?= $association['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="createCommittee" class="form-label">Vaomiera:</label>
                                    <select id="createCommittee" name="committee_id" class="form-select" required>
                                        <option value="" disabled selected>Safidio ny Vaomiera</option>
                                        <?php foreach ($committees as $committee): ?>
                                            <option value="<?= $committee['id'] ?>"><?= $committee['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Mamorona</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div id="editModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hanova Mpikambana</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm" method="POST" action="<?= path("/members/update") ?>">
                                <input type="hidden" name="id" id="editId">
                                <div class="mb-3">
                                    <label for="editName" class="form-label">Anarana:</label>
                                    <input type="text" name="name" id="editName" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editRegion" class="form-label">Faritra:</label>
                                    <select id="editRegion" name="region_id" class="form-select" required>
                                        <option value="" disabled selected>Safidio ny Faritra</option>
                                        <?php foreach ($regions as $region): ?>
                                            <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editAssociation" class="form-label">Fikambanana:</label>
                                    <select id="editAssociation" name="association_id" class="form-select" required>
                                        <option value="" disabled selected>Safidio ny Fikambanana</option>
                                        <?php foreach ($associations as $association): ?>
                                            <option value="<?= $association['id'] ?>"><?= $association['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editCommittee" class="form-label">Vaomiera:</label>
                                    <select id="editCommittee" name="committee_id" class="form-select" required>
                                        <option value="" disabled selected>Safidio ny Vaomiera</option>
                                        <?php foreach ($committees as $committee): ?>
                                            <option value="<?= $committee['id'] ?>"><?= $committee['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Tehirizo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div id="deleteModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hamafa Mpikambana</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Hafahako ity mpikambana ity ve ianao?</p>
                            <form id="deleteForm" method="POST" action="<?= path("/members/delete") ?>">
                                <input type="hidden" name="id" id="deleteId">
                                <button type="submit" class="btn btn-danger">Eny</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tsia</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="mt-4">
            <p>&copy; <?= date("Y") ?> My Application. Zo rehetra voatokana.</p>
        </footer>

    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
