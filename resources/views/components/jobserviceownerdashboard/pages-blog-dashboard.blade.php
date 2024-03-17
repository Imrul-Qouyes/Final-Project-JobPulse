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
            <hr>
        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl font-semibold">Blogs Page</h3>
        </div>

        <div class="py-4 text-left px-6 bg-slate-400 rounded-lg">
            <div>
                <form action="" id="createBlogPostForm">
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="blogTitle" class="block mb-2 text-sm font-medium text-white">Blog Title</label>
                        <input type="text" id="blogTitle" name="blogTitle"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter title for Blogs" />
                    </div>
                    <div class="mb-6 w-[300px] h-[300px] mx-auto rounded-lg overflow-hidden"><img
                            src="{{ asset('image-regular.svg') }}" id="oldImgBannerblog" alt="image-regular.svg"
                            class="object-scale-down w-full h-full"></div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-white" for="blog_banner_image">Upload
                            image for Blog Banner</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="blog_banner_image" type="file"
                            oninput="oldImgBannerblog.src=window.URL.createObjectURL(this.files[0])">
                    </div>
                </form>


                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="saveBlogPageDetailBtn">Save</button>
                </div>

            </div>
        </div>

    </div>
</div>


<script>

    const blogTitle = document.getElementById('blogTitle');
    const oldImgBannerblog = document.getElementById('oldImgBannerblog');
    const blog_banner_image = document.getElementById('blog_banner_image');
    const saveBlogPageDetailBtn = document.getElementById('saveBlogPageDetailBtn');

    let idForBlogTitleUpdate = '';
    let urlForBlogBannerUpdate = '';

    async function getBlogPageDetails() {
        showLoader();
        let res = await axios.get('/dashboard/admin/blogPageDetail');
        
        res.data.map(blog=>{

            blogTitle.value = blog.blog_title
            idForBlogTitleUpdate = blog.id;
            urlForBlogBannerUpdate = blog.blog_banner_url

            if(blog.blog_banner_url){

                oldImgBannerblog.src = `{{asset('${blog.blog_banner_url}')}}`;

            }else {

                oldImgBannerblog.src = `{{ asset('image-regular.svg') }}`;

            }
            
        })
        hideLoader();
    }

    getBlogPageDetails();
    

    saveBlogPageDetailBtn.addEventListener('click',()=>{

        const formData = new FormData();
        formData.append('id', idForBlogTitleUpdate);
        formData.append('blog_title', blogTitle.value);
        formData.append('blog_banner_image', blog_banner_image.files[0]);
        formData.append('blog_banner_image_file_path', urlForBlogBannerUpdate);
        updateBlogPageDetail(formData);
        
    })

    async function updateBlogPageDetail(formData) {
        showLoader();
        let res = await axios.post('/dashboard/admin/blogPageDetailUpdate',formData,{
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
        getBlogPageDetails();
    }

    
</script>
