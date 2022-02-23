const linksDiv = document.getElementById("header_links");

linksDiv.addEventListener("click", () => {
  const errorDiv = document.querySelector(".error_link_message");
  errorDiv.style.display = "flex";

  const myTimer = setTimeout(deleteError, 2000);

  function deleteError() {
    errorDiv.style.display = "none";
    clearTimeout(myTimer);
  }
});

const mobileBtn = document.querySelector(".mobile_btn");
const menu = document.getElementById("menu");

mobileBtn.addEventListener("click", () => {
  menu.classList.toggle("menu_toggle");
});
