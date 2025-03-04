document.addEventListener("DOMContentLoaded", () => {


        document.querySelectorAll('.detach-btn').forEach(function(button) {
        button.onclick = function () {
            const row = button.closest('.table-row');
            document.getElementById('detachMemberId').value = row.dataset.memberId;
            document.getElementById('detachUserId').value = row.dataset.userId;
            document.getElementById('detachModal').style.display = 'block';
        }
    });

        document.querySelectorAll('.close-btn').forEach(function(btn) {
        btn.onclick = function () {
            const modal = btn.closest('.modal');
            modal.style.display = 'none';
        }
    });

        document.querySelector('.cancel-btn').onclick = function() {
        document.getElementById('detachModal').style.display = 'none';
    }

        window.onclick = function(event) {
        const detachModal = document.getElementById('detachModal');
        if (event.target === detachModal) {
        detachModal.style.display = 'none';
    }
    }

})