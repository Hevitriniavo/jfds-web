document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const row = this.closest('tr');
            document.getElementById('editUserId').value = row.dataset.id;
            document.getElementById('editFirstName').value = row.dataset.first_name;
            document.getElementById('editLastName').value = row.dataset.last_name;
            document.getElementById('editCin').value = row.dataset.cin;
            document.getElementById('editBirthDate').value = row.dataset.birth_date;
            document.getElementById('editApv').value = row.dataset.apv;
            document.getElementById('editAddress').value = row.dataset.address;
            document.getElementById('editGender').value = row.dataset.gender;
            document.getElementById('editResponsibility').value = row.dataset.responsibility;
        });
    })

    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation();
            const row = this.closest('tr');
            document.getElementById('deleteUserId').value = row.dataset.id;
            document.getElementById('deletePhotoId').value = row.dataset.photo;
        });
    });

    const addSacramentButtons = document.querySelectorAll('.add-sacrament-btn');

    addSacramentButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            document.getElementById('sacramentUserId').value = this.getAttribute('data-user-id');
            event.stopPropagation();
        });
    });

    const modal = document.getElementById('addSacramentModal');
    modal.addEventListener('click', function (event) {
        event.stopPropagation();
    });
    initModalDetail()
});


function initModalDetail(){
    const tableRows = document.querySelectorAll('#table-row');

    const detailModal = document.getElementById('detailModal');
    const userIdElem = document.getElementById('userId');
    const userNameElem = document.getElementById('userName');
    const userLastNameElem = document.getElementById('userLastName');
    const userCinElem = document.getElementById('userCin');
    const userBirthDateElem = document.getElementById('userBirthDate');
    const userAddressElem = document.getElementById('userAddress');
    const userGenderElem = document.getElementById('userGender');
    const userApvElem = document.getElementById('userApv');
    const userQrCodeElem = document.getElementById('userQrCode');
    const userRoleElem = document.getElementById('userRole');
    const userResponsibilityElem = document.getElementById('userResponsibility');
    const userPhotoElem = document.getElementById('userPhoto');

    tableRows.forEach(row => {

        row.addEventListener('click', function (event) {

            if (event.target.classList.contains('edit-btn') || event.target.classList.contains('delete-btn')) {
                return;
            }
            const userId = this.getAttribute('data-id');
            const firstName = this.getAttribute('data-first_name');
            const lastName = this.getAttribute('data-last_name');
            const cin = this.getAttribute('data-cin');
            const birthDate = this.getAttribute('data-birth_date');
            const address = this.getAttribute('data-address');
            const gender = this.getAttribute('data-gender');
            const apv = this.getAttribute('data-apv');
            const qrCode = this.getAttribute('data-qr_code');
            const role = this.getAttribute('data-role');
            const responsibility = this.getAttribute('data-responsibility');
            const photo = this.getAttribute('data-photo');

            userIdElem.textContent = userId;
            userNameElem.textContent = firstName;
            userLastNameElem.textContent = lastName;
            userCinElem.textContent = cin;
            userBirthDateElem.textContent = birthDate;
            userAddressElem.textContent = address;
            userGenderElem.textContent = gender;
            userApvElem.textContent = apv;
            userQrCodeElem.textContent = qrCode;
            userRoleElem.textContent = role;
            userResponsibilityElem.textContent = responsibility;
            userPhotoElem.src = "assets/" + photo || "assets/" + 'default_photo.jpg';

            const modal = new bootstrap.Modal(detailModal);
            modal.show();
        });
    });

}