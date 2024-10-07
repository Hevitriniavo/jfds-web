document.addEventListener('DOMContentLoaded', () => {
    const deleteModal = document.getElementById('deleteModal');
    const deleteIdInput = document.getElementById('deleteId');
    const deletePhotoInput = document.getElementById('deletePhoto');
    const closeModalBtn = document.querySelector('.close-btn');
    const cancelBtn = document.querySelector('.cancel-btn');

    // Open delete modal
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', (event) => {
            deleteIdInput.value = event.target.closest('.table-row').getAttribute('data-id');
            deletePhotoInput.value = event.target.closest('.table-row').getAttribute('data-photo');
            deleteModal.style.display = 'block';
        });
    });

    // Close modal when the close button is clicked
    closeModalBtn.addEventListener('click', () => {
        deleteModal.style.display = 'none';
    });

    // Close modal when the cancel button is clicked
    cancelBtn.addEventListener('click', () => {
        deleteModal.style.display = 'none';
    });

    // Close modal when clicking outside of the modal content
    window.addEventListener('click', (event) => {
        if (event.target === deleteModal) {
            deleteModal.style.display = 'none';
        }
    });
});
