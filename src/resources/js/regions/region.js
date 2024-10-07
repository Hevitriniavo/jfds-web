document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.regions-table').addEventListener('click', function (e) {
            if (e.target.classList.contains('action-btn')) {
                const button = e.target;
                const row = button.closest('.table-row');

                if (!row) {
                    console.error("Row not found");
                    return;
                }

                const id = row.dataset.id;
                const code = row.dataset.code;
                const name = row.dataset.name;
                const action = button.dataset.action;

                console.log("Action:", action, "ID:", id, "Code:", code, "Name:", name);

                if (action === 'edit') {
                    editRegion(id, code, name);
                } else if (action === 'delete') {
                    deleteRegion(id);
                }
            }
        });

    function editRegion(id, code, name) {
        document.getElementById('editId').value = id;
        document.getElementById('editCode').value = code;
        document.getElementById('editName').value = name;
        document.getElementById('editModal').style.display = 'block';
    }

    function deleteRegion(id) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteModal').style.display = 'block';
    }

    document.querySelectorAll('.close-btn').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('.modal').style.display = 'none';
        });
    });

    document.querySelector('.cancel-btn').addEventListener('click', function () {
        document.getElementById('deleteModal').style.display = 'none';
    });

    document.getElementById('createBtn').addEventListener('click', function () {
        document.getElementById('createModal').style.display = 'block';
    });
});
