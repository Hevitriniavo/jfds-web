document.addEventListener('DOMContentLoaded', function() {
    const createModal = document.getElementById('createModal');
    const updateModal = document.getElementById('updateModal');
    const deleteModal = document.getElementById('deleteModal');

    const openCreateModal = document.getElementById('openCreateModal');
    const closeCreateModal = document.getElementById('closeCreateModal');
    const closeUpdateModal = document.getElementById('closeUpdateModal');
    const closeDeleteModal = document.getElementById('closeDeleteModal');

    const editButtons = document.querySelectorAll('.editButton');
    const deleteButtons = document.querySelectorAll('.deleteButton');

    openCreateModal.onclick = function() {
        createModal.style.display = 'block';
    };

    closeCreateModal.onclick = function() {
        createModal.style.display = 'none';
    };

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            document.getElementById('updateId').value = row.getAttribute('data-id');
            document.getElementById('updateName').value = row.getAttribute('data-name');
            document.getElementById('updateDescription').value = row.getAttribute('data-description');
            document.getElementById('updateTicketCount').value = row.getAttribute('data-ticket-count');
            document.getElementById('updateOperationDate').value = row.getAttribute('data-operation-date');
            document.getElementById('updateTicketPrice').value = row.getAttribute('data-ticket-price');
            updateModal.style.display = 'block';
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            document.getElementById('deleteId').value = row.getAttribute('data-id');
            deleteModal.style.display = 'block';
        });
    });

    closeUpdateModal.onclick = function() {
        updateModal.style.display = 'none';
    };

    closeDeleteModal.onclick = function() {
        deleteModal.style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target === createModal) {
            createModal.style.display = 'none';
        }
        if (event.target === updateModal) {
            updateModal.style.display = 'none';
        }
        if (event.target === deleteModal) {
            deleteModal.style.display = 'none';
        }
    };
});
