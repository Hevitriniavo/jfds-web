<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>


        <div class="container mx-auto mt-4">
                <h1>Hetsika</h1>

                <button id="openCreateModal" class="btn">Hamorona Hetsika</button>

                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Anarana</th>
                        <th>Description</th>
                        <th>Daty fanombohana</th>
                        <th>Daty farany</th>
                        <th>Toerana</th>
                        <th>Hetsika</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($events)): ?>
                        <tr>
                            <td colspan="7" class="no-data">Tsy misy hetsika.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($events as $event): ?>
                            <tr data-id="<?= $event['id'] ?>"
                                data-name="<?= $event['name'] ?>"
                                data-description="<?= $event['description'] ?>"
                                data-start_date="<?= $event['start_date'] ?>"
                                data-end_date="<?= $event['end_date'] ?>"
                                data-location="<?= $event['location'] ?>">
                                <td><?= $event['id'] ?></td>
                                <td><?= $event['name'] ?></td>
                                <td><?= $event['description'] ?></td>
                                <td><?= $event['start_date'] ?></td>
                                <td><?= $event['end_date'] ?></td>
                                <td><?= $event['location'] ?></td>
                                <td>
                                    <button class="editButton btn">Manova</button>
                                    <button class="deleteButton btn">Mamafa</button>
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
                        <h2>Famoronana hetsika</h2>
                        <form id="createForm" action="<?= path('events/create') ?>" method="POST">
                            <label for="name">Anarana</label>
                            <input type="text" id="name" name="name" placeholder="Anarana ny hetsika " required>

                            <label for="description">Description</label>
                            <textarea id="description" name="description" placeholder="Description ny hetsika" required></textarea>

                            <label for="start_date">Daty fanombohana</label>
                            <input type="datetime-local" id="start_date" name="start_date" required>

                            <label for="end_date">Daty fiafarany</label>
                            <input type="datetime-local" id="end_date" name="end_date" required>

                            <label for="location">Toerana</label>
                            <input type="text" id="location" name="location" placeholder="Toerana ny hetsika">

                            <button type="submit" class="btn">Hoforonina</button>
                        </form>
                    </div>
                </div>

                <!-- Update Modal -->
                <div id="updateModal" class="modal">
                    <div class="modal-content">
                        <span id="closeUpdateModal" class="close">&times;</span>
                        <h2>Fanovana Hetsika</h2>
                        <form id="updateForm" action="<?= path('events/update') ?>" method="POST">
                            <input type="hidden" id="updateId" name="id">

                            <label for="updateName">Anarana</label>
                            <input type="text" name="name" id="updateName" placeholder="Anarana ny hetsika" required>

                            <label for="updateDescription">Description</label>
                            <textarea name="description" id="updateDescription" placeholder="Description ny hetsika" required></textarea>

                            <label for="updateStartDate">Daty Fanombohana</label>
                            <input type="datetime-local" name="start_date" id="updateStartDate" required>

                            <label for="updateEndDate">Daty fiafarany</label>
                            <input type="datetime-local" name="end_date" id="updateEndDate" required>

                            <label for="updateLocation">Toerana</label>
                            <input type="text" name="location" id="updateLocation" placeholder="Toerana ny hetsika">

                            <button type="submit" class="btn">Hovaina</button>
                        </form>
                    </div>
                </div>

                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <span  class="close closeDeleteModal">&times;</span>
                        <h2>Fanenkena Famafana</h2>
                        <p>Tena ho fafainao marina ve ny hetsika ?</p>
                        <form id="deleteForm" action="<?= path('events/delete') ?>" method="POST">
                            <input type="hidden" id="deleteId" name="id">
                            <div class="cancel-btn-group-delete">
                                <button type="button" class="cancel-btn btn delete-btn closeDeleteModal">Tsia</button>
                                <button type="submit" class="confirm-btn btn">Eny</button>
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

