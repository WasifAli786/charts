let tradeImage = document.getElementById("tradeImage");

let newNoteForm = document.getElementById("noteForm");
let newNoteType = document.getElementById("newNoteType");
let newNoteoteHeading = document.getElementById("newNoteHeading");
let newNoteoteDescription = document.getElementById("newNoteDescription");

let addRecordDiv = document.getElementById('addRecordDiv');
let newRecordPricePerUnit = document.getElementById('newRecordPricePerUnit');
let newRecordQuantity = document.getElementById('newRecordQuantity');

let noteDiv = document.getElementById('noteDiv');
let noteHeading = document.getElementById('noteHeading');
let noteDescription = document.getElementById('noteDescription');

let editNote = [...document.querySelectorAll(".editNote")];

let tradeStatus = document.getElementById('status');

let date = document.getElementById('date');
let time = document.getElementById('time');

flatpickr("#date", {
  dateFormat: "d/m/Y",
  maxDate: "today",
});

flatpickr("#time", {
  mode: "time",
  dateFormat: "H:i",
});

function getTradeImage() {
  tradeImage.click();
}

if (tradeImage) {
  tradeImage.addEventListener("change", function () {
    if (tradeImage.files.length != 0) {
      document.getElementById("imageForm").submit();
    }
  });
}

function deleteImage(event, id) {
  if (confirm('Do you really want to delet this picture?')) {
    fetch(`/image/${id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
    }).then(
      event.currentTarget.parentElement.remove()
    );
  }
}

function addHistory() {
  addRecordDiv.classList.remove('hidden');
  newRecordPricePerUnit.value = null;
  newRecordQuantity.value = null;

  flatpickr("#date", {
    dateFormat: "d/m/Y",
    maxDate: "today",
  });

  flatpickr("#time", {
    mode: "time",
    dateFormat: "H:i",
  });
}

function removeHistory(event, id) {
  event.stopPropagation();
  event.currentTarget.parentElement.parentElement.remove();

  fetch(`/tradehistory/${id}`, {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    },
  }
  );
}

function showImage(imageElement) {
  imageContainer = document.getElementById('imageContainer');
  document.getElementById('image').src = imageElement.src;

  imageContainer.classList.remove('hidden');
}

function deleteTrade(id) {
  if (confirm('Are you sure you want to delete this trade?')) {
    fetch(`/trade/delete/${id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
    })

    location.reload()
  }
}

function openNoteForm(type) {
  newNoteForm.classList.remove('hidden');
  newNoteType.value = type;
  newNoteoteDescription.value = '';
  newNoteoteDescription.placeholder = `${type} description`;
  newNoteoteHeading.value = '';
  newNoteoteHeading.placeholder = `${type} heading`;
}

function deleteNote(event, id) {
  if (confirm('Are you sure you want to delete this note?')) {
    fetch(`/note/delete/${id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
    })
      .then(r => r.json())
      .then(function (d, event) {
        if (d.error) {
          alert(d.error);
        }
        else {
          event.stopPropagation()
          event.currentTarget.parentElement.parentElement.remove()
        }
      });
  }
}

function showNote(id) {
  fetch(`/note/${id}`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    },
  })
    .then(r => r.json())
    .then(function (note) {
      noteDiv.classList.remove('hidden');
      noteHeading.innerText = note.heading;
      noteDescription.innerText = note.content;
    });
}

function updateStatus(id) {
  fetch(`/trade/update/${id}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    },
    body: JSON.stringify({ status: tradeStatus.value }),
  })
    .then(r => r.json())
    .then(function (d) {
      if (d.success) {
        alert(d.success);

        if (tradeStatus.value == 'loss') {
          tradeStatus.classList.add('bg-red-500', 'text-red-500')
          tradeStatus.classList.remove('bg-green-500', 'text-green-500')
        }
        else {
          tradeStatus.classList.remove('bg-red-500', 'text-red-500')
          tradeStatus.classList.add('bg-green-500', 'text-green-500')
        }
      }
    }
    )
}