subscribers = document.getElementById('subscribers');
win = document.getElementById('win');

function withSubscriber() {
  value = subscribers.value;

  if (value != 'any') { 
    window.location = `/experts/subscribers/${value}`;
  }
}

function withWin()
{
  value = win.value;

  if (value != 'any') { 
    window.location = `/experts/win/${value}`;
  }
}