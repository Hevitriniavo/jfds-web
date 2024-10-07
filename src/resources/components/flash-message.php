<?php
$flashMessage = getFlashMessage();
$type = isset($flashMessage['type']) ? htmlspecialchars($flashMessage['type']) : '';
$message = isset($flashMessage['message']) ? htmlspecialchars($flashMessage['message']) : '';
?>

<?php if ($type && $message): ?>
    <div id="toast" class="toast-container">
        <div class="toast <?= $type ?> show" role="alert">
            <p><?= $message ?></p>
        </div>
    </div>
<?php endif; ?>
