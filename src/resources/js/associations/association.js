document.addEventListener('DOMContentLoaded', () => {
    const modals = {
        create: document.getElementById('createModal'),
        update: document.getElementById('updateModal'),
        delete: document.getElementById('deleteModal')
    };

    document.querySelectorAll('.editButton').forEach(button => {
        button.onclick = function() {
            const row = this.closest('tr');
            document.getElementById('updateId').value = row.dataset.id;
            document.getElementById('updateCode').value = row.dataset.code;
            document.getElementById('updateName').value = row.dataset.name;
            modals.update.style.display = 'block';
        };
    });

    document.getElementById("openCreateModal").onclick = function() {
        document.getElementById("createModal").style.display = "block";
    };

    document.getElementById("closeCreateModal").onclick = function() {
        document.getElementById("createModal").style.display = "none";
    };
    document.querySelectorAll('.deleteButton').forEach(button => {
        button.onclick = function() {
            const row = this.closest('tr');
            document.getElementById('deleteId').value = row.dataset.id;
            modals.delete.style.display = 'block';
        };
    });

    const closeModal = (modal) => {
        modal.style.display = 'none';
    };

    document.getElementById('closeCreateModal').onclick = () => closeModal(modals.create);
    document.getElementById('closeUpdateModal').onclick = () => closeModal(modals.update);
    document.getElementById('closeDeleteModal').onclick = () => closeModal(modals.delete);
    document.querySelector('.cancel-btn').onclick = () => closeModal(modals.delete);
});