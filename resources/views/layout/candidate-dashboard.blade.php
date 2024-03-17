@extends('layout.app')
<script src="{{ asset('js/axios.min.js') }}"></script>

<nav class="absolute top-0 z-40 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ url('/dashboard/candidate/status') }}" class="flex ms-2 md:me-24">
                    <img src="" class="w-8 h-8 me-3"
                        alt="business-model-icon.png" id="dashboardLogo"/>
                    <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white" id="dashboardTitle"></span>
                </a>
            </div>


            <div>
                <button type="button" class="flex text-sm rounded-full" aria-expanded="false"
                    data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <div class="flex justify-center items-center flex-col">
                        <span id="uName" class="pt-2 mr-1 font-medium"></span>
                    </div>
                    <span><i class="fa-solid fa-bars text-3xl mr-1" style="color: #727883;"></i></span>
                </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="dropdown-user">
                <div class="px-4 py-3" role="none">
                    <p class="text-sm text-gray-900 dark:text-white" role="none" id="userName">
                    </p>
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none"
                        id="usermail">
                    </p>
                </div>
                <ul class="py-1" role="none">

                    <li>
                        <a onclick="accountSetting(event)"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Settings</a>
                    </li>

                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem" id="logout">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="absolute top-0 left-0 z-30 w-64 h-screen pt-20 bg-blue-200 transition-transform -translate-x-full border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 "
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto dark:bg-gray-800 bg-blue-200">
        <ul class="space-y-2 font-medium">
            <li id='dashboard'>
                <a onclick="statusAll(event)"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <span><i class="fa-solid fa-chart-pie" style="color: #727883;"></i></span>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>


            <li id='jobs'>
                <a onclick="allJobs(event)"
                    class="flex items-center justify-between p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <div>
                        <span><i class="fa-solid fa-briefcase" style="color: #727883;"></i></span>
                        <span class="ms-3">Jobs</span>
                    </div>

                </a>
            </li>

            <li>
                <a onclick="profiles(event)"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <span><i class="fa-solid fa-user" style="color: #727883;"></i></span>
                    <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
                </a>
            </li>


        </ul>
    </div>
</aside>

<script>

    async function getHomePageDetails() {

        let res = await axios.get('/dashboard/admin/homePageDetail');

        res.data.map(item => {

            document.getElementById('dashboardLogo').src = `{{ asset('${item.logo_image_url}') }}`;
            document.getElementById('dashboardTitle').innerText = item.logo_title;
        })
    }

    getHomePageDetails();

    function statusAll(event) {
        event.preventDefault();
        location.href = '/dashboard/candidate/status'

    }

    function allJobs(event) {
        event.preventDefault();
        location.href = '/dashboard/candidate/jobs'

    }

    function profiles(event) {
        event.preventDefault();
        location.href = '/dashboard/candidate/profile'

    }
    function accountSetting(event) {
        event.preventDefault();
        location.href = '/dashboard/candidate/accountSettings'

    }

    document.getElementById('usermail').innerText = localStorage.getItem('email');




    const logout = document.getElementById('logout');

    logout.addEventListener('click', () => {
        localStorage.clear();
        location.href = '/logout'
    })
</script>
