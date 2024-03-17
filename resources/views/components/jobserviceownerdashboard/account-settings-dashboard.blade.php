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
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-8">
            <h2 class="text-3xl font-semibold">Admin Dashboard</h2>
            <hr>
        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl font-semibold">Account Settings</h3>
        </div>

        <form id="changePassId">
            <div class="flex justify-center items-center flex-col mb-3">
                <label for="changePassword" class="block mb-2 text-sm font-medium">Change Password</label>
                <input type="password" id="changePassword" name="changePassword"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter Your New Password (min 6 character)" />
            </div>
            <div class="flex justify-center items-center flex-col mb-3">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium">Confirm Change
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Confirm Password" />
            </div>
          </form>

          <div class="flex justify-center gap-x-3">
              <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                  id="savePasswordBtn">Save</button>
          </div>



    </div>
</div>

<script>
    const changePassword = document.getElementById('changePassword');
    const password_confirmation = document.getElementById('password_confirmation');
    const savePasswordBtn = document.getElementById('savePasswordBtn');

    savePasswordBtn.addEventListener('click', () => {
        changeAccountPassword();
        document.getElementById('changePassId').reset();
    });

    async function changeAccountPassword() {
        showLoader()
        let res = await axios.post('/dashboard/admin/accountSettings', {
            password: changePassword.value,
            password_confirmation:password_confirmation.value
        });
        hideLoader();
        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
    }
</script>
