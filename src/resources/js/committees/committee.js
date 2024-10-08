document.addEventListener('DOMContentLoaded', () => {
    document.getElementById("openCreateModal").onclick = function() {
        document.getElementById("createModal").style.display = "block";
    };

    document.getElementById("closeCreateModal").onclick = function() {
        document.getElementById("createModal").style.display = "none";
    };

    document.querySelectorAll(".editButton").forEach(button => {
        button.onclick = function() {
            const row = this.closest("tr");
            document.getElementById("updateId").value = row.dataset.id;
            document.getElementById("updateCode").value = row.dataset.code;
            document.getElementById("updateName").value = row.dataset.name;
            document.getElementById("updateModal").style.display = "block";
        };
    });

    document.querySelectorAll(".deleteButton").forEach(button => {
        button.onclick = function() {
            const row = this.closest("tr");
            document.getElementById("deleteId").value = row.dataset.id;
            document.getElementById("deleteModal").style.display = "block";
        };
    });

    document.getElementById("closeUpdateModal").onclick = function() {
        document.getElementById("updateModal").style.display = "none";
    };

    document.querySelectorAll(".closeDeleteModal").forEach(btn => {
    btn.onclick = function() {
            document.getElementById("deleteModal").style.display = "none";
        }
    });
});