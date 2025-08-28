// Mobile nav toggle
const btn = document.getElementById('hamburger');
const nav = document.getElementById('nav');
if (btn && nav) {
  btn.addEventListener('click', () => nav.classList.toggle('open'));
}
