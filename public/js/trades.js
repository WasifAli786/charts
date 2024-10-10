let notesBrowseBtn = document.getElementsByClassName('notesBrowseBtn');
let notesDiv = document.getElementById('notesDiv');
let titleDiv = document.getElementById('titleDiv');
let contentDiv = document.getElementById('contentDiv');
let notesDivCloseBtn = document.getElementById('notesDivCloseBtn');
let historyForm = document.getElementById('historyForm');

Array.from(notesBrowseBtn).forEach(element => {
  element.addEventListener('click', () => {
    let heading = element.getAttribute('data-name');
    titleDiv.innerText = heading;

    const parentElement = element.parentElement;
    const children = Array.from(parentElement.children);
    const numChildren = children.length;

    notesDiv.classList.remove('hidden');
    contentDiv.innerHTML = "";

    for (let i = 0; i < numChildren - 1; i++) {
      const childElement = children[i];
      const clonedChild = childElement.cloneNode(true);
      clonedChild.classList.add("overflow-hidden");

      clonedChild.classList.add('me-[2px]');
      clonedChild.classList.add('mb-1');

      contentDiv.appendChild(clonedChild);
    }
  })
})

function showNote(id) {
  fetch(`/note/${id}`)
    .then(r => r.json())
    .then(d => {
      notesDiv.classList.remove('hidden')
      titleDiv.innerText = d.setup.heading
      contentDiv.innerText = d.setup.content
    })
}