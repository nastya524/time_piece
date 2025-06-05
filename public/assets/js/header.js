document.addEventListener('DOMContentLoaded', () => {
    const profileButton = document.getElementById('profileButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const screenOverlay = document.getElementById('screenOverlay');
    const arrowIcon = document.getElementById('arrowIcon');

    profileButton.addEventListener('click', () => {
        const isMenuVisible = dropdownMenu.style.display === 'block';
        dropdownMenu.style.display = isMenuVisible ? 'none' : 'block';
        screenOverlay.style.display = isMenuVisible ? 'none' : 'block';

        // Меняем стрелочку
        if (isMenuVisible) {
            arrowIcon.classList.remove('up');
        } else {
            arrowIcon.classList.add('up');
        }
    });

    screenOverlay.addEventListener('click', () => {
        dropdownMenu.style.display = 'none';
        screenOverlay.style.display = 'none';
        arrowIcon.classList.remove('up'); // Убираем класс поворота
    });
});
