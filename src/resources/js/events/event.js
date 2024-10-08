document.addEventListener('DOMContentLoaded', function () {
    const openCreateModalBtn = document.getElementById('openCreateModal');
    const createModal = document.getElementById('createModal');
    const closeCreateModal = document.getElementById('closeCreateModal');

    openCreateModalBtn.addEventListener('click', () => createModal.style.display = 'block');
    closeCreateModal.addEventListener('click', () => createModal.style.display = 'none');

    const updateModal = document.getElementById('updateModal');
    const closeUpdateModal = document.getElementById('closeUpdateModal');
    const updateForm = document.getElementById('updateForm');

    document.querySelectorAll('.editButton').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            updateForm.querySelector('#updateId').value = row.dataset.id;
            updateForm.querySelector('#updateName').value = row.dataset.name;
            updateForm.querySelector('#updateDescription').value = row.dataset.description;
            updateForm.querySelector('#updateStartDate').value = row.dataset.start_date;
            updateForm.querySelector('#updateEndDate').value = row.dataset.end_date;
            updateForm.querySelector('#updateLocation').value = row.dataset.location;

            updateModal.style.display = 'block';
        });
    });

    closeUpdateModal.addEventListener('click', () => updateModal.style.display = 'none');

    const deleteModal = document.getElementById('deleteModal');
    const closeDeleteModal = document.querySelectorAll('.closeDeleteModal');
    const deleteForm = document.getElementById('deleteForm');

    document.querySelectorAll('.deleteButton').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            deleteForm.querySelector('#deleteId').value = row.dataset.id;
            deleteModal.style.display = 'block';
        });
    });

    closeDeleteModal.forEach((cls) => {
        cls.addEventListener('click', () => deleteModal.style.display = 'none');
    });
});
