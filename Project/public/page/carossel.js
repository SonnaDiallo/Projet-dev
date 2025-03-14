let index = 0;

function moveCarousel() {
  const track = document.querySelector('.carousel-track');
  const cards = document.querySelectorAll('.card');
  const cardWidth = cards[0].offsetWidth;
  index++;

  if (index >= cards.length) {
    index = 0;
  }

  const transformValue = -cardWidth * index;
  track.style.transform = `translateX(${transformValue}px)`;
}

setInterval(moveCarousel, 3000);
