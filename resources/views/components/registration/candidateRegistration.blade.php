<div class="relative p-4 w-full max-w-md max-h-full mx-auto">
  <!-- Modal content -->
  <div class="relative bg-slate-200 rounded-lg shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div class="text-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Candidate Registration
          </h3>
          
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5">
          <form class="space-y-4" action="#">
            @csrf
              <div>
                  <label for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                  <input type="email" name="fname" id="fname"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="First Name" />
              </div>
              <div>
                  <label for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                  <input type="email" name="lname" id="lname"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="Last Name" />
              </div>
              <div>
                  <label for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                  <input type="email" name="email" id="email"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="name@mail.com" />
              </div>
              <div>
                  <label for="password"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                  <input type="password" name="password" id="password" placeholder="••••••••"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
              </div>
              <div>
                  <label for="password_confirmation"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                      password</label>
                  <input type="password" name="password_confirmation" placeholder="••••••••"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="password_confirmation" />
              </div>

              <button onclick="registerCandidate(event)"
                  class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                  your account</button>
              <div class="text-sm font-medium text-center text-gray-500 dark:text-gray-300">
                  Already Have Account? <a href="{{route('candidate.login')}}"
                      class="text-blue-700 hover:underline dark:text-blue-500">Sign In</a>
              </div>
          </form>
      </div>
  </div>
</div>


<script>
    async function registerCandidate(event) {

        const Fname = document.getElementById('fname').value;
        const Lname = document.getElementById('lname').value;
        const Email = document.getElementById('email').value;
        const Password = document.getElementById('password').value;
        const ConfirmPassword = document.getElementById('password_confirmation').value;

        event.preventDefault();
        if (Fname.length === 0) {
            errorToast('First Name is Required!');
        } else if (Lname.length === 0) {
            errorToast('Last Name is Required!');
        } else if (Email.length === 0) {
            errorToast('Email is Required!');
        } else if (Password.length === 0) {
            errorToast('Password is Required!');
        } else if (ConfirmPassword.length === 0) {
            errorToast('Confirm Password is Required!');
        } else {
            showLoader();
            let res = await axios.post('/candidateSignup', {
                firstname: Fname,
                lastname: Lname,
                email: Email,
                password: Password,
                password_confirmation:ConfirmPassword

            })
            hideLoader();
                       

            if (res.status === 200 && res.data.status === 'success') {

                successToast('Registration Complete');

                setToken(res.data.token);
                const userEmail = res.data.data.email 

                window.location.href = '/?email=' + userEmail;

            } else {
                errorToast(res.data.message)
            }
        }

    }
</script>