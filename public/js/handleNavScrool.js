document.addEventListener('DOMContentLoaded', function() {
  let lastScrollTop = 0;
  const navbar = document.querySelector('nav');

  window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
      // Scroll ke bawah
      navbar.classList.add('visible-navbar');
      // navbar.classList.remove('visible-navbar');
    } else {
      // Scroll ke atas
      // navbar.classList.add('hidden-navbar');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  });
});
