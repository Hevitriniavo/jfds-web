document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('createBtn').addEventListener('click', function () {
        document.getElementById('createModal').style.display = 'block';
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('.table-row');
            document.getElementById('editId').value = row.dataset.id;
            document.getElementById('editName').value = row.dataset.name;
            document.getElementById('editModal').style.display = 'block';
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('.table-row');
            document.getElementById('deleteId').value = row.dataset.id;
            document.getElementById('deleteModal').style.display = 'block';
        });
    });

    document.querySelectorAll('.close-btn, .cancel-btn').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('.modal').style.display = 'none';
        });
    });
});


