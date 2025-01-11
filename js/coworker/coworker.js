function handleSidebarCollapse() {
  const sidebar = document.querySelector("#sidebar");
  const viewportWidth = window.innerWidth;

  if (viewportWidth < 768) {
    sidebar.classList.add("collapsed");
  } else {
    sidebar.classList.remove("collapsed");
  }
}

handleSidebarCollapse();

// Add event listener for window resize to handle dynamic resizing
window.addEventListener("resize", handleSidebarCollapse);

const sidebarToggle = document.querySelector("#sidebar-toggle");
const collapseIcon = document.querySelector("#collapse-icon");
const sidebar = document.querySelector("#sidebar");
sidebarToggle.addEventListener("click", function () {
  console.log("Sidebar toggle clicked");
  document.querySelector("#sidebar").classList.toggle("collapsed");
  collapseIcon.classList.toggle("bi-list");
  collapseIcon.classList.toggle("bi-arrow-bar-left");
});
