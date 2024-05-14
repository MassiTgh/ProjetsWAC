window.onload = function () {
  let convoId = document.querySelector('input[name="id_convo"]').value;
  let userId = document.body.getAttribute("data-user-id");
  let lastMessageId = 0;

  document
    .querySelector(".message_input")
    .addEventListener("input", function (event) {
      let errorMessage = document.getElementById("error-message");
      if (this.value.length >= this.maxLength) {
        errorMessage.textContent =
          "The limit of 400 characters has been reached.";
        errorMessage.style.display = "absolute";
        errorMessage.style.bottom = "8.5vh";
        errorMessage.style.left = "5vh";
      } else {
        errorMessage.textContent = "";
        errorMessage.style.position = "absolute";
      }
    });

  function sendMessage(event) {
    event.preventDefault();

    let messageInput = document.querySelector(".message_input");
    let content = messageInput.value;

    if (content.trim() === "") {
      document.getElementById("error-message").textContent =
        "Message cannot be empty";
      return;
    }

    let messageContainer = document.querySelector(".message_container");
    let messageElement = document.createElement("section");
    messageElement.classList.add("sent_message");

    let messageContent = document.createElement("p");
    messageContent.textContent = content;

    messageElement.appendChild(messageContent);
    messageContainer.appendChild(messageElement);

    fetch("../back/handle_messages.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `id_convo=${convoId}&content=${content}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then(() => {
        messageInput.value = "";
        fetchMessages();
      })
      .catch((error) => {
        console.error(
          "There has been a problem with your fetch operation:",
          error
        );
      });
  }

  function fetchMessages() {
    fetch("../back/fetch_messages.php?convoId=" + convoId)
      .then((response) => response.json())
      .then((messages) => {
        let messageContainer = document.querySelector(".message_container");
        messageContainer.innerHTML = "";

        messages.forEach((message) => {
          let messageElement = document.createElement("section");
          messageElement.classList.add(
            message.id_user == userId ? "sent_message" : "received_message"
          );
          // console.log("message.id_user", message.id_user)
          // console.log("userId", userId)

          let messageContent = document.createElement("p");
          messageContent.textContent = message.content;

          messageElement.appendChild(messageContent);
          messageContainer.appendChild(messageElement);

          lastMessageId = message.id;
        });
        messageContainer.lastElementChild.scrollIntoView();
      });
  }

  fetchMessages();

  setInterval(fetchMessages, 2000);

  document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault();
    sendMessage(event);
  });
};
