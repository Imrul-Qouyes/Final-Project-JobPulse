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
            <h3 class="text-xl font-semibold">Contact Page</h3>
        </div>

        <div class="py-4 text-left px-6 bg-slate-400 rounded-lg">
            <div>
                <form action="" id="createBlogPostForm">
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="contactTitle" class="block mb-2 text-sm font-medium text-white">Contact
                            Title</label>
                        <input type="text" id="contactTitle" name="contactTitle"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter title for Contact" />
                    </div>

                    <div class="mb-4 w-1/2 mx-auto">
                        <label for="contactAddress" class="block mb-2 text-sm font-medium text-white">Address</label>
                        <input type="text" id="contactAddress" name="contactAddress"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Address" />
                    </div>
                    <div class="mb-4 w-1/2 mx-auto">
                        <label for="contactPhone" class="block mb-2 text-sm font-medium text-white">Mobile</label>
                        <input type="text" id="contactPhone" name="contactPhone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Phone no" />
                    </div>
                    <div class="mb-4 w-1/2 mx-auto">
                        <label for="contactTele" class="block mb-2 text-sm font-medium text-white">Telephone</label>
                        <input type="text" id="contactTele" name="contactTele"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Telephone no" />
                    </div>
                    <div class="mb-4 w-1/2 mx-auto">
                        <label for="contactEmail" class="block mb-2 text-sm font-medium text-white">Email</label>
                        <input type="email" id="contactEmail" name="contactEmail"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Email" />
                    </div>
                    <div class="mb-6 w-[300px] h-[300px] mx-auto rounded-lg overflow-hidden"><img
                            src="{{ asset('image-regular.svg') }}" id="oldImgContact" alt="image-regular.svg"
                            class="object-scale-down w-full h-full"></div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-white" for="contact_image">Upload
                            image for Hero Section</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="contact_image" type="file"
                            oninput="oldImgHero.src=window.URL.createObjectURL(this.files[0])">
                    </div>

                </form>


                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="saveContactDetailBtn">Save</button>
                </div>

            </div>
        </div>

    </div>
</div>


<script>
    const contactTitle = document.getElementById('contactTitle');
    const contactAddress = document.getElementById('contactAddress');
    const contactPhone = document.getElementById('contactPhone');
    const contactTele = document.getElementById('contactTele');
    const contactEmail = document.getElementById('contactEmail');
    const oldImgContact = document.getElementById('oldImgContact');
    const contact_image = document.getElementById('contact_image');
    const saveContactDetailBtn = document.getElementById('saveContactDetailBtn');

    let idForContactTitleUpdate = '';
    let urlForContactBannerUpdate = '';

    async function getContactPageDetails() {
        showLoader();
        let res = await axios.get('/dashboard/admin/contactUsPageDetail');
        
        res.data.map(contact=>{

            contactTitle.value = contact.contact_title
            contactAddress.value = contact.address
            contactPhone.value = contact.phone
            contactTele.value = contact.telephone
            contactEmail.value = contact.email
            idForContactTitleUpdate = contact.id;
            urlForContactBannerUpdate = contact.image_url

            if(contact.image_url){

                oldImgContact.src = `{{ asset('${contact.image_url}') }}`;

            }else {

                oldImgContact.src = `{{ asset('image-regular.svg') }}`;

            }

        })
        hideLoader();
    }

    getContactPageDetails();


    saveContactDetailBtn.addEventListener('click',()=>{

        const formData = new FormData();
        formData.append('id', idForContactTitleUpdate);
        formData.append('contact_title', contactTitle.value);
        formData.append('address', contactAddress.value);
        formData.append('phone', contactPhone.value);
        formData.append('telephone', contactTele.value);
        formData.append('email', contactEmail.value);
        formData.append('contact_banner_image', contact_image.files[0]);
        formData.append('contact_banner_image_file_path', urlForContactBannerUpdate);
        updateContactPageDetail(formData);

    })

    async function updateContactPageDetail(formData) {
        showLoader();
        let res = await axios.post('/dashboard/admin/contactUsPageDetailUpdate',formData,{
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
        getContactPageDetails();
    }
</script>
