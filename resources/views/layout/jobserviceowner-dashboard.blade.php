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
                <a href="{{ url('/dashboard/status') }}" class="flex ms-2 md:me-24">
                    <img src="" class="w-8 h-8 me-3" alt="business-model-icon.png" id="dashboardLogo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"
                        id="dashboardTitle"></span>
                </a>
            </div>


            <div>
                <button type="button" class="flex text-sm rounded-full" aria-expanded="false"
                    data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <div class="flex justify-center items-center flex-col">
                        <span id="uName" class="mr-3 text-lg font-medium"></span>
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
    class="absolute top-0 left-0 z-30 w-64 h-screen pt-20 transition-transform -translate-x-full bg-red-100 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-red-100 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li id='dashboard'>
                <a onclick="statusLink(event)"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <span><i class="fa-solid fa-chart-pie" style="color: #727883;"></i></span>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <li id='companies'>
                <a onclick="allCompaniesLink(event)"
                    class="flex items-center justify-between p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <div>
                        <span><i class="fa-solid fa-building-columns" style="color: #727883;"></i></span>
                        <span class="ms-3">Companies</span>
                    </div>
                    <div>
                        <span class="text-sm">New</span>
                        <span
                            class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white bg-green-600 rounded-full dark:bg-blue-900 dark:text-blue-300"
                            id="newCompanies">0</span>
                    </div>
                </a>
            </li>
            <li id='jobs'>
                <a onclick="allJobs(event)"
                    class="flex items-center justify-between p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <div>
                        <span><i class="fa-solid fa-briefcase" style="color: #727883;"></i></span>
                        <span class="ms-3">Jobs</span>
                    </div>
                    <div>
                        <span class="text-sm">New</span>
                        <span
                            class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white bg-green-600 rounded-full dark:bg-blue-900 dark:text-blue-300"
                            id="newJobs">0</span>
                    </div>
                </a>
            </li>
            <li>
                <a onclick="allEmployee(event)"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <span><i class="fa-solid fa-users" style="color: #727883;"></i></span>
                    <span class="flex-1 ms-3 whitespace-nowrap">Employee</span>
                </a>
            </li>

            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-blogs" data-collapse-toggle="dropdown-blogs">
                    <span><i class="fa-solid fa-blog" style="color: #727883;"></i></span>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Blogs</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-blogs" class="hidden py-2 space-y-2">
                    <li>
                        <a onclick="blogCategory(event)"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 cursor-pointer">-Blog
                            Category</a>
                    </li>
                    <li>
                        <a onclick="blogPosts(event)"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 cursor-pointer">-Blog
                            Posts</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                    <span><i class="fa-regular fa-file" style="color: #727883;"></i></span>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Pages</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                    <li>
                        <a onclick="home(event)"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 cursor-pointer">-Home</a>
                    </li>
                    <li>
                        <a onclick="blog(event)"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 cursor-pointer">-Blog</a>
                    </li>
                    <li>
                        <a onclick="contact(event)"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 cursor-pointer">-Contact</a>
                    </li>
                    <li>
                        <a onclick="about(event)"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 cursor-pointer">-About</a>
                    </li>
                </ul>
            </li>
            <li>
                <a onclick="plugin(event)"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group cursor-pointer">
                    <span><i class="fa-solid fa-wrench" style="color: #727883;"></i></span>
                    <span class="flex-1 ms-3 whitespace-nowrap">Plugins</span>
                </a>
            </li>


        </ul>
    </div>
</aside>




<script>

    async function getHomePageDetails() {

        let res = await axios.get('/dashboard/admin/homePageDetail');

        res.data.map(item => {

            document.getElementById('dashboardLogo').src = `{{asset('${item.logo_image_url}')}}`;
            document.getElementById('dashboardTitle').innerText = item.logo_title;
        })
    }

    getHomePageDetails();






    const userEmail = document.getElementById('usermail')
    userEmail.innerText = localStorage.getItem('userEmail');
    const uName = document.getElementById('uName')
    uName.innerText = localStorage.getItem('userName');
    const userName = document.getElementById('userName')
    userName.innerText = localStorage.getItem('userName');

    localStorage.getItem('userName');

    const logout = document.getElementById('logout');

    logout.addEventListener('click', () => {
        localStorage.clear();
        window.location.href = '/jobserviceOwner/logout';
    })

    const newCompanies = document.getElementById('newCompanies');
    const newJobs = document.getElementById('newJobs');

    async function getnewCompanyCount() {
        let res = await axios.get('/dashboard/admin/newCompanyCount');
        newCompanies.innerText = res.data;
    }

    async function getnewJobCount() {
        let res = await axios.get('/dashboard/admin/newJobsCount');
        newJobs.innerText = res.data;
    }

    window.addEventListener('DOMContentLoaded', () => {
        getnewCompanyCount();
        getnewJobCount();

    })



    function statusLink(event) {
        event.preventDefault();

        location.href = '/dashboard/status'

    }

    function allCompaniesLink(event) {
        event.preventDefault();

        location.href = '/dashboard/allcompanies'


    }

    function allJobs(event) {
        event.preventDefault();

        location.href = '/dashboard/alljobs'

    }

    function allEmployee(event) {
        event.preventDefault();

        location.href = '/dashboard/allEmployee'

    }

    function blogCategory(event) {
        event.preventDefault();

        location.href = '/dashboard/blogCategory'

    }

    function blogPosts(event) {
        event.preventDefault();

        location.href = '/dashboard/blogPost'

    }

    function home(event) {
        event.preventDefault();

        location.href = '/dashboard/webPages/home'

    }

    function blog(event) {
        event.preventDefault();

        location.href = '/dashboard/webPages/blog'

    }

    function contact(event) {
        event.preventDefault();

        location.href = '/dashboard/webPages/contact'

    }

    function about(event) {
        event.preventDefault();

        location.href = '/dashboard/webPages/about'

    }

    function plugin(event) {
        event.preventDefault();

        location.href = '/dashboard/plugins'

    }


    function accountSetting(event) {
        event.preventDefault();

        location.href = '/dashboard/accountSettings'
    }
</script>
