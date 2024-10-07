document.addEventListener('DOMContentLoaded', function () {
    const attachBtn = document.getElementById('attachBtn');
    const attachModal = document.getElementById('attachModal');
    const detachModal = document.getElementById('detachModal');
    const closeModalButtons = document.querySelectorAll('.close-btn');

    // Open Attach Modal
    attachBtn.addEventListener('click', function () {
        attachModal.style.display = 'flex';
    });

    // Close modals
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function () {
            attachModal.style.display = 'none';
            detachModal.style.display = 'none';
        });
    });

    document.querySelectorAll('.detach-btn').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('.table-row');
            const userId = row.getAttribute('data-user-id');
            const sacramentId = row.getAttribute('data-sacrament-id');
            if (userId && sacramentId) {
                document.getElementById('detachUserId').value = userId;
                document.getElementById('detachSacramentId').value = sacramentId;
                detachModal.style.display = 'flex';
            }
        });
    });

    const cancelButton = detachModal.querySelector('.cancel-btn');
    cancelButton.addEventListener('click', function () {
        detachModal.style.display = 'none';
    });

    window.addEventListener('click', function (e) {
        if (e.target === attachModal || e.target === detachModal) {
            attachModal.style.display = 'none';
            detachModal.style.display = 'none';
        }
    });
});
