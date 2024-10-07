document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.card');
    const modal = document.getElementById('userModal');
    const closeButton = document.querySelector('.close-button');
    const modalUserName = document.getElementById('modalUserName');
    const modalUserPhoto = document.getElementById('modalUserPhoto');
    const modalUserRole = document.getElementById('modalUserRole');
    const modalUserAddress = document.getElementById('modalUserAddress');
    const modalUsername = document.getElementById('modalUsername');
    const modalUserGender = document.getElementById('modalUserGender');
    const modalUserBirthDate = document.getElementById('modalUserBirthDate');
    const modalUserCIN = document.getElementById('modalUserCIN');
    const modalUserQRCode = document.getElementById('modalUserQRCode');
    const modalUserCreatedAt = document.getElementById('modalUserCreatedAt');
    const modalUserUpdatedAt = document.getElementById('modalUserUpdatedAt');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const userId = card.getAttribute('data-id');
            fetch(`/user?id=${userId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        console.error(data.error);
                    } else {
                        modalUserName.textContent = `${data.first_name} ${data.last_name}`;
                        modalUserPhoto.src = `/assets/${data.photo}`;
                        modalUserRole.textContent = data.role_id;
                        modalUserAddress.textContent = data.address;
                        modalUsername.textContent = data.username;
                        modalUserGender.textContent = data.gender;
                        modalUserBirthDate.textContent = data.birth_date;
                        modalUserCIN.textContent = data.cin;
                        modalUserQRCode.textContent = data.qr_code ? data.qr_code : "N/A";
                        modalUserCreatedAt.textContent = data.created_at;
                        modalUserUpdatedAt.textContent = data.updated_at;

                        modal.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        });
    });

    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
