window.onload = function () {
  let user = new URLSearchParams(window.location.search).get("user");
  const url = "../back/search_member.php?user=" + user;
  async function fetch_data() {
    let response = await fetch(url);
    let data = await response.json();
    console.log(data);
    if (data.length > 0) {
      let container = document.querySelector("#container");
      container.innerHTML = "";
      data.forEach((item) => {
        create_list_item(item, container);
      });
    }
  }
  fetch_data();

  function create_list_item(item, container) {
    let ul = document.createElement("ul");
    ul.className =
      "flex items-center border border-solid border-gray-500 rounded-2xl mb-7 px-4 py-4";

    let li1 = document.createElement("li");
    li1.className = "mr-4";
    let img = document.createElement("img");
    img.className = "h-24 w-24";
    img.setAttribute("src", "./img/" + item.profile_picture);
    li1.append(img);

    let li2 = document.createElement("li");
    li2.className = "mr-4";
    li2.innerHTML = item.username + "</br>" + item.at_user_name;

    let li4 = document.createElement("li");
    li4.className = "mr-4";
    let button_show = document.createElement("button");
    button_show.className =
      "border border-solid border-gray-500 py-2 px-4 rounded-2xl bg-white text-black font-bold";
    button_show.innerText = "Consulter";
    button_show.setAttribute("id", item.id);
    li4.append(button_show);

    button_show.addEventListener("click", () => {
      let pseudo_id = button_show.getAttribute("id");
      window.location.href = "./profil_search_user.php?pseudo_id=" + pseudo_id;
    });

    ul.append(li1, li2, li4);
    container.append(ul);
  }

  let submit_search = document.querySelector("#submit_search");
  submit_search.addEventListener("submit", () => {
    event.preventDefault();
    let input = document.querySelector("#search_hashtag").value;
    if (input.startsWith("#")) {
      document.querySelector("#error_hashtag").innerText = "sans #";
    } else if (input) {
      window.location.href = "./hashtags_page.php?hashtag=" + input;
    }
  });

  let submit_search_user = document.querySelector("#submit_search_user");
  submit_search_user.addEventListener("submit", () => {
    event.preventDefault();
    let input = document.querySelector("#search_user").value;
    if (!input.startsWith("@")) {
      document.querySelector("#error_pseudo").innerText = "Manque @ au debut.";
    } else if (input.includes(" ")) {
      document.querySelector("#error_pseudo").innerText = "Retirer les espaces";
    } else if (input && input.startsWith("@")) {
      window.location.href = "./search_page_user.php?user=" + input;
    }
  });
};
