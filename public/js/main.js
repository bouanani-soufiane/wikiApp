document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(
        '[data-modal-target="edit-modal"]'
    );
    const modal = document.getElementById("edit-modal");

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const categoryId = this.getAttribute("data-categ-id");
            const modalTitle = modal.querySelector(".text-gray-900");
            modalTitle.textContent = `Edit Categorie ${categoryId}`;
        });
    });
});
