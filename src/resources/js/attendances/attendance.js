document.addEventListener('DOMContentLoaded', () => {
    const markAttendanceBtn = document.getElementById('markAttendanceBtn');
    const markAttendanceModal = document.getElementById('markAttendanceModal');
    const updateAttendanceModal = document.getElementById('updateAttendanceModal');
    const removeAttendanceModal = document.getElementById('removeAttendanceModal');

    markAttendanceBtn.addEventListener('click', () => {
        markAttendanceModal.style.display = 'block';
    });

    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            markAttendanceModal.style.display = 'none';
            updateAttendanceModal.style.display = 'none';
            removeAttendanceModal.style.display = 'none';
        });
    });

    document.querySelectorAll('.update-btn').forEach(btn => {
        btn.addEventListener('click', (event) => {
            const attendanceId = event.target.dataset.id;
            const isPresent = event.target.dataset.isPresent;
            document.getElementById('updateAttendanceId').value = attendanceId;
            document.getElementById('updateIsPresent').value = isPresent;
            updateAttendanceModal.style.display = 'block';
        });
    });

    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', (event) => {
            document.getElementById('removeAttendanceId').value = event.target.dataset.id;
            removeAttendanceModal.style.display = 'block';
        });
    });

    window.addEventListener('click', (event) => {
        if (event.target === markAttendanceModal || event.target === updateAttendanceModal || event.target === removeAttendanceModal) {
            markAttendanceModal.style.display = 'none';
            updateAttendanceModal.style.display = 'none';
            removeAttendanceModal.style.display = 'none';
        }
    });
});
