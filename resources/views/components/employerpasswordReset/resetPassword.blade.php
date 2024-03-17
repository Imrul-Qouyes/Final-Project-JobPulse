<section>
    <div class="container">
        <div class="flex justify-center p-14">
            <div class="bg-gray-100 rounded-lg shadow dark:bg-gray-700 w-2/5">
                <div class="text-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        SET NEW PASSWORD
                    </h3>
                </div>

                <div class="p-4 ">
                    <form class="space-y-4" action="#">
                        <div>
                            <label for="newpassword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Passord</label>
                            <input type="password" name="newpassword" id="newpassword"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Password" />
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Confirm Password" />
                        </div>

                        <div class="flex justify-center">
                            <button onclick="resetPass(event)"
                                class="w-1/2 text-white bg-emerald-800 hover:bg-emerald-600  font-medium rounded-lg text-sm px-2 py-2.5 text-center">Reset
                                Password</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</section>


<script>
    async function resetPass(event) {

        const newPassword = document.getElementById('newpassword').value;
        const confirmNewPassword = document.getElementById('password_confirmation').value;
        let postBody = {
            "password": newPassword,
            "password_confirmation": confirmNewPassword
        }

        event.preventDefault();
        if (newPassword.length === 0) {
            errorToast("New Password is required");
        } else if (confirmNewPassword.length === 0) {
            errorToast("Confirm Password is required");
        } else {
            showLoader();
            let res = await axios.post("/employer/resetPassword", postBody);
            hideLoader()
            
            if (res.status === 200 && res.data.status === 'success') {
                setToken(res.data.token);
                successToast(res.data.message);
                window.location.href = "/?email="+ res.data.email;
            } else {
                errorToast(res.data.message);
            }
        }


    }
</script>
