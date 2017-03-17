// Cherish | main.js


function findElem(id) {
  return document.getElementById(id);
}

function setStyle(property, value, elem) {
  if (elem) {
    elem.setAttribute('style', property + ': ' + value);
  }
}

function fadeOut(id, value, timer) {
  setStyle('opacity', value, findElem(id));
  if (value < 0) {
    clearInterval(timer);
    setStyle('display', 'none', findElem(id));
  }
}

// if flash message exists, animate fade out
if (findElem('flash')) {
  (function flashDisappear() {
    // initialize opacity
    var opacity = 1;

    // set default element opacity
    setStyle('opacity', opacity, findElem('flash'));

    // create interval timer
    var timer = setInterval(function() {
      opacity -= 0.01;
      fadeOut('flash', opacity, timer);
    }, 35);
  })();
}
