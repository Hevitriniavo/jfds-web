document.addEventListener('DOMContentLoaded', function () {
    const createModal = new bootstrap.Modal(document.getElementById('createModal'));
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

    const createBtn = document.getElementById('createBtn');
    createBtn.addEventListener('click', function () {
        createModal.show();
    });

    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            document.getElementById('editId').value = row.dataset.id;
            document.getElementById('editName').value = row.dataset.name;
            document.getElementById('editRegion').value = row.dataset.region;
            document.getElementById('editAssociation').value = row.dataset.association;
            document.getElementById('editCommittee').value = row.dataset.committee;

            editModal.show();
        });
    });

    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            document.getElementById('deleteId').value = row.dataset.id;

            deleteModal.show();
        });
    });
});
