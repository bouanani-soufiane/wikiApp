document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll('[data-modal-target="edit-modal"]');
    const modal = document.getElementById("edit-modal");
    const hiddenInput = modal.querySelector('[name="idCateg"]');
    const inputTextCateg = modal.querySelector('#nameCatg');


    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const categoryId = this.getAttribute("data-categ-id");
            const categoryname = this.getAttribute("data-categ-name");

            hiddenInput.value = categoryId;
            inputTextCateg.value = categoryname;

        });
    });


});
