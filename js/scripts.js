// Background flicker
var i = 1;
setInterval(function() {
    document.getElementById('home').style.backgroundImage = "linear-gradient(var(--crimson-color), rgba(255, 255, 255, 0), rgba(255, 255, 255, 0)), url('./resources/home" + i + ".jpg')";
    i = i % 2
    i++;
}, 5000);

// Menu item
var menuCatergoryButtons = document.getElementsByClassName('menuCategoryButton');
if (menuCatergoryButtons != null) {
    for (let index = 0; index < menuCatergoryButtons.length; index++) {
        const menuCatergoryButton = menuCatergoryButtons[index];
        menuCatergoryButton.onclick = function(e) {
            menuCatergory = e.target.id;
            AdjustVisibilityOfMenuItems(menuCatergory.substr(9));
        }   
    }
}

AdjustVisibilityOfMenuItems('food');

// Hide menu items
function AdjustVisibilityOfMenuItems(selectedMenuCategoryId) {
    var menuCategories = document.getElementsByClassName('menuCategory');
    if (menuCategories != null) {
        for (let index = 0; index < menuCategories.length; index++) {
            menuCategories[index].classList.remove('visible');
            menuCategories[index].classList.add('hidden');
        }
    }
    document.getElementById(selectedMenuCategoryId).classList.remove('hidden');
    document.getElementById(selectedMenuCategoryId).classList.add('visible');
}