// Immediately set the theme based on local storage
const darkMode = localStorage.getItem('darkMode');
const themeClass = darkMode === 'enabled' ? 'dark' : 'light';

// Apply the theme class to the document
document.documentElement.className = themeClass;

// Wait for DOM to be fully loaded before adding event listeners
document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggles = document.querySelectorAll("[id^='dark-mode-toggle']");
    const lightModeToggles = document.querySelectorAll("[id^='light-mode-toggle']");

    let isDarkMode = localStorage.getItem("darkMode") === "enabled";

    function applyTheme(isDark) {
        document.documentElement.classList.toggle("dark", isDark);
        localStorage.setItem("darkMode", isDark ? "enabled" : "disabled");

        darkModeToggles.forEach(btn => btn.classList.toggle("activate", !isDark));
        lightModeToggles.forEach(btn => btn.classList.toggle("activate", isDark));
    }

    // تطبيق الوضع الحالي
    applyTheme(isDarkMode);

    // إضافة الأحداث لكل زر
    darkModeToggles.forEach(btn => btn.addEventListener("click", () => applyTheme(true)));
    lightModeToggles.forEach(btn => btn.addEventListener("click", () => applyTheme(false)));
});
