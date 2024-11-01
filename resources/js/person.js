document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('personform');
    const submitBtn = document.getElementById('submitBtn');
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');

    function checkInputs() {
        let allFilled = true;

        inputs.forEach(input => {
            if (input.value.trim() === '') {
                allFilled = false;
            }
        });

        submitBtn.disabled = !allFilled;
    }

    inputs.forEach(input => {
        input.addEventListener('input', checkInputs);
    });

    // Verificación inicial
    checkInputs();
});