const toggleButton = document.getElementById('toggle-button');
const naviList = document.getElementById('navi-list');

toggleButton.addEventListener('click', () => {
    naviList.classList.toggle('active');
});

// Check if the page language is set to 'ar' and direction is 'rtl'
if (document.documentElement.lang === 'ar' && document.documentElement.dir === 'rtl') {
    // Get the element by its ID
    var targetElement = document.getElementById('toggle-button');

    // Remove the oldClass
    targetElement.classList.remove('menunew');

    // Add the newClass
    targetElement.classList.add('menunewar');
}
