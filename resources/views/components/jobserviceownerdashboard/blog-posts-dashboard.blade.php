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
            <h3 class="text-xl text-blue-800 font-semibold">All Blog Posts</h3>
        </div>
        <div class="flex justify-end mb-8">
            <div class="flex justify-end">
                <button id="addPostBtn"
                    class="bg-fuchsia-800 hover:bg-fuchsia-600 text-base text-white font-medium py-1 px-2 rounded-lg mr-2">Add
                    Post</button>
            </div>

        </div>

        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr class="border">
                        <th class="px-4 py-2 text-left border border-blue-600">Blog Post Title</th>
                        <th class="px-4 py-2 text-center border border-blue-600">Status</th>
                        <th class="px-4 py-2 border border-blue-600">Action</th>
                    </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>

        <div class="flex justify-center gap-x-3 mt-8">
            <button class="bg-blue-700 px-3 py-1 text-white text-lg font-medium" onclick="handPrev()">Previous</button>
            <button class="bg-green-700 px-3 py-1 text-white text-lg font-medium" onclick="handNext()">Next</button>

        </div>


    </div>
</div>



{{-- Modal For Add Blog Post --}}

<div class="modal w-full h-full top-0 left-0 absolute z-50 hidden" id="blogPostModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-3/4 h-[90%] mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeblogPostModal" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-8">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Create Blog Post</ins></p>
                </div>

                <div>
                    <form action="" id="createBlogPostForm">
                        <div class="mb-6 w-1/2 mx-auto">
                            <label for="blogTitle" class="block mb-2 text-sm font-medium text-white">Blog Title</label>
                            <input type="text" id="blogTitle" name="blogTitle"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter title for blog" />
                        </div>
                        <div class="mb-6 w-1/2 mx-auto">
                            <label for="blogContent" class="block mb-2 text-sm font-medium text-white">Blog
                                Content</label>
                            <textarea id="blogContent" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your contents here..."></textarea>

                        </div>
                        <div class="mb-6 w-1/2 mx-auto">
                            <label for="selectBlogCategory" class="block mb-2 text-sm font-medium text-white">Choose
                                Category</label>
                            <select id="selectBlogCategory" name="selectBlogCategory"
                                class="bg-blue-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[29rem] p-2.5 mb-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            </select>
                        </div>
                        <div class="mb-6 w-1/4  mx-auto rounded-lg object-scale-down overflow-hidden"><img
                                src="{{ asset('image-regular.svg') }}" id="oldImg" alt="image-regular.svg"
                                class="object-scale-down"></div>
                        <div class="mb-6 w-1/2 mx-auto">
                            <label class="block mb-2 text-sm font-medium text-white" for="blog_img">Upload
                                image</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="blog_img" type="file"
                                oninput="oldImg.src=window.URL.createObjectURL(this.files[0])">
                        </div>
                    </form>
                </div>

                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="createPostBtn">Create Blog Post</button>
                </div>

            </div>
        </div>
    </div>
</div>



{{-- Modal For Edit --}}

<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="blogPostEditModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-3/4 h-4/5 mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeblogPostModalEdit" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Edit Blog Posts</ins></p>
                </div>
                <div>
                    <form action="">
                        <div class="mb-6 w-1/2 mx-auto">
                            <label for="blogTitleEdit" class="block mb-2 text-sm font-medium text-white">Blog Title</label>
                            <input type="text" id="blogTitleEdit" name="blogTitleEdit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                />
                        </div>
                        <div class="mb-6 w-1/2 mx-auto">
                            <label for="blogContentEdit" class="block mb-2 text-sm font-medium text-white">Blog
                                Content</label>
                            <textarea id="blogContentEdit" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                ></textarea>

                        </div>
                        <div class="mb-6 w-1/2 mx-auto">
                            <label for="selectBlogPostStatusEdit" class="block mb-2 text-sm font-medium text-white">Change
                                Status</label>
                            <select id="selectBlogPostStatusEdit" name="selectBlogPostStatusEdit"
                                class="bg-blue-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[29rem] p-2.5 mb-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            </select>
                        </div>
                        <div class="mb-6 w-1/4  mx-auto rounded-lg object-scale-down overflow-hidden" id="editImage"><img
                                src="{{ asset('image-regular.svg') }}" id="oldImgEdit" alt="No Image"
                                class="object-scale-down text-white"></div>
                        <div class="mb-6 w-1/2 mx-auto">
                            <label class="block mb-2 text-sm font-medium text-white" for="blog_img_update">Upload
                                image</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="blog_img_update" type="file"
                                oninput="oldImgEdit.src=window.URL.createObjectURL(this.files[0])">
                        </div>
                    </form>
                </div>



                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="updateBlogPostBtn">Update</button>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Modal For Delete --}}
<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="deleteModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-slate-700 w-2/5 mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center pb-3">

                    <button id="closeModalDelete" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class="text-center mb-10">
                    <p class="text-2xl text-white font-semibold">Are you sure to delete this?</p>
                </div>
                <div class="flex justify-center gap-x-3">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        id="yesBtn">Yes</button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        id="noBtn">No</button>
                </div>

            </div>
        </div>
    </div>
</div>



<script>
    let addPostBtn = document.getElementById('addPostBtn');
    let editBtn = document.getElementById('editBtn');
    let deleteBtn = document.getElementById('deleteBtn');
    let blogPostEditModal = document.getElementById('blogPostEditModal');
    let closeblogPostModalEdit = document.getElementById('closeblogPostModalEdit');
    let deleteModal = document.getElementById('deleteModal');
    let closeblogPostModal = document.getElementById('closeblogPostModal');
    let closeModalDelete = document.getElementById('closeModalDelete');
    let noBtn = document.getElementById('noBtn');


    addPostBtn.addEventListener('click', () => {
        blogPostModal.classList.remove('hidden');
    })

    let currentPage = 1;

    async function getList() {
        showLoader();
        let res = await axios.get(`/dashboard/admin/allBlogPost?page=${currentPage}`);

        hideLoader();
        updateTable(res.data);
    }

    let blogIdForUpdate = '';
    let imageFilePathForUpdate = '';
    let imageFilePathForDelete = '';
    let idForDelete = '';


    function updateTable(data) {

        //Creating Dynamic table

        const tableList = document.getElementById('tableList');

        if (!data.data || data.data.length === 0) {
            tableList.innerHTML = `<tr><td colspan="4" class="text-center font-semibold">No Data Found!</td></tr>`;
            return;
        } else {
            const rowsHtml = data.data.map(posts => {

                return `<tr>
                  <td class="border px-4 py-2 font-medium border border-blue-600">${posts['title']}</td>
                  <td class="border px-4 py-2 font-medium text-center border border-blue-600">${posts['status']}</td>
                  <td class="border px-4 py-2 text-center font-medium border border-blue-600">
                          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 edit-btn"
                              id="${posts['id']}"                                
                              data-title="${posts['title']}"
                              data-content="${posts['content']}"
                              data-status="${posts['status']}"
                              data-image="${posts['image']}"
                              data-categoryid="${posts['category_id']}">Edit</button>
                          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-btn"
                              id="${posts['id']}"">Delete</button>
                      </td>
                  </tr>
              `;
            }).join('');

            tableList.innerHTML = rowsHtml;

            const editButtons = document.querySelectorAll('.edit-btn');
            const deleteButtons = document.querySelectorAll('.delete-btn');

            editButtons.forEach(button => {

                button.addEventListener('click', () => {

                    blogPostEditModal.classList.remove('hidden');
                    
                    blogIdForUpdate = button['id'];
                    imageFilePathForDelete = button.getAttribute('data-image');
                    document.getElementById('blogTitleEdit').value = button.getAttribute('data-title');
                    document.getElementById('blogContentEdit').value = button.getAttribute('data-content');

                  
                    let dataImg=button.getAttribute('data-image');
                    
                    if(dataImg){
                        document.getElementById('oldImgEdit').src =`{{asset('${dataImg}')}}`;
                    }else{
                        document.getElementById('oldImgEdit').src =`{{asset('image-regular.svg')}}`
                    }

                    let dataStatus =  button.getAttribute('data-status');
                    if(dataStatus === "published"){
                        document.getElementById('selectBlogPostStatusEdit').innerHTML = `<option id="${button['id']}">${button.getAttribute('data-status')}</option>
                        <option id="${button['id']}">draft</option>`

                    }else if(dataStatus === "draft"){
                        document.getElementById('selectBlogPostStatusEdit').innerHTML = `<option id="${button['id']}">${button.getAttribute('data-status')}</option>
                        <option id="${button['id']}">published</option>`
                    }

                    imageFilePathForUpdate = button.getAttribute('data-image');
                    

                });
            });

            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    deleteModal.classList.remove('hidden');
                    idForDelete = button['id']
                });
            });

        }
    }


    closeblogPostModal.addEventListener('click', () => {
        blogPostModal.classList.add('hidden');
    })
    closeblogPostModalEdit.addEventListener('click', () => {
        blogPostEditModal.classList.add('hidden');
    })
    closeModalDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    })
    noBtn.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    })


    addPostBtn.addEventListener('click', async () => {

        let res = await axios.get('/dashboard/admin/allBlogCategory');


        const optionsHtml = res.data.data.map(blogCategory => {

            return `<option value='${blogCategory.id}'>${blogCategory.blog_category_name}</option>`;

        });
        document.getElementById('selectBlogCategory').innerHTML = optionsHtml;

    });

    createPostBtn.addEventListener('click', async () => {

        const blogTitle = document.getElementById('blogTitle').value;
        const blogContent = document.getElementById('blogContent').value;
        const selectBlogCategory = document.getElementById('selectBlogCategory').value;
        const blog_img = document.getElementById('blog_img').files[0];

        const formData = new FormData();
        formData.append('title', blogTitle);
        formData.append('content', blogContent);
        formData.append('blog_image', blog_img);
        formData.append('category_id', selectBlogCategory);

        

        addBlogPosts(formData);
        blogPostModal.classList.add('hidden');
        getList();
        document.getElementById('createBlogPostForm').reset();
        document.getElementById('oldImg').src=`{{ asset('image-regular.svg') }}`;
    })

    async function addBlogPosts(formData) {

        showLoader();
        
        let res = await axios.post('/dashboard/admin/createBlogPost', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
        getList();

    }


    const updateBlogPostBtn = document.getElementById('updateBlogPostBtn');

    updateBlogPostBtn.addEventListener('click', () => {
        const blogTitleEdit = document.getElementById('blogTitleEdit').value;
        const blogContentEdit = document.getElementById('blogContentEdit').value;
        const selectBlogPostStatusEdit = document.getElementById('selectBlogPostStatusEdit').value;
        let blog_img_update = document.getElementById('blog_img_update').files[0];


        const formData = new FormData();
        formData.append('id', blogIdForUpdate);
        formData.append('title', blogTitleEdit);
        formData.append('content', blogContentEdit);
        formData.append('blog_image', blog_img_update);
        formData.append('status', selectBlogPostStatusEdit);
        formData.append('file_path', imageFilePathForUpdate);


        updateBlogPosts(formData);
        blogPostEditModal.classList.add('hidden');
        getList();

    })

    async function updateBlogPosts(formData) {

        showLoader();
        let res = await axios.post('/dashboard/admin/updateBlogPost',formData ,{
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
    }


    const yesBtn = document.getElementById('yesBtn');

    yesBtn.addEventListener('click', () => {
        deleteCategory(idForDelete,imageFilePathForDelete);
        deleteModal.classList.add('hidden');
        getList();

    })

    async function deleteCategory(id,imgFile) {

        showLoader();
        let res = await axios.post('/dashboard/admin/removeBlogPost', {
            id: id,
            file_path:imgFile
        })
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
    }

    function handNext() {
        if (currentPage) {
            currentPage++;
            getList();
        }
    }

    function handPrev() {
        if (currentPage > 1) {
            currentPage--;
            getList();
        }
    }
    getList();
</script>
