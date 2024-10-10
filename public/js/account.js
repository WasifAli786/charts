let deleteAccountModal = document.getElementById('deleteAccountModal');
let deleteAccountButton = document.getElementById('deleteAccountButton');
let keepAccountButton = document.getElementById('keepAccountButton');
let confirmDeletionButton = document.getElementById('confirmDeletionButton');

deleteAccountButton.addEventListener('click', ()=>{
  deleteAccountModal.classList.remove('hidden');
})

keepAccountButton.addEventListener('click', ()=>{
  deleteAccountModal.classList.add('hidden');
})