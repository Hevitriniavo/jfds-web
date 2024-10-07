document.addEventListener("DOMContentLoaded", function () {
    const openCreateModal = document.getElementById("openCreateModal");
    const createModal = document.getElementById("createModal");
    const closeCreateModal = document.getElementById("closeCreateModal");

    const updateModal = document.getElementById("updateModal");
    const closeUpdateModal = document.getElementById("closeUpdateModal");

    const deleteModal = document.getElementById("deleteModal");
    const closeDeleteModal = document.getElementById("closeDeleteModal");

    openCreateModal.onclick = function () {
        createModal.style.display = "block";
    };

    closeCreateModal.onclick = function () {
        createModal.style.display = "none";
    };

    document.querySelectorAll(".editButton").forEach(button => {
        button.onclick = function () {
            const row = this.closest("tr");
            document.getElementById("updateId").value = row.dataset.id;
            document.getElementById("updateName").value = row.dataset.name;
            document.getElementById("updateDescription").value = row.dataset.description;
            document.getElementById("updateStartDate").value = row.dataset.startDate;
            document.getElementById("updateDuration").value = row.dataset.duration;
            document.getElementById("updateLocation").value = row.dataset.location;
            document.getElementById("updateOrganizerId").value = row.dataset.organizerId;

            updateModal.style.display = "block";
        };
    });

    closeUpdateModal.onclick = function () {
        updateModal.style.display = "none";
    };

    document.querySelectorAll(".deleteButton").forEach(button => {
        button.onclick = function () {
            const row = this.closest("tr");
            document.getElementById("deleteId").value = row.dataset.id;
            deleteModal.style.display = "block";
        };
    });

    closeDeleteModal.onclick = function () {
        deleteModal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === createModal || event.target === updateModal || event.target === deleteModal) {
            createModal.style.display = "none";
            updateModal.style.display = "none";
            deleteModal.style.display = "none";
        }
    };
});
