function clock() {
  var time = new Date(),
    hours = time.getHours(),
    minutes = time.getMinutes(),
    seconds = time.getSeconds(),
    ampm = hours >= 12 ? "PM" : "AM"; // Determine whether it's AM or PM

  // Convert hours to 12-hour format
  if (hours > 12) {
    hours = hours - 12;
  } else if (hours === 0) {
    hours = 12;
  }

  // Determine the current meal session
  var mealSession = getMealSession(hours, minutes, ampm);
  var userShift = getUserShift(hours, minutes, ampm);

  document.querySelectorAll(".clock")[0].innerHTML =
    formatTimeComponent(hours) +
    ":" +
    formatTimeComponent(minutes) +
    ":" +
    formatTimeComponent(seconds) +
    " " +
    ampm +
    " - " +
    mealSession +
    " (" +
    userShift +
    ")";

  function formatTimeComponent(timeComponent) {
    if (timeComponent < 10) {
      timeComponent = "0" + timeComponent;
    }
    return timeComponent;
  }

  function getUserShift(hours, minutes, ampm) {
    var totalMinutes = hours * 60 + minutes;
    var totalMinutes24h = ampm === "PM" ? totalMinutes + 720 : totalMinutes;

    // Daytime: 7.30 AM - 12.00 PM
    if (totalMinutes24h >= 450 && totalMinutes24h <= 720) {
      return "Pagi";
    }
    // Nighttime: 3.00 PM - 5.45 PM
    else if (totalMinutes24h >= 900 && totalMinutes24h <= 1065) {
      return "Petang";
    } else {
      return "Di luar waktu pesanan";
    }
  }

  function getMealSession(hours, minutes, ampm) {
    var totalMinutes = hours * 60 + minutes;
    var totalMinutes24h = ampm === "PM" ? totalMinutes + 720 : totalMinutes; // Convert to 24-hour format for easier comparison

    if (totalMinutes24h >= 450 && totalMinutes24h <= 480) {
      // 7.30 AM - 8.00 AM
      return "Sarapan Pagi";
    } else if (totalMinutes24h >= 690 && totalMinutes24h <= 720) {
      // 11.30 AM - 12.00 PM
      return "Makan Tengahari";
    } else if (totalMinutes24h >= 900 && totalMinutes24h <= 930) {
      // 3.00 PM - 3.30 PM
      return "Minum Petang";
    } else if (totalMinutes24h >= 1050 && totalMinutes24h <= 1065) {
      // 5.30 PM - 5.45 PM
      return "Makan Malam";
    } else {
      return "Belum waktu makan";
    }
  }
}

setInterval(clock, 1000);

