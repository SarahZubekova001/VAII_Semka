
    document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
    let isValid = true;

    // PSČ - musí byť presne 5 číslic
    const postalCode = document.getElementById("postal_code");
    if (!/^\d{5}$/.test(postalCode.value)) {
    isValid = false;
    showError(postalCode, "PSČ musí obsahovať presne 5 číslic.");
} else {
    clearError(postalCode);
}

    // Telefónne číslo - musí mať 9-15 číslic
    const phoneNumber = document.getElementById("phone_number");
    if (!/^\d{9,15}$/.test(phoneNumber.value)) {
    isValid = false;
    showError(phoneNumber, "Telefónne číslo musí mať 9-15 číslic.");
} else {
    clearError(phoneNumber);
}

    if (!isValid) {
    event.preventDefault(); // Zabráni odoslaniu formulára
}
});

    function showError(input, message) {
    let error = input.nextElementSibling;
    if (!error || !error.classList.contains("text-danger")) {
    error = document.createElement("small");
    error.classList.add("text-danger");
    input.parentNode.appendChild(error);
}
    error.textContent = message;
}

    function clearError(input) {
    let error = input.nextElementSibling;
    if (error && error.classList.contains("text-danger")) {
    error.remove();
}
}
});
