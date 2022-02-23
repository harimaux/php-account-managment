// Cookies functionallity - getting vaule of cookie

let errorMessageDiv = document.getElementById("login_error");

function getCookie(cookieValue) {
  let name = cookieValue + "=";
  //adding split and ; to it separates the results from the cookies array
  let spli = document.cookie.split(";");
  for (var j = 0; j < spli.length; j++) {
    let char = spli[j];
    while (char.charAt(0) == " ") {
      char = char.substring(1);
    }
    if (char.indexOf(name) == 0) {
      return char.substring(name.length, char.length);
    }
  }
  return "";
}

function checkCookie() {
  var currentCookieValue = Boolean(getCookie("cssVar"));

  if (currentCookieValue == true) {
    errorMessageDiv.style.display = "flex";
  }
}

checkCookie();
