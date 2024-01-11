document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll('[data-modal-target="edit-modal"]');
    const modal = document.getElementById("edit-modal");
    const hiddenInput = modal.querySelector('[name="idCateg"]');

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const categoryId = this.getAttribute("data-categ-id");

            hiddenInput.value = categoryId;
        });
    });


});
