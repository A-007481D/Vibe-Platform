document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".unfriend-btn").forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            let userId = this.dataset.userId;
            let card = this.closest(".friend-card");

            fetch(`/friends/unfriend/${userId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        card.remove();
                    }
                })
                .catch((error) => console.error("Error:", error));
        });
    });

    document.querySelectorAll(".add-friend-btn").forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            let userId = this.dataset.userId;
            let buttonElement = this;

            fetch(`/friend-request/send/${userId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        buttonElement.innerText = "Request Sent";
                        buttonElement.disabled = true;
                    }
                })
                .catch((error) => console.error("Error:", error));
        });
    });
});
