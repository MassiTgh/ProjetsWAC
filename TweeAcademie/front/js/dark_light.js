let moon_icone = document.querySelector(".moon");
let sun_icone = document.querySelector(".sun");

function theme_check() {
  if (
    localStorage.theme === "dark" ||
    (!("theme" in localStorage) &&
      window.matchMedia("(prefers-color-scheme: dark)").matches)
  ) {
    document.documentElement.classList.add("dark");
    sun_icone.classList.add("invisible");
    moon_icone.classList.remove("invisible");
  } else {
    document.documentElement.classList.remove("dark");
    sun_icone.classList.remove("invisible");
    moon_icone.classList.add("invisible");
  }
}
sun_icone.addEventListener("click", () => {
  if (document.documentElement.classList.contains("dark")) {
    document.documentElement.classList.remove("dark");
    localStorage.setItem("theme", "light");
    sun_icone.classList.add("invisible");
    moon_icone.classList.remove("invisible");
    return;
  } else {
    document.documentElement.classList.add("dark");
    localStorage.setItem("theme", "dark");
    sun_icone.classList.add("invisible");
    moon_icone.classList.remove("invisible");
  }
});
moon_icone.addEventListener("click", () => {
  if (document.documentElement.classList.contains("dark")) {
    document.documentElement.classList.remove("dark");
    localStorage.setItem("theme", "light");
    sun_icone.classList.remove("invisible");
    moon_icone.classList.add("invisible");
    return;
  } else {
    document.documentElement.classList.add("dark");
    localStorage.setItem("theme", "dark");
    sun_icone.classList.remove("invisible");
    moon_icone.classList.add("invisible");
  }
});
theme_check();
