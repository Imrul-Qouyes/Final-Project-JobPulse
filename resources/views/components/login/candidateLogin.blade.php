<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candidate Login</title>
</head>
<body>
    
</body>
</html>
<section>
    <div class="container">
        <div class="flex justify-center p-14">
            <div class="bg-gray-100 rounded-lg shadow dark:bg-gray-700 w-2/5">
                <div class="text-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Candidate Sign In
                    </h3>
                </div>

                <div class="p-4 ">
                    <form class="space-y-4" action="#">
                        <div>
                            <label for="candidateEmail"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="candidateEmail" id="candidateEmail"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="name@mail.com" />
                        </div>
                        <div>
                            <label for="candidatePassword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                password</label>
                            <input type="password" name="candidatePassword" id="candidatePassword" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        </div>
                        <div class="flex justify-end">
                            <a href="{{route('candidate.otp')}}" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Forget
                                Password?</a>
                        </div>
                        <div class="flex justify-center">
                            <button onclick="loginCandidate(event)"
                                class="w-1/2 text-white bg-emerald-800 hover:bg-blue-800  font-medium rounded-lg text-sm px-2 py-2.5 text-center">Candidate
                                Login</button>
                        </div>
                        <div class="flex justify-center">
                            <button type="button"
                                class="bg-amber-200 flex items-center hover:bg-slate-200 font-medium rounded-lg text-sm px-2 py-2.5 text-center me-2 mb-2">
                                <span><i class="fa-brands fa-google fa-beat-fade mr-3"></i></span> Sign in with Google
                            </button>
                        </div>
                        <div class="text-sm font-medium text-center text-gray-500 dark:text-gray-300">
                            Not registered? <a href="{{ route('candidate.register') }}"
                                class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                        </div>
                    </form>
                    <div class="flex justify-center mt-3">
                        <a href="{{ url('/') }}"
                            class="text-white bg-blue-700 text-sm font-medium py-1 px-3 rounded-lg">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<script>
    async function loginCandidate(event) {

        const candidateEmail = document.getElementById('candidateEmail').value;
        const candidatePassword = document.getElementById('candidatePassword').value;

        event.preventDefault();
        if (candidateEmail.length === 0) {
            errorToast('Email is Required!');
        } else if (candidatePassword.length === 0) {
            errorToast('Password is Required!');
        } else {
            showLoader();
            let res = await axios.post('/candidateLogin', {
                email: candidateEmail,
                password: candidatePassword
            })
            hideLoader();
                       

            if (res.status === 200 && res.data.status === 'success') {

                successToast('Login Success');

                setToken(res.data.token);
                const userEmail = res.data.user.email 
                localStorage.setItem('email',userEmail)

                location.href = '/';

            } else {
                errorToast("Invalid User or Password!")
            }
        }

    }
</script>
