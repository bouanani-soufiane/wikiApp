</div>
</div>
</main>
<!-- end: Main -->

<script src="https://unpkg.com/@popperjs/core@2"></script>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>
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

        const tagButtons = document.querySelectorAll('[data-modal-target="edit-modal-tag"]');
        const modaltag = document.getElementById("edit-modal-tag");
        const hiddenInputtag = modaltag.querySelector('#idTag');

        tagButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const tagId = this.getAttribute("data-tag-id");
                console.log("Button clicked, tagId:", tagId);

                hiddenInputtag.value = tagId;
            });
        });

    });



</script>
</html>