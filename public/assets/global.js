document.addEventListener('DOMContentLoaded', () => {
    initializeToast();
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
