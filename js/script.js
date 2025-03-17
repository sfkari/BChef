AOS.init();
var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
  });




  {
    class SliderClip {
      constructor(el) {
        this.el = el;
        this.Slides = Array.from(this.el.querySelectorAll('li'));
        this.Nav = Array.from(this.el.querySelectorAll('nav a'));
        this.totalSlides = this.Slides.length;
        this.current = 0;
        this.autoPlay = true; 
        this.timeTrans = 4000; 
        this.IndexElements = [];
  
        for (let i = 0; i < this.totalSlides; i++) {
          this.IndexElements.push(i);
        }
  
        this.setCurret();
        this.initEvents();
      }
      setCurret() {
        this.Slides[this.current].classList.add('current');
        this.Nav[this.current].classList.add('current_dot');
      }
      initEvents() {
        const self = this;
  
        this.Nav.forEach(dot => {
          dot.addEventListener('click', ele => {
            ele.preventDefault();
            this.changeSlide(this.Nav.indexOf(dot));
          });
        });
  
        this.el.addEventListener('mouseenter', () => self.autoPlay = false);
        this.el.addEventListener('mouseleave', () => self.autoPlay = true);
  
        setInterval(function () {
          if (self.autoPlay) {
            self.current = self.current < self.Slides.length - 1 ? self.current + 1 : 0;
            self.changeSlide(self.current);
          }
        }, this.timeTrans);
  
      }
      changeSlide(index) {
  
        this.Nav.forEach(allDot => allDot.classList.remove('current_dot'));
  
        this.Slides.forEach(allSlides => allSlides.classList.remove('prev', 'current'));
  
        const getAllPrev = value => value < index;
  
        const prevElements = this.IndexElements.filter(getAllPrev);
  
        prevElements.forEach(indexPrevEle => this.Slides[indexPrevEle].classList.add('prev'));
  
        this.Slides[index].classList.add('current');
        this.Nav[index].classList.add('current_dot');
      }}
  
  
    const slider = new SliderClip(document.querySelector('.slider'));
  }





  document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll(".Accordion button");

    function toggleAccordion() {
        const itemToggle = this.getAttribute('aria-expanded');

        for (let i = 0; i < items.length; i++) {
            items[i].setAttribute('aria-expanded', 'false');
        }

        if (itemToggle === 'false') {
            this.setAttribute('aria-expanded', 'true');
        }
    }

    items.forEach(item => item.addEventListener('click', toggleAccordion));
});






