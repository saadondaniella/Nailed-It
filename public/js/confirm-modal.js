document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("confirm-modal");
    const cancelButton = document.getElementById("confirm-cancel");
    const deleteButton = document.getElementById("confirm-delete");

    let currentForm = null;

    const openModal = (form) => {
        currentForm = form;
        modal.style.display = "flex";
        modal.setAttribute("aria-hidden", "false");
    };

    const closeModal = () => {
        modal.style.display = "none";
        modal.setAttribute("aria-hidden", "true");
        currentForm = null;
    };

    document.querySelectorAll("form[data-confirm-delete]").forEach((form) => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();
            openModal(form);
        });
    });

    cancelButton.addEventListener("click", closeModal);

    deleteButton.addEventListener("click", () => {
        if (currentForm) {
            currentForm.submit();
        }
    });
});
