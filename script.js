// Scroll to Top
const scrollBtn = document.getElementById("scrollTopBtn");

window.onscroll = () => {
  if (scrollBtn) {
    scrollBtn.style.display = window.scrollY > 100 ? "block" : "none";
  }
};

if (scrollBtn) {
  scrollBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}

// Dark Mode Toggle
const toggleBtn = document.getElementById("toggleDarkMode");

if (localStorage.getItem("theme") === "dark") {
  document.body.classList.add("dark-mode");
}

if (toggleBtn) {
  toggleBtn.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
    const theme = document.body.classList.contains("dark-mode") ? "dark" : "light";
    localStorage.setItem("theme", theme);
  });
}

// Typing Animation dengan Looping
const typingText = document.getElementById("typingText");
const textArray = ["HELLO", "WELCOME", "ENJOY"];
let textIndex = 0;
let charIndex = 0;

function typeEffect() {
  if (typingText) {
    if (charIndex < textArray[textIndex].length) {
      typingText.textContent += textArray[textIndex].charAt(charIndex);
      charIndex++;
      setTimeout(typeEffect, 150);
    } else {
      setTimeout(() => {
        typingText.textContent = "";
        charIndex = 0;
        textIndex = (textIndex + 1) % textArray.length;
        typeEffect();
      }, 1000);
    }
  }
}

window.addEventListener("load", () => {
  typeEffect();
  updateClock(); // inisialisasi jam saat load
});

// Karakter Counter Pesan
const messageInput = document.getElementById('message');
const charCounter = document.getElementById('charCounter');
const maxChars = 150;

if (messageInput && charCounter) {
  messageInput.addEventListener('input', () => {
    const remaining = maxChars - messageInput.value.length;
    charCounter.textContent = `Tersisa ${remaining} karakter`;
  });
}

// Fitur Jam Digital
function updateClock() {
  const clock = document.getElementById('clock');
  if (clock) {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();

    // Format 2 digit
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    clock.textContent = `${hours}:${minutes}:${seconds}`;
  }
}

setInterval(updateClock, 1000);
