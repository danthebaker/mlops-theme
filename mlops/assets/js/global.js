
// Tell our document that javascript is enabled
document.documentElement.className = 'js';

// Check to see if touchscreen and append body accordingly
// Note: This is not to be relied upon, it is intended as a
// general check for prototyping
if(window.matchMedia("(pointer: coarse)").matches) {
  document.querySelector('html').classList.add('touch');
} else {
  document.querySelector('html').classList.add('no-touch');
}

// --------------------------------------------------------------------
// Listen to tab events to enable outlines (accessibility improvement)
// --------------------------------------------------------------------
function handleFirstTab(e) {
  if (e.keyCode === 9) { // the "I am a keyboard user" key
      document.body.classList.add('user-is-tabbing');
      window.removeEventListener('keydown', handleFirstTab);
  }
}
window.addEventListener('keydown', handleFirstTab);


// --------------------------------------------------------------------
// Mobile menu 
// --------------------------------------------------------------------

var navToggle = document.querySelector('#nav-toggle');
var navMenu = document.querySelector('#nav-main');
var scrollBody = document.querySelector('body');

navToggle.onclick = function() {
  navToggle.classList.toggle('active');
  navMenu.classList.toggle('active');
  scrollBody.classList.toggle('noscroll');
  let expanded = this.getAttribute('aria-expanded') === 'true' || false;
  this.setAttribute('aria-expanded', !expanded);
}


// --------------------------------------------------------------------
// Wrap last word in a span
// --------------------------------------------------------------------

Element.prototype.wrapLastWord = function (left, right) {
  var words = this.innerHTML.split(' ');
  var lastWord = words[words.length - 1];
  words[words.length - 1] = left + lastWord + right;
  this.innerHTML = words.join(' ');
}

// --------------------------------------------------------------------
// Set 100% view height for mobile in a nicer fashion
// --------------------------------------------------------------------

let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);