let mode = document.getElementById('mode');
let htmlClasses = document.querySelector('html').classList;
let DarkMode = localStorage.getItem('DarkMode');
console.log(DarkMode);

if (DarkMode == "on") {
    modeIcon.classList.add('fa-toggle-on');
    htmlClasses.add('dark');
    localStorage.setItem('DarkMode', "on");
} else {
    modeIcon.classList.add('fa-toggle-off');
    localStorage.setItem('DarkMode', "off");
}

mode.addEventListener('click', function () {
    let modeIcon = document.getElementById('modeIcon');
    let htmlClasses = document.querySelector('html').classList;

    if (DarkMode == "on") {
        modeIcon.classList.remove('fa-toggle-on');
        modeIcon.classList.add('fa-toggle-off');
        htmlClasses.remove('dark');

        DarkMode = "off"; // i don't know why but if delete this line, user only can change mode one time
        localStorage.setItem('DarkMode', "off");
    } else {
        modeIcon.classList.remove('fa-toggle-off');
        modeIcon.classList.add('fa-toggle-on');
        htmlClasses.add('dark');

        DarkMode = "on"; // i don't know why but if delete this line, user only can change mode one time
        localStorage.setItem('DarkMode', "on");
    }
})
