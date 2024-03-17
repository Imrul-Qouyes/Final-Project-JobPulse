<section>
  <div class="container">
      <div class="flex justify-center p-14">
          <div class="bg-gray-100 rounded-lg shadow dark:bg-gray-700 w-2/5">
              <div class="text-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      EMAIL ADDRESS
                  </h3>
              </div>

              <div class="p-4 ">
                  <form class="space-y-4" action="#">
                      <div>
                          <label for="email"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                          <input type="email" name="email" id="employerEmail"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                              placeholder="name@mail.com" />
                      </div>

                      <div class="flex justify-center">
                          <button  onclick="sendOTP(event)"
                              class="w-1/2 text-white bg-red-900 hover:bg-red-500  font-medium rounded-lg text-sm px-2 py-2.5 text-center">SEND OTP</button>
                      </div>                      
                      
                  </form>
                  
              </div>
          </div>
      </div>

  </div>
</section>


<script>

  async function sendOTP(event){
    const employerEmail = document.getElementById('employerEmail').value;
    event.preventDefault();
    if(employerEmail.length === 0){
      errorToast('Email is required');
    } else {
      showLoader();
      let res = await axios.post('/employer/sendOTP',{
        email:employerEmail
      });
      hideLoader();

      if (res.status === 200 && res.data.status === 'success') {
        sessionStorage.setItem('email',employerEmail);
        successToast(res.data.message);
        window.location.href='/employer/OTPVerify';
      }else{
        errorToast(res.data.message);
      }
    }

  }
</script>