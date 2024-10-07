document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('openCreateModal').addEventListener('click', function () {
        document.getElementById('createModal').style.display = 'block';
    });

    document.querySelectorAll('.close').forEach(function (element) {
        element.addEventListener('click', function () {
            this.closest('.modal').style.display = 'none';
        });
    });

    document.querySelectorAll('.editButton').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            document.getElementById('updateId').value = row.getAttribute('data-id');
            document.getElementById('updateReason').value = row.getAttribute('data-reason');
            document.getElementById('updateType').value = row.getAttribute('data-type');
            document.getElementById('updateAmount').value = row.getAttribute('data-amount');
            document.getElementById('updateDate').value = row.getAttribute('data-date');
            document.getElementById('updateModal').style.display = 'block';
        });
    });

    document.querySelectorAll('.deleteButton').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            document.getElementById('deleteId').value = row.getAttribute('data-id');
            document.getElementById('deleteModal').style.display = 'block';
        });
    });
});
