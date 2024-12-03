/*
This file provides Javascript code.

@author Cieron <cirrow@proton.me>

*/


document.addEventListener("DOMContentLoaded", function() {
  let url = window.location.href;

  // Remove any hash (#) fragment
  if (url.indexOf("#") !== -1) {
    url = url.substring(0, url.indexOf("#"));
  }

  // Check if &do=admin is already in the URL
  const adminIndex = url.indexOf("&do=admin");

  if (adminIndex !== -1) {
    // Remove everything from &do=admin onwards
    url = url.substring(0, adminIndex);
  }

  // Append &do=admin to the cleaned URL
  document.getElementById("adminbutton").href = url + "&do=admin";
  



});

document.addEventListener("DOMContentLoaded", function() {
  // Get the current URL
  let url = window.location.href;

  // Remove any hash (#) fragment and everything after it
  if (url.indexOf("#") !== -1) {
    url = url.substring(0, url.indexOf("#"));
  }

  // Set the login button href by appending &do=login
  document.getElementById("loginbutton").href = url + "&do=login";
});

