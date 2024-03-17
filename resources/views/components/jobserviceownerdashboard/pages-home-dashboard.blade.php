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
<div class="p-4 sm:ml-64 bg-red-50">
    <div class="p-4 border-2 border-red-500 border-dashed rounded-lg dark:border-gray-700 mt-14 overflow-hidden">
        <div class="mb-8 border-b border-red-500">
            <h2 class="text-3xl font-semibold">Admin Dashboard</h2>
            
        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl text-blue-800 font-semibold">Home Page</h3>
        </div>

        <div class="bg-slate-400 py-3 h-[430px] rounded-lg overflow-scroll">
            <form id="homepageDetailForm">
                <div class="mb-6 w-1/2 mx-auto">
                    <label for="logoTitle" class="block mb-2 text-sm font-medium text-white">Logo Title</label>
                    <input type="text" id="logoTitle" name="logoTitle"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter title for Logo" />
                </div>
                <div class="mb-6 w-1/2 mx-auto">
                    <label for="heroTitle" class="block mb-2 text-sm font-medium text-white">Hero Title</label>
                    <input type="text" id="heroTitle" name="heroTitle"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter title for Hero" />
                </div>
                <div class="mb-6 w-1/2 mx-auto">
                    <label for="heroContent" class="block mb-2 text-sm font-medium text-white">Hero
                        Content</label>
                    <textarea id="heroContent" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your hero details here..."></textarea>

                </div>

                <div class="mb-6 w-[100px] h-[100px] mx-auto rounded-lg overflow-hidden"><img
                        src="{{ asset('image-regular.svg') }}" id="oldImgLogo" alt="image-regular.svg"
                        class="object-scale-down w-full h-full"></div>
                <div class="mb-6 w-1/2 mx-auto">
                    <label class="block mb-2 text-sm font-medium text-white" for="logo_image">Upload
                        image for Logo</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="logo_image" type="file"
                        oninput="oldImgLogo.src=window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="mb-6 w-[300px] h-[300px] mx-auto rounded-lg overflow-hidden"><img
                        src="{{ asset('image-regular.svg') }}" id="oldImgHero" alt="image-regular.svg"
                        class="object-scale-down w-full h-full"></div>
                <div class="mb-6 w-1/2 mx-auto">
                    <label class="block mb-2 text-sm font-medium text-white" for="hero_image">Upload
                        image for Hero Section</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="hero_image" type="file"
                        oninput="oldImgHero.src=window.URL.createObjectURL(this.files[0])">
                </div>

            </form>
            <div class="flex justify-center gap-x-3">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    id="saveHomeDetailBtn">Save</button>
            </div>

        </div>

    </div>
</div>




<script>
    const saveHomeDetailBtn = document.getElementById('saveHomeDetailBtn');

    let logo_url_forUpdate = '';
    let hero_url_forUpdate = '';
    let id_forUpdate = '';


    saveHomeDetailBtn.addEventListener('click', async () => {

        const logoTitle = document.getElementById('logoTitle').value;
        const heroTitle = document.getElementById('heroTitle').value;
        const heroContent = document.getElementById('heroContent').value;
        const logo_image = document.getElementById('logo_image').files[0];
        const hero_image = document.getElementById('hero_image').files[0];

        const formData = new FormData();
        formData.append('id', id_forUpdate);
        formData.append('logo_title', logoTitle);
        formData.append('hero_title', heroTitle);
        formData.append('hero_details', heroContent);
        formData.append('logo_image', logo_image);
        formData.append('hero_image', hero_image);
        formData.append('logo_file_path', logo_url_forUpdate);
        formData.append('hero_file_path', hero_url_forUpdate);
      

        updateHomeDetail(formData);


    })



    async function updateHomeDetail(formData) {
        showLoader();
        let res = await axios.post('/dashboard/admin/updateHomePage', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
        })

        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
        getHomePageDetails();
    }

    async function getHomePageDetails() {
        let res = await axios.get('/dashboard/admin/homePageDetail');

        let oldImgLogo = document.getElementById('oldImgLogo');
        let oldImgHero = document.getElementById('oldImgHero');

        res.data.map(item => {
            id_forUpdate = item.id;
            logoTitle.value = item.logo_title;
            heroTitle.value = item.hero_title;
            heroContent.value = item.hero_details;
            logo_url_forUpdate = item.logo_image_url;
            hero_url_forUpdate = item.hero_image_url;
            
            if (item.logo_image_url || item.hero_image_url) {

                oldImgLogo.src = `{{ asset('${item.logo_image_url}') }}`
                oldImgHero.src = `{{ asset('${item.hero_image_url}') }}`
            } else {
                oldImgLogo.src = `{{ asset('image-regular.svg') }}`
                oldImgHero.src = `{{ asset('image-regular.svg') }}`

            }

        })
    }

    getHomePageDetails();



</script>
