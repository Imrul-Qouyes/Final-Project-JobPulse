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
    <div class="p-4 border-2 border-red-500 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-8 border-b border-red-500">
            <h2 class="text-3xl font-semibold">Admin Dashboard</h2>
            
        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl font-semibold">About Page</h3>
        </div>

        <div class="py-4 text-left px-6 bg-slate-400 rounded-lg">
            <div>
                <form>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="aboutTitle" class="block mb-2 text-sm font-medium text-white">About Us Title</label>
                        <input type="text" id="aboutTitle" name="aboutTitle"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>

                    <div class="mb-4 w-1/2 mx-auto">
                        <label for="aboutUsDescription" class="block mb-2 text-sm font-medium text-white">About Us
                            Description</label>
                        <textarea id="aboutUsDescription" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

                    </div>
                    <div class="mb-4 w-1/2 mx-auto">
                        <label for="companyHistory" class="block mb-2 text-sm font-medium text-white">Company
                            History</label>
                        <textarea id="companyHistory" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

                    </div>
                    <div class="mb-4 w-1/2 mx-auto">
                        <label for="companyVision" class="block mb-2 text-sm font-medium text-white">Company
                            Vision</label>
                        <textarea id="companyVision" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

                    </div>
                    <div class="mb-4 w-[300px] h-[300px] mx-auto rounded-lg"><img src="{{ asset('image-regular.svg') }}"
                            id="oldImgAboutus" alt="image-regular.svg" class="object-scale-down w-full h-full"></div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-white" for="aboutus_image">Upload
                            image for About us</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="aboutus_image" type="file"
                            oninput="oldImgAboutus.src=window.URL.createObjectURL(this.files[0])">
                    </div>

                </form>


                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="saveAboutUsDetailBtn">Save</button>
                </div>

            </div>
        </div>

    </div>
</div>


<script>
    const aboutTitle = document.getElementById('aboutTitle');
    const aboutUsDescription = document.getElementById('aboutUsDescription');
    const companyHistory = document.getElementById('companyHistory');
    const companyVision = document.getElementById('companyVision');
    const oldImgAboutus = document.getElementById('oldImgAboutus');
    const aboutus_image = document.getElementById('aboutus_image');


    let aboutPageIdForUpdate = '';
    let aboutImg_url_forUpdate = '';

    async function getAboutUsPageDetails() {

        let res = await axios.get('/dashboard/admin/aboutUsPageDetail');

        res.data.map(about => {

            aboutPageIdForUpdate = about.id;
            aboutTitle.value = about.title;
            aboutUsDescription.value = about.company_mission;
            companyHistory.value = about.company_history;
            companyVision.value = about.company_vision;
            aboutImg_url_forUpdate = about.image_url;

            if (about.image_url) {
                oldImgAboutus.src = `{{ asset('${about.image_url}') }}`
            } else {
                oldImgAboutus.src = "{{ asset('image-regular.svg') }}"
            }
        })
    }

    getAboutUsPageDetails();



    saveAboutUsDetailBtn.addEventListener('click', () => {
        const formData = new FormData();
        formData.append('id', aboutPageIdForUpdate);
        formData.append('title', aboutTitle.value);
        formData.append('company_mission', aboutUsDescription.value);
        formData.append('company_history', companyHistory.value);
        formData.append('company_vision', companyVision.value);
        formData.append('aboutus_image', aboutus_image.files[0]);
        formData.append('aboutus_file_path', aboutImg_url_forUpdate);

        updateAboutUsPageDetails(formData)
    })


    async function updateAboutUsPageDetails(formData) {

        showLoader();
        let res = await axios.post('/dashboard/admin/aboutUsPageDetailUpdate', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
        });
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
        getAboutUsPageDetails();
    }
</script>
