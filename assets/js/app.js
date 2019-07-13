/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('../css/header.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

document.addEventListener("DOMContentLoaded", function() {
  var mobileNav = document.querySelector('.mobile-nav-dropdown-button')
  var mobileNavDropdown = document.querySelector(".mobile-nav-dropdown")
  var navChevron = document.querySelector("#nav-chevron")
  mobileNav.addEventListener('click', () => {
    mobileNavDropdown.classList.toggle("nav-dropdown-show");
    navChevron.classList.toggle('chevron-up');
  })

});
