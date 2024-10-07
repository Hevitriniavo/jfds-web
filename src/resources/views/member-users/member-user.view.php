<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <h1 class="title">Member-User Relationships</h1>
        <button id="attachBtn" class="action-btn">Attach User to Member</button>

        <table class="responsibilities-table">
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
                        <button class="action-btn detach-btn" data-action="detach">Detach</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Attach Modal -->
<div id="attachModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Attach User to Member</h2>
        <form id="attachForm" method="POST" action="<?= path("/member_users/attach") ?>">
            <label for="attachMemberId">Member:</label>
            <select id="attachMemberId" name="member_id" required>
                <?php foreach ($members as $member): ?>
                    <option value="<?= $member['id'] ?>"><?= $member['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="attachUserId">User:</label>
            <select id="attachUserId" name="user_id" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= $user['last_name'] . ' ' . $user['first_name'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="confirm-btn">Attach</button>
        </form>
    </div>
</div>

<!-- Detach Modal -->
<div id="detachModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Detach User from Member</h2>
        <p>Are you sure you want to detach this user from the member?</p>
        <form id="detachForm" method="POST" action="<?= path("/member_users/detach") ?>">
            <input type="hidden" name="member_id" id="detachMemberId">
            <input type="hidden" name="user_id" id="detachUserId">
            <button type="submit" class="confirm-btn">Yes, Detach</button>
            <button type="button" class="cancel-btn">Cancel</button>
        </form>
    </div>
</div>
