let notification = document.getElementById('notification');
let currentWords = document.getElementById('currentWords');
let alertDiv = document.getElementById('alertDiv');
let alertDivCloseBtn = document.getElementById('alertDivCloseBtn');
let alertTrader = document.getElementsByClassName('alertTrader');
let notifyButton = document.getElementById('notifyButton');
let traderEmail = document.getElementById('traderEmail');
let table = document.getElementById('table');

traderEmail.addEventListener('input', async function () {
  if (traderEmail.value !== '') {
    const response = await fetch(`/traders/${traderEmail.value}`);
    const traders = await response.json();

    table.innerHTML = '';

    // Use Promise.all to wait for all subscription fetches
    const subscriptionPromises = traders.map(user => {
      return fetch(`/subscriptions/${user.id}`)
        .then(response => response.json())
        .then(subscriptions => user.subscriptions = subscriptions);
    });

    await Promise.all(subscriptionPromises);

    traders.forEach(user => {
      table.innerHTML += `
          <tr>
            <td class="py-2 ps-2">
              <div class="flex items-center space-x-2">
                <img src="/uploads/${user.profile_image ? `${user.profile_image}` : 'OIP.jpeg'}" class="rounded-full img" alt="" />
                <p>${user.name}</p>
              </div>
            </td>
            <td>${user.email}</td>
            <td>${user.phone}</td>
            <td>${user.subscriptions}</td>
            <td class="relative group hover:cursor-pointer">
              <select onchange="updateClass(event, ${user.id})" class="bg-eerie_black outline-none">
                <option value="0" ${user.class == 0 ? 'selected' : ''}>User</option>
                <option value="1" ${user.class == 1 ? 'selected' : ''}>Expert</option>
              </select>
            </td>
            <td class="relative group hover:cursor-pointer">
              <select onchange="updateStatus(event, ${user.id})" class="bg-eerie_black outline-none">
                <option value="1" ${user.status == 1 ? 'selected' : ''}>Allowed</option>
                <option value="0" ${user.status == 0 ? 'selected' : ''}>Blocked</option>
              </select>
            </td>
            <td>
              <div class="flex items-center">
              <svg data-user="${user.id}" class="alertTrader hover:cursor-pointer" version="1.0" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
                viewBox="0 0 399.000000 327.000000" preserveAspectRatio="xMidYMid meet">
                <metadata>
                    Created by potrace 1.16, written by Peter Selinger
                    2001-2019
                </metadata>
                <g transform="translate(0.000000,327.000000) scale(0.100000,-0.100000)" fill="white" stroke="none">
                    <path d="M1880 2844 c-45 -20 -87 -59 -111 -106 -15 -29 -19 -58 -19 -131 l0
                            -93 -67 -28 c-214 -88 -385 -282 -445 -503 -17 -66 -22 -121 -28 -368 -8 -312
                            -12 -340 -69 -460 -41 -89 -82 -145 -161 -225 -78 -77 -98 -123 -81 -187 14
                            -53 36 -80 81 -103 36 -19 60 -20 323 -20 l284 0 12 -43 c61 -206 267 -320
                            467 -259 121 38 213 128 251 248 l17 54 283 0 c263 0 287 1 323 20 45 23 67
                            50 81 103 17 64 -3 110 -81 187 -79 80 -120 136 -161 225 -57 120 -61 148 -69
                            460 -6 247 -11 302 -28 368 -60 221 -231 415 -444 503 l-68 28 0 93 c0 73 -4
                            102 -19 131 -53 102 -172 149 -271 106z m143 -115 c33 -25 50 -79 45 -142 l-3
                            -49 -105 0 -105 0 -3 49 c-7 100 35 163 108 163 22 0 48 -8 63 -21z m87 -315
                            c213 -50 396 -224 465 -444 14 -44 19 -113 25 -350 7 -281 9 -299 34 -385 46
                            -151 120 -274 232 -382 56 -53 65 -80 38 -107 -14 -14 -113 -16 -944 -16 -831
                            0 -930 2 -944 16 -26 25 -18 53 25 92 106 95 200 248 245 397 25 86 27 104 34
                            385 6 237 11 306 25 350 68 217 251 393 460 444 80 19 224 19 305 0z m105
                            -1816 c-34 -114 -134 -187 -255 -187 -121 0 -221 73 -255 187 l-6 22 261 0
                            261 0 -6 -22z">
                    </path>
                </g>
              </svg>
                <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=${user.email}">
                <svg xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="1.5em"
                  height="2em" viewBox="0 0 256 256" xml:space="preserve">
                  <defs></defs>
                  <g style="
                      stroke: white;
                      fill: white;
                      stroke-width: 0;
                      stroke-dasharray: none;
                      stroke-linecap: butt;
                      stroke-linejoin: miter;
                      stroke-miterlimit: 10;
                      fill: none;
                      fill-rule: nonzero;
                      opacity: 1;
                      "
                      transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                      <path
                          d="M 75.546 78.738 H 14.455 C 6.484 78.738 0 72.254 0 64.283 V 25.716 c 0 -7.97 6.485 -14.455 14.455 -14.455 h 61.091 c 7.97 0 14.454 6.485 14.454 14.455 v 38.567 C 90 72.254 83.516 78.738 75.546 78.738 z M 14.455 15.488 c -5.64 0 -10.228 4.588 -10.228 10.228 v 38.567 c 0 5.64 4.588 10.229 10.228 10.229 h 61.091 c 5.64 0 10.228 -4.589 10.228 -10.229 V 25.716 c 0 -5.64 -4.588 -10.228 -10.228 -10.228 H 14.455 z"
                          style="
                              stroke: white;
                              fill: white;
                              stroke-width: 0;
                              stroke-dasharray: none;
                              stroke-linecap: butt;
                              stroke-linejoin: miter;
                              stroke-miterlimit: 10;
                              fill-rule: nonzero;
                              opacity: 1;
                          "
                          transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                      <path
                          d="M 11.044 25.917 C 21.848 36.445 32.652 46.972 43.456 57.5 c 2.014 1.962 5.105 -1.122 3.088 -3.088 C 35.74 43.885 24.936 33.357 14.132 22.83 C 12.118 20.867 9.027 23.952 11.044 25.917 L 11.044 25.917 z"
                          style="
                              stroke: white;
                              stroke-width: 0;
                              stroke-dasharray: none;
                              stroke-linecap: butt;
                              stroke-linejoin: miter;
                              stroke-miterlimit: 10;
                              fill: white;
                              fill-rule: nonzero;
                              opacity: 1;
                          "
                          transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                      <path
                          d="M 46.544 57.5 c 10.804 -10.527 21.608 -21.055 32.412 -31.582 c 2.016 -1.965 -1.073 -5.051 -3.088 -3.088 C 65.064 33.357 54.26 43.885 43.456 54.412 C 41.44 56.377 44.529 59.463 46.544 57.5 L 46.544 57.5 z"
                          style="
                              stroke: white;
                              fill: white;
                              stroke-width: 0;
                              stroke-dasharray: none;
                              stroke-linecap: butt;
                              stroke-linejoin: miter;
                              stroke-miterlimit: 10;
                              fill-rule: nonzero;
                              opacity: 1;
                          "
                          transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                      <path
                          d="M 78.837 64.952 c -7.189 -6.818 -14.379 -13.635 -21.568 -20.453 c -2.039 -1.933 -5.132 1.149 -3.088 3.088 c 7.189 6.818 14.379 13.635 21.568 20.453 C 77.788 69.973 80.881 66.89 78.837 64.952 L 78.837 64.952 z"
                          style="
                              stroke: white;
                              fill: white;
                              stroke-width: 0;
                              stroke-dasharray: none;
                              stroke-linecap: butt;
                              stroke-linejoin: miter;
                              stroke-miterlimit: 10;
                              fill-rule: nonzero;
                              opacity: 1;
                          "
                          transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                      <path
                          d="M 14.446 68.039 c 7.189 -6.818 14.379 -13.635 21.568 -20.453 c 2.043 -1.938 -1.048 -5.022 -3.088 -3.088 c -7.189 6.818 -14.379 13.635 -21.568 20.453 C 9.315 66.889 12.406 69.974 14.446 68.039 L 14.446 68.039 z"
                          style="
                              stroke: white;
                              fill: white;
                              stroke-width: 0;
                              stroke-dasharray: none;
                              stroke-linecap: butt;
                              stroke-linejoin: miter;
                              stroke-miterlimit: 10;
                              fill-rule: nonzero;
                              opacity: 1;
                          "
                          transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                  </g>
                </svg>
                </a>
              </div>
            </td>
          </tr>`;
  })

          alertTrader = document.getElementsByClassName('alertTrader');

          Array.from(alertTrader).forEach(element => {
            element.addEventListener('click', () => {
              alertDiv.classList.remove('hidden');
          
              notifyButton.setAttribute('data-user', element.getAttribute('data-user'));
            })
          })
      
} else {
  location.reload();
}
});

Array.from(alertTrader).forEach(element => {
  element.addEventListener('click', () => {
    alertDiv.classList.remove('hidden');

    notifyButton.setAttribute('data-user', element.getAttribute('data-user'));
  })
})

function notifyUser(event) {
  let id = event.target.getAttribute('data-user');

  fetch(`/notify/${id}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    },
    body: JSON.stringify({ notification: notification.value }),
  });

  notification.valie = '';
  alertDiv.classList.add('hidden');
}

alertDivCloseBtn.addEventListener('click', () => {
  alertDiv.classList.add('hidden')
})

notification.addEventListener('input', () => {
  currentWords.innerText = notification.value.length
});

function updateClass(event, id) {
  fetch(`/updateclass/${id}/${event.target.value}`, {
    method: "PATCH",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    }
  });
}

function updateStatus(event, id) {
  fetch(`/updatestatus/${id}/${event.target.value}`, {
    method: "PATCH",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    }
  });
}