window.onload = function () {
  let pseudo_id = new URLSearchParams(window.location.search).get("pseudo_id");
  const url = "../back/profil_consulter.php?pseudo_id=" + pseudo_id;
  async function fetch_data() {
    let response = await fetch(url);
    let data = await response.json();
    // console.log(data);
    if (data.length > 0) {
      let container = document.querySelector("#container");
      let banner = document.createElement("img");
      banner.setAttribute("src", "./img/" + data[0].banner);
      let div = document.querySelector("#img_button");
      let img_profil = document.querySelector("#img");
      img_profil.setAttribute("src", "./img/" + data[0].profile_picture);
      let div_info = document.querySelector("#div_info");
      let li1 = document.querySelector(".li1");
      li1.innerText = data[0].username;
      let li2 = document.querySelector(".li2");
      li2.innerText = data[0].at_user_name;
      let li3 = document.querySelector(".li3");
      li3.innerText = data[0].bio;
      let li_city = document.querySelector(".li_city");
      li_city.innerHTML =
        "<i class='fa-solid fa-location-dot mr-2'></i>" + data[0].city;
      let li_time = document.querySelector(".li_time");
      li_time.innerHTML =
        "<i class='fa-solid fa-calendar-days mr-2'></i>" +
        data[0].creation_time;
      container.append(banner, div, div_info);

      let container_post = document.querySelector("#container_post");
      container_post.innerHTML = "";
      data.forEach((item) => {
        if (item.content) {
          let div_container = document.createElement("div");
          div_container.className =
            "flex w-full px-4 py-3 border-t border-solid border-gray-500 ";
          let img = document.createElement("img");
          img.setAttribute("src", "./img/" + item.profile_picture);
          img.className = "h-11 w-11";
          let div = document.createElement("div");
          div.className = "flex flex-col w-full ml-3 ";
          let div1 = document.createElement("div");
          div1.className = "flex items-start justify-between text-xl";
          let a_div1 = document.createElement("a");
          a_div1.className = "font-normal text-white dark:text-black";
          a_div1.innerHTML =
            item.username +
            "<span class='text-gray-500 ml-5'>" +
            item.at_user_name +
            " · " +
            item.time +
            " " +
            "</span>";

          if (document.querySelector(".message")) {
            let button_message = document.querySelector(".message");
            button_message.addEventListener("click", (event) => {
              console.log("clik");
              window.location.href =
                "../back/create_message_instance.php?otherUserAt=" +
                encodeURIComponent(data[0].at_user_name);
            });
          }
          let i_div1 = document.createElement("i");
          i_div1.className =
            "material-icons-outlined text-gray-500 text-3xl font-bold";
          i_div1.innerText = item.at_user_name;
          div1.append(a_div1);
          let div2 = document.createElement("div");
          div2.className = "text-white dark:text-black text-2xl";
          let p = document.createElement("p");
          p.style.wordWrap = "break-word";
          if (item.content.includes("Retweet")) {
            let new_content = item.content.replaceAll("Retweet", "");
            if (item.content.match(/#(\w+)/)) {
              p.innerHTML =
                new_content.replace(
                  /#([a-zA-Z0-9_][a-zA-Z0-9_'-]*)/g,
                  '<a href="./hashtags_page.php?hashtag=$1">#$1</a>'
                ) + "</br><span class='text-gray-500 text-sm'>Retweet</span>";
            } else {
              p.innerHTML =
                new_content +
                "</br><span class='text-gray-500 text-sm'>Retweet</span>";
            }
          } else if (item.content.match(/#(\w+)/)) {
            p.innerHTML = item.content.replace(
              /#([a-zA-Z0-9_][a-zA-Z0-9_'-]*)/g,
              '<a href="./hashtags_page.php?hashtag=$1">#$1</a>'
            );
          } else {
            p.innerHTML = item.content;
          }
          div2.append(p);
          let div3 = document.createElement("div");
          div3.className = "flex justify-between my-3.5 pr-12";
          let a1 = document.createElement("a");
          a1.className = "text-gray-500 cursor-pointer id_response";
          a1.setAttribute("id", item.id);
          a1.innerHTML = "<i class='fa-regular fa-comment'></i>";

          let form = document.createElement("form");
          form.setAttribute("class", "input_form");
          form.setAttribute(
            "action",
            "../back/reponse.php?id_tweet=" + item.id
          );
          form.setAttribute("method", "POST");
          form.setAttribute("id", item.id);

          let input = document.createElement("textarea");
          input.setAttribute("name", "response");
          input.setAttribute("id", "id_textarea" + item.id);
          let button = document.createElement("button");
          button.setAttribute("type", "submit");
          button.innerText = "Envoyer";
          form.append(input, button);
          form.style.display = "none";
          a1.append(form);

          let a2 = document.createElement("a");
          a2.className = "text-gray-500";
          a2.setAttribute("href", "../back/retweet.php?retweet_id=" + item.id);
          a2.innerHTML = "<i class='fa-solid fa-retweet '></i>";
          let i3 = document.createElement("i");
          i3.className = "material-icons outlined text-gray-500";
          i3.innerHTML =
            "<span class='material-symbols-outlined'>favorite</span>";
          div3.append(a1, a2, i3);
          div.append(div1, div2, div3);
          div_container.append(img, div);
          container_post.append(div_container);
        } else {
          return;
        }
      });
    }
    if (document.querySelector(".follow")) {
      let button_follow = document.querySelector(".follow");
      button_follow.setAttribute("id", data[0].id_user);
      button_follow.addEventListener("click", (event) => {
        let id_user_to_follow = button_follow.getAttribute("id");
        window.location.href =
          "../back/follow.php?id_user_to_follow=" + id_user_to_follow;
      });
    } else if (document.querySelector(".unfollow")) {
      let button_unfollow = document.querySelector(".unfollow");
      button_unfollow.setAttribute("id", data[0].id_user);
      button_unfollow.addEventListener("click", (event) => {
        let id_user_to_unfollow = button_unfollow.getAttribute("id");
        window.location.href =
          "../back/unfollow.php?id_user_to_unfollow=" + id_user_to_unfollow;
      });
    }
  }
  fetch_data();
};
