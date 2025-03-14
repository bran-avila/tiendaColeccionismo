const mobileScreen = window.matchMedia("(max-width: 990px)");

document.addEventListener("DOMContentLoaded", function() {
  const dropdownToggles = document.querySelectorAll(".dashboard-nav-dropdown-toggle");
  const menuToggles = document.querySelectorAll(".menu-toggle");
  const dashboardNavs = document.querySelectorAll(".dashboard-nav");
  const dashboards = document.querySelectorAll(".dashboard");

  dropdownToggles.forEach(function(toggle) {
    toggle.addEventListener("click", function() {
      const dropdown = toggle.closest(".dashboard-nav-dropdown");
      if (dropdown) {
        dropdown.classList.toggle("show");
        dropdown.querySelectorAll(".dashboard-nav-dropdown").forEach(function(nestedDropdown) {
          nestedDropdown.classList.remove("show");
        });
        const siblings = Array.from(toggle.parentElement.parentElement.children).filter(child => child !== toggle.parentElement);
        siblings.forEach(sibling => {
          sibling.classList.remove("show");
        });
      }
    });
  });

  menuToggles.forEach(function(menuToggle) {
    menuToggle.addEventListener("click", function() {
      if (mobileScreen.matches) {
        dashboardNavs.forEach(nav => nav.classList.toggle("mobile-show"));
      } else {
        dashboards.forEach(dashboard => dashboard.classList.toggle("dashboard-compact"));
      }
    });
  });
});