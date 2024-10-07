<?= include_component("sidebar") ?>
<main class="content">
    <section class="container">
        <h1 class="page-title">Team</h1>
        <div class="card-container">
            <?php foreach ($users as $user): ?>
                <div class="card" data-id="<?= htmlspecialchars($user['user_id'])?>">
                    <h2 class="card-name"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></h2>
                    <img src="<?= "/assets/" . path($user['photo']) ?>" alt="<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>" class="card-img">
                    <div class="card-content">
                        <p class="card-role"><?= htmlspecialchars($user['role_name']) ?></p>
                        <p class="card-member"><?= htmlspecialchars($user['member_name'] ?? 'N/A') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="activity-section">
        <h1 class="activities-title">Activities</h1>
        <div class="activities-container">
            <?php foreach ($activities as $activity): ?>
                <div class="activity-card">
                    <h2 class="activity-name"><?= htmlspecialchars($activity['name']) ?></h2>
                    <p class="activity-description"><?= htmlspecialchars($activity['description']) ?></p>
                    <p class="activity-date">Date: <?= htmlspecialchars($activity['start_date']) ?></p>
                    <p class="activity-location">Location: <?= htmlspecialchars($activity['location']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="events-section">
        <h1 class="events-title">Events</h1>
        <div class="events-container">
            <?php foreach ($events as $event): ?>
                <div class="event-card">
                    <h2 class="event-name"><?= htmlspecialchars($event['name']) ?></h2>
                    <p class="event-description"><?= htmlspecialchars($event['description']) ?></p>
                    <p class="event-dates">From: <?= htmlspecialchars($event['start_date']) ?> To: <?= htmlspecialchars($event['end_date']) ?></p>
                    <p class="event-location">Location: <?= htmlspecialchars($event['location']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="history-section">
        <h1 class="history-title">Attendance History</h1>
        <div class="history-container">
            <?php foreach ($histories as $history): ?>
                <div class="history-card">
                    <h2 class="history-activity-name"><?= htmlspecialchars($history['activity_name']) ?></h2>
                    <p class="history-user-name"><?= htmlspecialchars($history['first_name'] . ' ' . $history['last_name']) ?></p>
                    <p class="history-presence-status <?= $history['is_present'] ? 'present' : 'absent' ?>">
                        <?= htmlspecialchars($history['is_present'] ? 'Present' : 'Absent') ?>
                    </p>
                    <p class="history-date">Date: <?= htmlspecialchars($history['created_at']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 id="modalUserName"></h2>
            <img id="modalUserPhoto" alt="User Photo" class="modal-user-img" src="">
            <p><strong>Role:</strong> <span id="modalUserRole"></span></p>
            <p><strong>Address:</strong> <span id="modalUserAddress"></span></p>
            <p><strong>Username:</strong> <span id="modalUsername"></span></p>
            <p><strong>Gender:</strong> <span id="modalUserGender"></span></p>
            <p><strong>Birth Date:</strong> <span id="modalUserBirthDate"></span></p>
            <p><strong>CIN:</strong> <span id="modalUserCIN"></span></p>
            <p><strong>QR Code:</strong> <span id="modalUserQRCode"></span></p>
            <p><strong>Created At:</strong> <span id="modalUserCreatedAt"></span></p>
            <p><strong>Updated At:</strong> <span id="modalUserUpdatedAt"></span></p>
        </div>
    </div>

    <footer>
        <p>&copy; <?= date("Y") ?> My Application. All rights reserved.</p>
    </footer>

</main>
