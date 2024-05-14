let list_all_user = [];
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    let response_parse = JSON.parse(this.responseText);
    response_parse.forEach((element) => {
      list_all_user.push(element.at_user_name);
    });
  }
};
xhttp.open("GET", "../back/get_all_user.php", true);
xhttp.send();
let result_box_search = document.querySelector(".result_box_search");
let search_user = document.querySelector("#search_user");

function keyUp() {
  let result = [];
  let value = search_user.value;
  if (value.startsWith("@")) {
    result = list_all_user.filter((keyword) => {
      return keyword.toLowerCase().includes(value.toLowerCase());
    });
    display_all_user(result);
  } else if (!value) {
    result_box_search.innerHTML = "";
  }
}
function display_all_user(result) {
  let content = result.map((list) => {
    return (
      "<li onClick='select_all_user(this)' id='" +
      list +
      "' class='cursor-pointer dark:text-black'>" +
      list +
      "</li>"
    );
  });
  result_box_search.innerHTML = "<ul>" + content.join("") + "</ul>";
}
function select_all_user(list) {
  search_user.value = list.getAttribute("id");
  result_box_search.innerHTML = "";
}
