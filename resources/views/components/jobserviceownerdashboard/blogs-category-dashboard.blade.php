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
            <h3 class="text-xl text-orange-500 font-semibold">Blogs Category</h3>
        </div>
        <div class="flex justify-end mb-8">
            <div class="flex justify-end">
                <button id="addCategoryBtn"
                    class="bg-fuchsia-800 hover:bg-fuchsia-600 text-base text-white font-medium py-1 px-2 rounded-lg mr-2">Add
                    Category</button>
            </div>

        </div>

        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr >
                        <th class="px-4 py-2 text-left border border-blue-600">Category Name</th>
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



{{-- Modal For Add Category --}}

<div class="modal w-full h-full top-0 left-0 absolute z-50 hidden" id="categoryModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-1/2 h-3/5 mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closecategoryModal" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Add Blog Category</ins></p>
                </div>

                <div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="categoryName" class="block mb-2 text-sm font-medium text-white">Category
                            Name</label>
                        <input type="text" id="categoryName" name="categoryName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter Category Name Here" />
                    </div>

                </div>

                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="createcategoryBtn">ADD</button>
                </div>

            </div>
        </div>
    </div>
</div>



{{-- Modal For Edit --}}

<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="categoryEditModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-1/2 h-3/5 mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModalEdit" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Edit Category Name</ins></p>
                </div>
                <div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="editcategoryName" class="block mb-2 text-sm font-medium text-white">Category
                            Name</label>
                        <input type="text" id="editcategoryName" name="editcategoryName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>

                </div>



                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="updatecategoryBtn">Update</button>
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
    let addCategoryBtn = document.getElementById('addCategoryBtn');
    let editBtn = document.getElementById('editBtn');
    let deleteBtn = document.getElementById('deleteBtn');
    let categoryEditModal = document.getElementById('categoryEditModal');
    let deleteModal = document.getElementById('deleteModal');
    let closecategoryModal = document.getElementById('closecategoryModal');
    let closeModalDelete = document.getElementById('closeModalDelete');
    let noBtn = document.getElementById('noBtn');


    addCategoryBtn.addEventListener('click', () => {
        categoryModal.classList.remove('hidden');
    })

    let currentPage = 1;

    async function getList() {
        showLoader();
        let res = await axios.get(`/dashboard/admin/allBlogCategory?page=${currentPage}`);

        hideLoader();
        updateTable(res.data);
    }

    let categoryIdForUpdate = '';
    let idForDelete = '';


    function updateTable(data) {


        //Creating Dynamic table

        const tableList = document.getElementById('tableList');

        if (!data.data || data.data.length === 0) {
            tableList.innerHTML = `<tr><td colspan="4" class="text-center font-semibold">No Data Found!</td></tr>`;
            return;
        } else {
            const rowsHtml = data.data.map(category => {

                return `<tr>
                  <td class="border px-4 py-2 font-medium border border-blue-600">${category['blog_category_name']}</td>
                  <td class="border px-4 py-2 text-center font-medium border border-blue-600">
                          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 edit-btn"
                              id="${category['id']}"                                
                              value="${category['blog_category_name']}">Edit</button>
                          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-btn"
                              id="${category['id']}"">Delete</button>
                      </td>
                  </tr>
              `;
            }).join('');

            tableList.innerHTML = rowsHtml;

            const editButtons = document.querySelectorAll('.edit-btn');
            const deleteButtons = document.querySelectorAll('.delete-btn');

            editButtons.forEach(button => {

                button.addEventListener('click', () => {

                    categoryEditModal.classList.remove('hidden');
                    categoryIdForUpdate = button['id'];
                    document.getElementById('editcategoryName').value = button['value'];


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


    closecategoryModal.addEventListener('click', () => {
        categoryModal.classList.add('hidden');
    })
    closeModalEdit.addEventListener('click', () => {
        categoryEditModal.classList.add('hidden');
    })
    closeModalDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    })
    noBtn.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    })



    createcategoryBtn.addEventListener('click', () => {

        const categoryName = document.getElementById('categoryName').value;

        addCategory(categoryName);
        categoryModal.classList.add('hidden');
        getList();
    })

    async function addCategory(categoryName) {

        showLoader();
        let res = await axios.post('/dashboard/admin/addBlogCategory', {
            blog_category_name: categoryName,

        })
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }

    }


    const updatecategoryBtn = document.getElementById('updatecategoryBtn');

    updatecategoryBtn.addEventListener('click', () => {

        updateCategory(categoryIdForUpdate);
        categoryEditModal.classList.add('hidden');
        getList();

    })

    async function updateCategory(id) {

        let editcategoryValue = document.getElementById('editcategoryName').value;

        showLoader();
        let res = await axios.post('/dashboard/admin/updateBlogCategory', {
            id: id,
            blog_category_name: editcategoryValue
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
        deleteCategory(idForDelete);
        deleteModal.classList.add('hidden');
        getList();

    })

    async function deleteCategory(id) {

        showLoader();
        let res = await axios.post('/dashboard/admin/removeBlogCategory', {
            id: id
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
