document.addEventListener('DOMContentLoaded', () => {
    const createModal = document.getElementById('createModal');
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    const createBtn = document.getElementById('createBtn');
    const closeBtns = document.querySelectorAll('.close-btn');
    const tableRows = document.querySelectorAll('.table-row');

    createBtn.addEventListener('click', () => {
        createModal.style.display = 'block';
    });

    tableRows.forEach(row => {
        const editBtn = row.querySelector('.edit-btn');
        editBtn.addEventListener('click', () => {
            const id = row.dataset.id;
            const region = row.dataset.region;
            const name = row.dataset.name;
            const association = row.dataset.association;
            const committee = row.dataset.committee;

            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editRegion').value = region;
            document.getElementById('editAssociation').value = association;
            document.getElementById('editCommittee').value = committee;

            editModal.style.display = 'block';
        });
    });

    tableRows.forEach(row => {
        const deleteBtn = row.querySelector('.delete-btn');
        deleteBtn.addEventListener('click', () => {
            const id = row.dataset.id;
            document.getElementById('deleteId').value = id;
            deleteModal.style.display = 'block';
        });
    });

    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            createModal.style.display = 'none';
            editModal.style.display = 'none';
            deleteModal.style.display = 'none';
        });
    });

    window.addEventListener('click', (event) => {
        if (event.target === createModal || event.target === editModal || event.target === deleteModal) {
            createModal.style.display = 'none';
            editModal.style.display = 'none';
            deleteModal.style.display = 'none';
        }
    });
});
