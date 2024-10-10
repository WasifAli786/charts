let unsubExpertModel = document.getElementById('unsubscribeExpertModel');
let keepExpertButton = document.getElementById('keepExpertButton');
let unsubscribeForm = document.getElementById('unsubscribeForm');
let expertNamePlaceholder = document.getElementById('expertNamePlaceholder');

keepExpertButton.onclick = () => {
  unsubExpertModel.classList.add('hidden');
}

function showUnsubModel(id) {
  unsubExpertModel.classList.remove('hidden');
  unsubscribeForm.action = `/billing/${id}`;

  fetch(`/billing/${id}`)
    .then(r => r.json())
    .then(d => {
      expertNamePlaceholder.innerText = d.name
    });
}