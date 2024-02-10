function darkMode() {
    var element = document.body;
    element.classList.toggle("dark-mode");

    // chck apakah dark mode aktif
    var isDarkMode = element.classList.contains("dark-mode");
    localStorage.setItem("darkMode", isDarkMode);
}


function applyDarkModePreference() {
    var isDarkMode = localStorage.getItem("darkMode") === "true";
    var element = document.body;

    // simpan informasi darkmode
    if (isDarkMode) {
        element.classList.add("dark-mode");
    } else {
        element.classList.remove("dark-mode");
    }
}

// panggil funsgi dark mode yang talh disimpan
applyDarkModePreference();
