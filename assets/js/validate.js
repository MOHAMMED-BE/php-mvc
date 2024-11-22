document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("productForm");
    const nameField = document.getElementById("name");
    const priceField = document.getElementById("price");
    const quantityField = document.getElementById("quantity");

    nameField.addEventListener("keyup", function (event) {
        let issValid = true;

        const nameInput = document.getElementById("name");
        const nameText = document.getElementById("nameHelp");
        if (nameInput.value.trim().length < 3) {
            nameText.textContent = "Name must be at least 3 characters long.";
            nameText.classList.add("text-danger");
            issValid = false;
        } else {
            nameText.textContent = "Name looks good.";
            nameText.classList.remove("text-danger");
            nameText.classList.add("text-success");
        }
        if (!issValid) {
            event.preventDefault();
        }
    });

    priceField.addEventListener("keyup", function (event) {
        let isValid = true;

        const priceInput = document.getElementById("price");
        const priceText = document.getElementById("priceHelp");
        if (isNaN(priceInput.value) || priceInput.value <= 0) {
            priceText.textContent = "Price must be a positive number.";
            priceText.classList.add("text-danger");
            isValid = false;
        } else {
            priceText.textContent = "Price looks good.";
            priceText.classList.remove("text-danger");
            priceText.classList.add("text-success");
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    quantityField.addEventListener("keyup", function (event) {
        let isValid = true;

        const quantityInput = document.getElementById("quantity");
        const quantityText = document.getElementById("quantityHelp");
        if (isNaN(quantityInput.value) || quantityInput.value <= 0) {
            quantityText.textContent = "Quantity must be a positive number.";
            quantityText.classList.add("text-danger");
            isValid = false;
        } else {
            quantityText.textContent = "Quantity looks good.";
            quantityText.classList.remove("text-danger");
            quantityText.classList.add("text-success");
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    //% ---------------------------
    // form.addEventListener("keyup", function (event) {
    //     let isValid = true;

    //     const nameInput = document.getElementById("name");
    //     const nameText = document.getElementById("nameHelp");
    //     if (nameInput.value.trim().length < 3) {
    //         nameText.textContent = "Name must be at least 3 characters long.";
    //         nameText.classList.add("text-danger");
    //         isValid = false;
    //     } else {
    //         nameText.textContent = "Name looks good.";
    //         nameText.classList.remove("text-danger");
    //         nameText.classList.add("text-success");
    //     }

    //     const priceInput = document.getElementById("price");
    //     const priceText = document.getElementById("priceHelp");
    //     if (isNaN(priceInput.value) || priceInput.value <= 0) {
    //         priceText.textContent = "Price must be a positive number.";
    //         priceText.classList.add("text-danger");
    //         isValid = false;
    //     } else {
    //         priceText.textContent = "Price looks good.";
    //         priceText.classList.remove("text-danger");
    //         priceText.classList.add("text-success");
    //     }

    //     const quantityInput = document.getElementById("quantity");
    //     const quantityText = document.getElementById("quantityHelp");
    //     if (isNaN(quantityInput.value) || quantityInput.value <= 0) {
    //         quantityText.textContent = "Quantity must be a positive number.";
    //         quantityText.classList.add("text-danger");
    //         isValid = false;
    //     } else {
    //         quantityText.textContent = "Quantity looks good.";
    //         quantityText.classList.remove("text-danger");
    //         quantityText.classList.add("text-success");
    //     }



    //     if (!isValid) {
    //         event.preventDefault();
    //     }
    // });
});
