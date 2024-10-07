<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <h1 class="title">User Responsibilities History</h1>
        <table class="responsibilities-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Responsibility ID</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($histories as $history): ?>
                <tr class="table-row">
                    <td><?= htmlspecialchars($history['id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($history['user_id']  ?? '')?></td>
                    <td><?= htmlspecialchars($history['responsibility_id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($history['start_date']  ?? '')  ?></td>
                    <td><?= htmlspecialchars($history['end_date']  ?? '')  ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

