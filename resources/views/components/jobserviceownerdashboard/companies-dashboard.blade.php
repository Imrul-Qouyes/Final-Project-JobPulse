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
<div class="p-4 sm:ml-64 bg-slate-100">
    <div class="p-4 border-2 border-red-500 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-8 border-b border-red-500">
            <h2 class="text-3xl font-semibold">Admin Dashboard</h2>
            
        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl font-semibold">All Companies</h3>
        </div>
        <div class="flex justify-end mb-8">
            <button class="bg-green-500 py-1 px-2 text-base text-white font-medium rounded-lg" id="sortBtn">Sort By
                Status</button>
        </div>
        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr class="border">
                        <th class="px-4 py-2 text-left border border-blue-600">Company Name</th>
                        <th class="px-4 py-2 border border-blue-600">Status</th>
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

{{-- Modal For Edit --}}

<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="editModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-11/12  mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModalEdit" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Company Detail Informations</ins></p>
                    <div class="bg-zinc-100 rounded-lg p-2 w-auto">
                        <p class="text-left text-base font-medium mb-2">Company Name: <span class="text-md text-purple-600 ml-3" id="companyName"></span></p>
                        <p class="text-left text-base font-medium mb-2">Company Address: <span class="text-md text-purple-600 ml-3" id="companyAddress"></span>
                        </p>
                        <p class="text-left text-base font-medium mb-2">Company No. of Employees: <span class="text-md text-purple-600 ml-3"
                                id="companyNoEmployee"></span></p>
                        <p class="text-left text-base font-medium mb-2">Company Type: <span class="text-md text-purple-600 ml-3" id="companyType"></span></p>
                        <p class="text-left text-base font-medium mb-2">Company Business: <span class="text-md text-purple-600 ml-3" id="companyBusiness"></span>
                        </p>
                        <p class="text-left text-base font-medium mb-2">Company Contact Person: <span class="text-md text-purple-600 ml-3"
                                id="companyContact"></span></p>
                        <p class="text-left text-base font-medium mb-2">Company Contact Email: <span class="text-md text-purple-600 ml-3"
                                id="companyEmail"></span></p>
                        <p class="text-left text-base font-medium mb-2">Person Designation: <span class="text-md text-purple-600 ml-3"
                                id="persondesig"></span></p>
                        
                        <p class="text-left text-base font-medium mb-2">Company Establishment Year: <span class="text-md text-purple-600 ml-3" id="companyYear"></span>
                        </p>
                    </div>
                </div>

                <div class="flex justify-center">
                    <label for="status" class="text-white font-medium pt-2 mr-2">Change Status: </label>
                    <select id="status" name="status"
                        class="bg-blue-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5 mb-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option id="option1"></option>
                        <option id="option2"></option>
                    </select>
                </div>

                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="updateBtn">Update</button>

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
    let editBtn = document.getElementById('editBtn');
    let deleteBtn = document.getElementById('deleteBtn');
    let editModal = document.getElementById('editModal');
    let deleteModal = document.getElementById('deleteModal');
    let closeModalEdit = document.getElementById('closeModalEdit');
    let closeModalDelete = document.getElementById('closeModalDelete');
    let noBtn = document.getElementById('noBtn');


    let currentPage = 1;

    async function getList() {
        showLoader();
        let res = await axios.get(`/dashboard/admin/employerList?page=${currentPage}`);
        hideLoader();
        updateTable(res.data);
    }

    let idForUpdate = '';
    let idForDelete = '';
    
    function updateTable(data) {

        // SortBy Status

        const sortBtn = document.getElementById('sortBtn');
        sortBtn.addEventListener('click', () => {
            data.sort((a, b) => {
                if (a[10] < b[10]) {
                    return -1;
                } else if (a[10] > b[10]) {
                    return 1;
                } else {
                    return 0;
                }
            });

            updateTable(data);
        });


        //Creating Dynamic table

        const tableList = document.getElementById('tableList');

        if (!data || data.length === 0) {
            tableList.innerHTML = `<tr><td colspan="4" class="text-center font-semibold">No Data Found!</td></tr>`;
            return;
        } else {
            const rowsHtml = data.map(company => {
                

                return `<tr>
                    <td class="border px-4 py-2 font-medium border border-blue-600">${company[1]}</td>
                    <td class="border px-4 py-2 text-center font-medium border border-blue-600">${company[10]}</td>
                    <td class="border px-4 py-2 text-center font-medium border border-blue-600">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 edit-btn"
                                id="${company[11]}" 
                                data-status="${company[10]}" 
                                data-cname="${company[1]}"
                                data-caddress="${company[2]}"
                                data-csize="${company[3]}"
                                data-ctype="${company[4]}"
                                data-cbusiness="${company[5]}"
                                data-ccontact="${company[6]}"
                                data-cemail="${company[7]}"
                                data-pdesignation="${company[8]}"
                                data-cyear="${company[9]}">Edit</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-btn"
                                id="${company[11]}">Delete</button>
                        </td>
                    </tr>
                `;
            }).join('');

            tableList.innerHTML = rowsHtml;

            const editButtons = document.querySelectorAll('.edit-btn');
            const deleteButtons = document.querySelectorAll('.delete-btn');

            editButtons.forEach(button => {
                
                button.addEventListener('click', () => {
                    document.getElementById('companyName').innerText = button.getAttribute('data-cname');
                    document.getElementById('companyAddress').innerText = button.getAttribute('data-caddress');
                    document.getElementById('companyNoEmployee').innerText = button.getAttribute('data-csize');
                    document.getElementById('companyType').innerText = button.getAttribute('data-ctype');
                    document.getElementById('companyBusiness').innerText = button.getAttribute('data-cbusiness');
                    document.getElementById('companyContact').innerText = button.getAttribute('data-ccontact');
                    document.getElementById('companyEmail').innerText = button.getAttribute('data-cemail');
                    document.getElementById('persondesig').innerText = button.getAttribute('data-pdesignation');
                    document.getElementById('companyYear').innerText = button.getAttribute('data-cyear');

                    
                    editModal.classList.remove('hidden');
                    idForUpdate = button['id'];

                    if (button.getAttribute('data-status') == 'active') {
                        option1.innerHTML = button.getAttribute('data-status');
                        option2.innerHTML = 'pending'
                    } else if (button.getAttribute('data-status') == 'pending') {
                        option1.innerHTML = button.getAttribute('data-status');
                        option2.innerHTML = 'active'
                    }


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

    closeModalEdit.addEventListener('click', () => {
        editModal.classList.add('hidden');
    })
    closeModalDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    })
    noBtn.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    })

    const updateBtn = document.getElementById('updateBtn');

    updateBtn.addEventListener('click', () => {
        updateStatus(idForUpdate);
        editModal.classList.add('hidden');
        getList();

    })

    async function updateStatus(id) {

        let updateValue = document.getElementById('status').value;
        showLoader();
        let res = await axios.post('/dashboard/admin/employerStatus', {
            id: id,
            status: updateValue
        })
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
    }


    const yesBtn = document.getElementById('yesBtn');

    yesBtn.addEventListener('click',()=>{
        deleteCompany(idForDelete);
        deleteModal.classList.add('hidden');
        getList();
        
    })

    async function deleteCompany(id){
        
        showLoader();
        let res = await axios.post('/dashboard/admin/removeEmployer',{
            id:id
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
