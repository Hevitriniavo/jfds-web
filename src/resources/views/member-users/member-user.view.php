<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>


        <div class="container mx-auto mt-4">
                    <h1 class="title">Member-User Relationships</h1>
                    <button class="btn btn-sm btn-success mb-3 edit-btn d-inline" data-bs-toggle="modal"
                            data-bs-target="#attachModal">Attach User to Member</button>

                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>User Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($memberUsers as $relation): ?>
                            <tr class="table-row" data-member-id="<?= $relation['member_id'] ?>" data-user-id="<?= $relation['user_id'] ?>">
                                <td><?= $relation['member_name'] ?></td>
                                <td><?= $relation['user_name'] ?></td>
                                <td>
                                    <button class="btn btn-sm detach-btn btn-danger mb-3 edit-btn d-inline ">Detach</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>


            <div class="modal fade" id="attachModal" tabindex="-1" aria-labelledby="attachModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="attachModalLabel">Attach User to Member</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form id="attachForm" method="POST" action="<?= path("/member_users/attach") ?>">
                                <div class="row ">
                                    <label for="attachMemberId" class="form-label">Member:</label>
                                    <select id="attachMemberId" class="form-control" name="member_id" required>
                                        <?php foreach ($members as $member): ?>
                                            <option value="<?= $member['id'] ?>"><?= $member['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row ">
                                    <label for="attachUserId" class="form-label">User:</label>
                                    <select id="attachUserId" class="form-control"  name="user_id" required>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= $user['id'] ?>"><?= $user['last_name'] . ' ' . $user['first_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success w-100">Attach</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="detachModal"
                 >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Detach User from Member</h2>
                            <button type="button" class="btn-close close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <p>Are you sure you want to detach this user from the member?</p>
                        <form id="detachForm" method="POST" action="<?= path("/member_users/detach") ?>">
                            <input type="hidden" name="member_id" id="detachMemberId">
                            <input type="hidden" name="user_id" id="detachUserId">
                            <button type="submit" class="confirm-btn">Yes, Detach</button>
                            <button type="button" class="cancel-btn">Cancel</button>
                        </form>

                        </div>
                    </div>
                </div>
            </div>




        </div>


        <footer>
            <p>&copy; <?= date("Y") ?> My Application. All rights reserved.</p>
        </footer>

    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

