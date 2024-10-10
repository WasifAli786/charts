let calendarContainer = document.getElementById('calendarContainer');
let calendarContainer1 = document.getElementById('calendarContainer1');
let selectDateSvg = document.getElementById('selectDateSvg');

flatpickr("#calendar", {
  mode: "range",
  dateFormat: "d/m/Y",
  maxDate: "today",
});

calendarContainer.addEventListener('click', (event) => {
  if (event.target !== event.currentTarget) {
    calendarContainer1.classList.toggle('hidden');
    selectDateSvg.classList.toggle('transform');
    selectDateSvg.classList.toggle('rotate-180');
  }
})

calendarContainer1.addEventListener('click',(event)=>{
    event.stopPropagation();
})