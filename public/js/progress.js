// HTML Progress
const htmlProgressBar = document.getElementById('html-progress');
const bootstrapProgressBar = document.getElementById('bootstrap-progress');
const url = document.getElementById('progress-simulation').dataset.url;

let xhr = new XMLHttpRequest();
let done = false;
let runner;
xhr.onloadend = function(e) {
  const data = JSON.parse(e.originalTarget.response);
  const percent = Math.round(data.progress * 100);
  // Update HTML5 Progress
  htmlProgressBar.value = data.current;
  htmlProgressBar.getElementsByTagName('span')[0].innerHTML = percent + '%';
  // Update Bootstrap Progress
  bootstrapProgressBar.getElementsByClassName('progress-bar')[0].classList.add('progress-bar-animated');
  bootstrapProgressBar.getElementsByClassName('progress-bar')[0].style = 'width: ' + percent + '%';
  bootstrapProgressBar.getElementsByClassName('progress-bar')[0].getElementsByTagName('span')[0].innerHTML = percent + '%';
  // Stop updates, if progress have been finished
  if (data.progress === 1) {
    done = true;
    bootstrapProgressBar.getElementsByClassName('progress-bar')[0].classList.remove('progress-bar-animated');
    clearInterval(runner);
  }
};

runner = setInterval(() => {
  if (!done) {
    xhr.open('GET', url, true);
    xhr.send();
  }
}, 1000);