function showLoader() {
  document.getElementById('loader').classList.remove('hidden')
}
function hideLoader() {
  document.getElementById('loader').classList.add('hidden')
}

function successToast(msg) {
  Toastify({
      gravity: "bottom", // `top` or `bottom`
      position: "center", // `left`, `center` or `right`
      text: msg,
      className: "mb-5",
      style: {
          background: "green",
      }
  }).showToast();
}

function errorToast(msg) {
  Toastify({
      gravity: "bottom", // `top` or `bottom`
      position: "center", // `left`, `center` or `right`
      text: msg,
      className: "mb-5",
      style: {
          background: "red",
      }
  }).showToast();
}

function setToken(token){
  localStorage.setItem("token",`Bearer ${token}`)
}

function getToken(){
  return  localStorage.getItem("token")
}


function HeaderToken(){
  let token=getToken();
  return  {
       headers: {
           Authorization:token
       }
   }
}

function HeaderTokenWithBlob(){
   let token=getToken();
   return  {
       responseType: 'blob',
       headers: {
           Authorization:token
       }
   }
}


function loadContent(url) {
  // Make an Ajax request to the specified URL
  $.ajax({
      url: url,
      type: 'GET',
      success: function(response) {
          // Update the content of a specific div with the response data
          $('#content').html(response);
      },
      error: function() {
          // Handle any errors that may occur during the Ajax request
          console.error('Error loading content');
      }
  });
}
