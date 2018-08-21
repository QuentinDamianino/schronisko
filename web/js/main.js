document.addEventListener('DOMContentLoaded', function () {
    let warning = document.querySelector('.alert');
    let message = warning.dataset.warning;
    if (message !== null){
        alert(message);
    }
})
