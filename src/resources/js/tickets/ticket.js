document.addEventListener('DOMContentLoaded', function() {
    const createBtn = document.getElementById('createBtn');
    const createModal = document.getElementById('createModal');
    const closeBtns = document.querySelectorAll('.close-btn');

    // Open Create Ticket Modal
    createBtn.addEventListener('click', function() {
        createModal.style.display = 'block';
    });

    // Close Modals
    closeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.modal').style.display = 'none';
        });
    });

    // Handle Edit Button Click
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('.table-row');
            document.getElementById('update_ticket_id').value = row.dataset.id;
            document.getElementById('update_user_id').value = row.dataset.userId;
            document.getElementById('update_event_id').value = row.dataset.eventId;
            document.getElementById('update_from').value = row.dataset.from;
            document.getElementById('update_to').value = row.dataset.to;
            document.getElementById('update_is_paid').checked = row.dataset.paid === '1';
            document.getElementById('update_distribution').value = row.dataset.distribution;

            document.getElementById('updateModal').style.display = 'block';
        });
    });

    // Handle Delete Button Click
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('.table-row');
            document.getElementById('delete_id').value = row.dataset.id;
            document.getElementById('deleteModal').style.display = 'block';
        });
    });
});