<section class="bg-[#CDE9F9] shadow-navShadow">

    <div class="container">
        <nav class="bg-transparent">
            <div class=" flex flex-wrap items-center justify-between mx-auto p-4">
                <div>
                    <a onclick="homeLink(event)" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="" class="max-w-14 object-fill text-white" alt="jobpulseLogo"
                            id="jobPulseLogo"/>
                        <span class="self-center text-3xl font-bold
                            whitespace-nowrap text-orange-600" id="logoTitle"></span>
                    </a>
                </div>


                <div class="flex items-center justify-between hiddnen w-full md:flex md:w-auto md:order-1"
                    id="navbar-user">
                    <ul
                        class="flex flex-col font-medium text-lg p-4 md:p-0 mt-4 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 mr-8">
                        <li>
                            <a onclick="homeLink(event)"
                                class="block py-0 px-3 rounded md:p-0 md:hover:text-blue-700 md:bg-transparent cursor-pointer"
                                id="home">Home</a>
                        </li>
                        <li>
                            <a onclick="allJobLink(event)"
                                class="block py-0 px-3 rounded md:p-0 md:hover:text-blue-700 cursor-pointer"
                                id="jobs">Jobs</a>
                        </li>
                        <li>
                            <a onclick="allBlogsLink(event)"
                                class="block py-0 px-3 text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 cursor-pointer">Blogs</a>
                        </li>
                        <li>
                            <a onclick="contactLink(event)"
                                class="block py-0 px-3 text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 cursor-pointer">Contact</a>
                        </li>
                        <li>
                            <a onclick="aboutLink(event)"
                                class="block py-0 px-3 text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 cursor-pointer">About</a>
                        </li>
                    </ul>
                    <div class="flex gap-x-3 relative z-50">

                        <button
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button" id="signInBtn" data-dropdown-toggle="signInModal">
                            Sign In
                        </button>


                        <button
                            class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            data-dropdown-toggle="signUpModal" id="signUpBtn">Create
                            Account</button>

                        <div class="signInModal hidden absolute top-11 rounded-lg" id="signInModal">
                            <div class="w-full h-28 p-3 bg-zinc-50 rounded-lg text-center">
                                <a href="{{ route('employer.login') }}"
                                    class="block border-2 hover:bg-amber-300 py-1 px-4 text-base font-medium rounded-lg mb-3">Employer
                                    Login </a>
                                <a href="{{ route('candidate.login') }}"
                                    class="block border-2 hover:bg-teal-500 py-1 px-4 text-base font-medium rounded-lg">Candidate
                                    Login</a>
                            </div>
                        </div>
                        <div class="signUpModal hidden absolute top-11 rounded-lg" id="signUpModal">
                            <div class="w-full h-28 p-3 bg-zinc-50 rounded-lg text-center">
                                <a href="{{ route('employer.register') }}"
                                    class="block border-2 hover:bg-amber-300 py-1 px-5 text-base font-medium rounded-lg mb-3">Employer
                                    SignUp</a>
                                <a href="{{ route('candidate.register') }}"
                                    class="block border-2 hover:bg-teal-500 py-1 px-5 text-base font-medium rounded-lg">Candidate
                                    SignUp</a>
                            </div>
                        </div>
                    </div>



                    <div class="avatar hidden" id="avatar1">
                        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                            <button type="button"
                                class="flex text-sm rounded-full md:me-0"
                                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                                data-dropdown-placement="bottom">
                                <span class="sr-only">Open user menu</span>
                                <i class="fa-solid fa-bars text-2xl"></i>

                            </button>
                            <!-- Dropdown menu -->
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                                id="user-dropdown">
                                <div class="px-4 py-3">
                                    <span class="block text-sm text-gray-900 dark:text-white"></span>
                                    <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400"
                                        id="uemail"></span>

                                </div>
                                <ul class="py-2" aria-labelledby="user-menu-button">
                                    <li>
                                        <a onclick="dashboardProcess(event)"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white cursor-pointer">Dashboard</a>
                                    </li>
                                    <li>
                                        <a onclick="accountSettings(event)"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                                    </li>

                                    <li>
                                        <a onclick="logout()" href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                            out</a>
                                    </li>
                                </ul>
                            </div>
                            <button data-collapse-toggle="navbar-user" type="button"
                                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                aria-controls="navbar-user" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 17 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>

            </div>

        </nav>

    </div>

</section>


<script>
    async function getHomePageDetails() {

        let res = await axios.get('/dashboard/admin/homePageDetail');

        res.data.map(item => {

            document.getElementById('jobPulseLogo').src = item.logo_image_url;
            document.getElementById('logoTitle').innerText = item.logo_title;
        })
    }

    getHomePageDetails();





    window.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('token');

        if (token) {

            avatar1.classList.remove('hidden');
            document.getElementById('signInBtn').classList.add('hidden');
            document.getElementById('signUpBtn').classList.add('hidden');
        }
    });


    const userEmail = document.getElementById('uemail');
    userEmail.innerText = localStorage.getItem('email')




    function homeLink(event) {
        event.preventDefault();
        location.href = '/'

    }

    function allJobLink(event) {
        event.preventDefault();
        location.href = '/allJobs'

    }

    function allBlogsLink(event) {
        event.preventDefault();
        location.href = '/blog'

    }

    function contactLink(event) {
        event.preventDefault();
        location.href = '/contact'

    }

    function aboutLink(event) {
        event.preventDefault();
        location.href = '/about'

    }
    function accountSettings(event) {
        event.preventDefault();
        location.href = '/dashboard/candidate/accountSettings'

    }

    async function dashboardProcess(event) {

        let res1 = await axios.get('/allEmployer');
        let res2 = await axios.get('/allCandidate');
       
        switch (res1.data) {
            case 1:
            location.href = '/dashboard/employer/status'
                break;
        
            default:
                break;
        }
        
        switch (res2.data) {
            case 1:
            location.href = '/dashboard/candidate'
                break;
        
            default:
                break;
        }



    }


    async function logout() {

        location.href = '/logout';
        localStorage.clear();
        sessionStorage.clear();

        avatar1.classList.add('hidden');
        signInBtn.classList.remove('hidden');
        signUpBtn.classList.remove('hidden');
        successToast('Successfully Logout');

    }
</script>
