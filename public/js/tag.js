const tagButtons = document.querySelectorAll('[data-modal-target="edit-modal-tag"]');
const modaltag = document.getElementById("edit-modal-tag");
const hiddenInputtag = modaltag.querySelector('#idTag');
const inputTextTag = modaltag.querySelector('#nameTag');

tagButtons.forEach((button) => {
    button.addEventListener("click", function () {
        console.log(button)
        const tagId = this.getAttribute("data-tag-id");
        const tagName = this.getAttribute("data-tag-name");

        hiddenInputtag.value = tagId;
        inputTextTag.value = tagName
    });
});
