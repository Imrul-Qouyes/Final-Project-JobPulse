<section>
    <div class="container">
        <div class="flex justify-center p-14">
            <div class="bg-gray-100 rounded-lg shadow dark:bg-gray-700 w-2/5">
                <div class="text-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        VERIFY OTP
                    </h3>
                </div>

                <div class="p-4 ">
                    <form class="space-y-4" action="#">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter Your
                                OTP</label>
                            <input type="text" name="email" id="OTP"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="OTP Code" />
                        </div>

                        <div class="flex justify-center">
                            <button onclick="verifyOTP(event)"
                                class="w-1/2 text-white bg-emerald-800 hover:bg-emerald-600  font-medium rounded-lg text-sm px-2 py-2.5 text-center">Verify</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</section>


<script>
    async function verifyOTP(event) {

        const OTP = document.getElementById('OTP');
        let postBody = {
            "email": sessionStorage.getItem("email"),
            "otp": document.getElementById('OTP').value
        }
        event.preventDefault();
        if(OTP.length === 0){
          errorToast('OTP is Required');
        }

        showLoader();
        let res = await axios.post("/employer/verifyOTP", postBody);
        hideLoader()

        if (res.status === 200 && res.data.status === 'success') {

            successToast(res.data.message);
            window.location.href = "/employer/resetPass";
        } else {
            errorToast(res.data.message);
        }
    }
</script>
