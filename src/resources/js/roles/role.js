document.addEventListener("DOMContentLoaded", function () {
    const createBtn = document.getElementById("createBtn");
    const createModal = document.getElementById("createModal");
    const updateModal = document.getElementById("updateModal");
    const deleteModal = document.getElementById("deleteModal");

    createBtn.addEventListener("click", () => createModal.style.display = "block");

    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const row = this.closest(".table-row");
            document.getElementById("update_role_id").value = row.dataset.id;
            document.getElementById("update_name").value = row.dataset.name;
            updateModal.style.display = "block";
        });
    });

    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const row = this.closest(".table-row");
            document.getElementById("delete_id").value = row.dataset.id;
            deleteModal.style.display = "block";
        });
    });

    document.querySelectorAll(".close-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            this.closest(".modal").style.display = "none";
        });
    });
});
