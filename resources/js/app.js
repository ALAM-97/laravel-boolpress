require('./bootstrap');

const deleteButtons = document.querySelectorAll(".btn-delete");
const inputDeleteId = document.getElementById("delete-id");
deleteButtons.forEach(
    (elm) => {
        elm.addEventListener("click", function() {
            inputDeleteId.value = this.getAttribute("data-id")
        });
    }
)