let notificationsIcon = document.getElementById("notificationsIcon");
let notificationsAlertIcon = document.getElementById("notificationsAlertIcon");

notificationsIcon.addEventListener("mouseover", () => {
  notificationsAlertIcon.remove();
});