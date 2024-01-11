const tagButtons = document.querySelectorAll('[data-modal-target="edit-modal-tag"]');
const modaltag = document.getElementById("edit-modal-tag");
const hiddenInputtag = modaltag.querySelector('#idTag');

tagButtons.forEach((button) => {
    button.addEventListener("click", function () {
        console.log(button)
        const tagId = this.getAttribute("data-tag-id");
        console.log("Button clicked, tagId:", tagId);

        hiddenInputtag.value = tagId;
    });
});
