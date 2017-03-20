// Cherish | main.js


function findElem(id) {
  return document.getElementById(id);
}

function setStyle(property, value, elm) {
  if (elm) {
    elm.setAttribute('style', property + ': ' + value);
  }
}

function fadeOut(elm, time) {
  var value = 1;
  var timer = setInterval(function() {
    value -= 1/(time/35);
    setStyle('opacity', value, elm);
    if (value < 0) {
      clearInterval(timer);
      setStyle('display', 'none', elm);
    }
  }, 35);
}

// if flash message exists, animate fade out
(function flashDisappear() {
  var elm = findElem('flash');
  if (elm) {
    fadeOut(elm, 4000);
  }
})();
