// Get the nav-tabs element
const navTabs = document.getElementById('nav-tabs');

// Check if the navTabs element exists
if (navTabs) {
  // Add event listener for tab selection
  navTabs.addEventListener('click', function (event) {
    if (event.target.classList.contains('nav-link')) {
      const lastTab = event.target.getAttribute('href');
      updateLastTabSession(lastTab);
      event.preventDefault(); // Prevent the default navigation behavior
    }
  });
}

// Function to update the session value via AJAX
function updateLastTabSession(lastTab) {
  const url = new URL(window.location.href);
  url.searchParams.set('lastTab', lastTab.substring(1));
  const csrfTokenElement = document.getElementById('csrf-token');
  const csrfToken = csrfTokenElement.dataset.token;
  const data = {
    lastTab: lastTab.substring(1),
    _token: csrfToken
  };

  fetch(url.toString(), {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify(data)
  })
    .then(response => {
      if (response.ok) {
        console.log('Session value updated successfully');
        // updateURL(lastTab);
        console.log(url);
        console.log(lastTab.substring(1));
      } else {
        throw new Error('Failed to update session value');
      }
    })
    .catch(error => {
      console.error(error);
    });
}

// Function to update the URL
function updateURL(lastTab) {
  const url = new URL(window.location.href);
  url.searchParams.set('lastTab', lastTab.substring(1));
  window.history.replaceState(null, null, url.toString());
}
