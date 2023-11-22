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
    // References to radio buttons
    var radioPagi = document.getElementById("Pagi");
    var radioPetang = document.getElementById("Petang");

    // Daytime: 7.30 AM - 12.00 PM
    if (totalMinutes24h >= 450 && totalMinutes24h <= 720) {
      
      if (typeof radioPagi != "undefined" && radioPagi != null) {
       
      document.getElementById("Pagi").checked = true;
      document.getElementById("Petang").disabled = true;
      }

      return "Shift: Pagi";
    }
    // Nighttime: 3.00 PM - 5.45 PM
    else if (totalMinutes24h >= 900 && totalMinutes24h <= 1065) {
      if (typeof radioPetang != "undefined" && radioPetang != null) {
        document.getElementById("Pagi").checked = true;
        document.getElementById("Petang").disabled = true;
      }

      return "Shift: Petang";
    } else {
      return "Di luar Shift";
    }
  }

  function getMealSession(hours, minutes, ampm) {
    var totalMinutes = hours * 60 + minutes;
    var totalMinutes24h = ampm === "PM" ? totalMinutes + 720 : totalMinutes; // Convert to 24-hour format for easier comparison
    console.log(totalMinutes24h);
    if (totalMinutes24h >= 450 && totalMinutes24h <= 480) {
      // 7.30 AM - 8.00 AM
      return "Sarapan Pagi";
    } else if (totalMinutes24h > 480 && totalMinutes24h < 690) {
      // After 8.00 AM but before 11.30 AM
      return "Belum Makan Tengah Hari";
    } else if (totalMinutes24h >= 690 && totalMinutes24h <= 720) {
      // 11.30 AM - 12.00 PM
      return "Makan Tengahari";
    } else if ((totalMinutes24h > 1440 && totalMinutes24h < 1500) || (totalMinutes24h > 780 && totalMinutes24h < 900)) {
      // After 12.00 PM but before 3.00 PM
      return "Belum Minum Petang";
    } else if (totalMinutes24h >= 900 && totalMinutes24h <= 930) {
      // 3.00 PM - 3.30 PM
      return "Minum Petang";
    } else if (totalMinutes24h > 930 && totalMinutes24h < 1050) {
      // After 3.30 PM but before 5.30 PM
      return "Belum Makan Malam";
    } else if (totalMinutes24h >= 1050 && totalMinutes24h <= 1065) {
      // 5.30 PM - 5.45 PM
      return "Makan Malam";
    } else if (
      (totalMinutes24h >= 1065 && totalMinutes24h <= 1500) ||
      (totalMinutes24h >= 0 && totalMinutes24h <= 450)
    ) {
      // After 5.45 PM - 7.30 AM
      return "Belum Makan Pagi";
    }
  }
}

setInterval(clock, 1000);

function updateDateAndYear() {
  // Create a new Date object to get the current date
  var currentDate = new Date();

  // Get the year from the Date object
  var year = currentDate.getFullYear();

  // Get the month as a number (0-11) from the Date object
  var month = currentDate.getMonth() + 1; // Adding 1 to the month since it's zero-based

  // Get the day from the Date object
  var day = currentDate.getDate();
  // Get the element where you want to display the date and year
  var dateElement = document.querySelector(".update-date");

  if (dateElement) {
    dateElement.textContent = " " + day + "/" + month + "/ " + year;
  // Update the content of the element with the date and year

}
}
// Call the function to initially set the date and year
updateDateAndYear();

// Use setInterval to update the date and year every second (1000 milliseconds)
setInterval(updateDateAndYear, 1000);
