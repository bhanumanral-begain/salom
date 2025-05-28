// Scroll to booking section
document.getElementById("bookingForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const form = e.target;
  const name = form.name.value.trim();
  const phone = form.phone.value.trim();
  const email = form.email.value.trim();
  const service = form.service.value;
  const date = form.date.value;
  const time = form.time.value;

  // Basic validations
  if (name.length < 3) {
    alert("Please enter your full name (at least 3 characters).");
    return;
  }
  if (!/^\d{10}$/.test(phone)) {
    alert("Please enter a valid 10-digit phone number.");
    return;
  }
  if (!email.includes("@") || email.length < 5) {
    alert("Please enter a valid email address.");
    return;
  }
  if (!service) {
    alert("Please select a service.");
    return;
  }
  if (!date) {
    alert("Please select a date.");
    return;
  }
  if (!time) {
    alert("Please select a time.");
    return;
  }

  // If all validation passes, submit the form
  form.submit();
});

  // Countdown to midnight
function updateCountdown() {
  const now = new Date();
  const midnight = new Date();
  midnight.setHours(23, 59, 59, 999);
  const diff = midnight - now;

  const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
  const minutes = Math.floor((diff / (1000 * 60)) % 60);
  const seconds = Math.floor((diff / 1000) % 60);

  document.getElementById("timer").innerText =
    ${hours}h ${minutes}m ${seconds}s;
}

// Update every second
setInterval(updateCountdown, 1000);
updateCountdown();
//feedback
document.getElementById("feedbackForm").addEventListener("submit", function (e) {
  const name = this.name.value.trim();
  const email = this.email.value.trim();
  const rating = this.rating.value;
  const message = this.message.value.trim();

  if (name.length < 2) {
    alert("Please enter your full name.");
    e.preventDefault();
  } else if (!email.includes("@")) {
    alert("Please enter a valid email.");
    e.preventDefault();
  } else if (rating === "") {
    alert("Please select a rating.");
    e.preventDefault();
  } else if (message.length < 5) {
    alert("Please enter your feedback message.");
    e.preventDefault();
  }
});