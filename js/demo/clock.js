
function clock() {
  var time = new Date(),
      hours = time.getHours(),
      minutes = time.getMinutes(),
      seconds = time.getSeconds(),
      ampm = hours >= 12 ? 'PM' : 'AM'; // Determine whether it's AM or PM

  // Convert hours to 12-hour format
  if (hours > 12) {
    hours = hours - 12;
  } else if (hours === 0) {
    hours = 12;
  }

  document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds) + " " + ampm;
  
  function harold(standIn) {
    if (standIn < 10) {
      standIn = '0' + standIn;
    }
    return standIn;
  }
}

setInterval(clock, 1000);
  