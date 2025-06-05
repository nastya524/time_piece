document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.hero-slider');
    const slides = document.querySelectorAll('.hero-slider__slide');
    const prevButton = document.querySelector('.hero-slider__button--prev');
    const nextButton = document.querySelector('.hero-slider__button--next');
    const dotsContainer = document.querySelector('.hero-slider__dots');
    
    let currentSlide = 0;
    const slideCount = slides.length;

    // Создаем точки навигации
    slides.forEach((_, index) => {
        const dot = document.createElement('button');
        dot.classList.add('hero-slider__dot');
        if (index === 0) dot.classList.add('hero-slider__dot--active');
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll('.hero-slider__dot');

    function updateSlider() {
        slides.forEach((slide, index) => {
            if (index === currentSlide) {
                slide.style.transform = 'translateX(0)';
            } else if (index < currentSlide) {
                slide.style.transform = 'translateX(-100%)';
            } else {
                slide.style.transform = 'translateX(100%)';
            }
        });
        
        // Обновляем активную точку
        dots.forEach((dot, index) => {
            dot.classList.toggle('hero-slider__dot--active', index === currentSlide);
        });
    }

    function goToSlide(index) {
        currentSlide = index;
        updateSlider();
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slideCount;
        updateSlider();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slideCount) % slideCount;
        updateSlider();
    }

    // Добавляем обработчики событий
    prevButton.addEventListener('click', prevSlide);
    nextButton.addEventListener('click', nextSlide);

    // Автоматическое переключение слайдов каждые 5 секунд
    let slideInterval = setInterval(nextSlide, 5000);

    // Останавливаем автопереключение при наведении мыши
    slider.addEventListener('mouseenter', () => {
        clearInterval(slideInterval);
    });

    // Возобновляем автопереключение при уходе мыши
    slider.addEventListener('mouseleave', () => {
        slideInterval = setInterval(nextSlide, 5000);
    });

    // Инициализация слайдера
    updateSlider();
}); 