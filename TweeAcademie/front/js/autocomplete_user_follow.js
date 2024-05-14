let list_user = [];
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    let response_parse = JSON.parse(this.responseText);
    response_parse.forEach((element) => {
      list_user.push(element.at_user_name);
    });
  }
};
xhttp.open("GET", "../back/get_user.php", true);
xhttp.send();
let result_box = document.querySelector(".result-box");
let textarea = document.querySelector("#tweet");

function cleRelachee() {
  let result = [];
  let value = textarea.value;
  value.split(" ").forEach((valu) => {
    if (valu.startsWith("@")) {
      result = list_user.filter((keyword) => {
        return keyword.toLowerCase().includes(valu.toLowerCase());
      });
      display(result);
    }
  });
}
function display(result) {
  let content = result.map((list) => {
    return (
      "<li onClick='select(this)' id='" +
      list.split("@").join("") +
      "' class='cursor-pointer dark:text-black'>" +
      list +
      "</li>"
    );
  });
  result_box.innerHTML = "<ul>" + content.join("") + "</ul>";
}
function select(list) {
  textarea.value = textarea.value + list.getAttribute("id");
}
