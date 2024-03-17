<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>

<body>
    <div id="loader" class="LoadingOverlay hidden">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>
</body>

</html>


<div class="p-4 sm:ml-64 bg-slate-100">
    <div class="p-4 border-2 border-blue-400 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-8 border-b border-blue-500">
            <h2 class="text-3xl font-semibold">Candidate Dashboard</h2>

        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl text-red-900 font-semibold">Candidate Account Settings</h3>
        </div>
        <div class="mb-11 flex justify-center flex-col items-center">
            <div class="rounded-full w-40 h-32 mb-3">                
                <img src="" alt="noPhoto" id="candidate_photo" class="h-full rounded-lg">
                              
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-center" for="candidate_image">Upload Photo</label>
              <input
                  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                  id="candidate_image" type="file"
                  oninput="candidate_photo.src=window.URL.createObjectURL(this.files[0])">
              </div>
              

        </div>
        <div class="mb-8">
            <label for="candidateFirstName" class="mr-8">First Name: </label>
            <input type="text" id="candidateFirstName" name="candidateFirstName"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

        </div>
        <div class="mb-8">
            <label for="candidateLastName" class="mr-8">Last Name: </label>
            <input type="text" id="candidateLastName" name="candidateLastName"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

        </div>
        <div class="mb-8">
            <label for="candidateEmail" class="mr-8">Email: </label>
            <input type="text" id="candidateEmail" name="candidateEmail"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly />

        </div>
        <div class="mb-8">
            <label for="candidateCurrentPass" class="mr-8">Current Password: </label>
            <input type="password" id="candidateCurrentPass" name="candidateCurrentPass"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

        </div>
        <div class="mb-8">
            <label for="candidateNewPass" class="mr-8">New Password: </label>
            <input type="password" id="candidateNewPass" name="candidateNewPass"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

        </div>
        <div class="mb-8">
            <label for="candidateConfirmPass" class="mr-8">Confirm Password: </label>
            <input type="password" id="candidateConfirmPass" name="candidateConfirmPass"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

        </div>

        <div class="flex justify-center">
          <button class="bg-blue-700 hover:bg-blue-500 py-2 px-4 text-base text-white font-medium rounded-lg"
          id="saveaccountBtn">Save</button>
        </div>

    </div>
</div>


<script>

 

  async function getProfileData() {
    let res = await axios.get('/dashboard/candidate/profileDetails');
    
    
    let imageFilepath = '';   

    imageFilepath = res.data.image_url;
    document.getElementById('candidate_photo').src = `{{asset('${res.data.image_url}')}}`;
    document.getElementById('candidateFirstName').value = res.data.firstname;
    document.getElementById('candidateLastName').value = res.data.lastname;
    document.getElementById('candidateEmail').value = res.data.email; 
   


    document.getElementById('saveaccountBtn').addEventListener('click',()=>{

    const firstname = document.getElementById('candidateFirstName').value;
    const lastname = document.getElementById('candidateLastName').value;
    const candidateCurrentPass = document.getElementById('candidateCurrentPass').value;
    const candidateNewPass = document.getElementById('candidateNewPass').value;
    const candidateConfirmPass = document.getElementById('candidateConfirmPass').value;
    const candidate_image = document.getElementById('candidate_image').files[0];

    const formData = new FormData();
    formData.append('firstname',firstname);
    formData.append('lastname',lastname);
    formData.append('current_password',candidateCurrentPass);
    formData.append('password',candidateNewPass);
    formData.append('password_confirmation',candidateConfirmPass);
    formData.append('image',candidate_image);
    formData.append('file_path',imageFilepath);

    updateAccountSettings(formData)

  })
    
  }
  getProfileData();





  async function updateAccountSettings(formData) {
    showLoader();
    let res = await axios.post('/dashboard/candidate/updateprofileDetails',formData);
    hideLoader()
    
    if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
        
  }
</script>
