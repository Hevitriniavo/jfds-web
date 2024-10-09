document.addEventListener('DOMContentLoaded', () => {
    initializeToast();
    validateForm()
});



function initializeToast() {
    const toast = document.querySelector('#toast .toast');
    const closeButton = document.querySelector('#closeToast');

    if (toast) {
        setTimeout(() => {
            toast.classList.remove('show');
        }, 5000);

        if (closeButton) {
            closeButton.addEventListener('click', () => {
                toast.classList.remove('show');
            });
        }
    }
}


function validateForm () {
    (function () {
        'use strict';
        const form = document.getElementById('signupForm');
        if (form){
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }
    })();
}