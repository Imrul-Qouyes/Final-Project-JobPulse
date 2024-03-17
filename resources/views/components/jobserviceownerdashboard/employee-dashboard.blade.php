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
            <h3 class="text-xl text-sky-900 font-semibold">All Employees</h3>
        </div>
        <div class="flex justify-end mb-8">
            <div class="flex justify-end">
                <button id="addEmployee"
                    class="bg-fuchsia-800 hover:bg-fuchsia-600 text-base text-white font-medium py-1 px-2 rounded-lg mr-2">Add
                    Employee</button>
            </div>
            <div>
                <button class="bg-cyan-700 hover:bg-cyan-600 py-1 px-2 text-base text-white font-medium rounded-lg mr-2"
                    id="sortByRoleBtn">Sort By Role
                </button>
            </div>

        </div>

        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border border-blue-600">Name</th>
                        <th class="px-4 py-2 text-center border border-blue-600">Role</th>
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



{{-- Modal For Add Employee --}}

<div class="modal w-full h-full top-0 left-0 absolute z-50 hidden" id="addModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-3/4 h-[90%] mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModaladd" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Add Employee</ins></p>
                </div>

                <div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="employeeName" class="block mb-2 text-sm font-medium text-white">Employee
                            Name</label>
                        <input type="text" id="employeeName" name="employeeName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Name" />
                    </div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="employee_email" class="block mb-2 text-sm font-medium text-white">Email address</label>
                        <input type="email" id="employee_email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="your@gmail.com" />
                    </div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                        <input type="text" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Set Password (Min 6 characters)" />
                    </div>
                </div>

                <div class="flex justify-center">
                    <label for="addrole" class="text-white font-medium pt-2 mr-2">Choose Role: </label>
                    <select id="addrole" name="addrole"
                        class="bg-blue-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5 mb-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="2" selected>manager</option>
                        <option value="3">editor</option>
                    </select>
                </div>

                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="addEmployeeBtn">ADD</button>
                </div>

            </div>
        </div>
    </div>
</div>



{{-- Modal For Edit --}}

<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="editModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-1/2 h-1/2 mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModalEdit" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Manage Role</ins></p>
                </div>

                <div class="flex justify-center">
                    <label for="changerole" class="text-white font-medium pt-2 mr-2">Change Role: </label>
                    <select id="changerole" name="changerole"
                        class="bg-blue-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5 mb-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option id="option1"></option>
                        <option id="option2"></option>
                    </select>
                </div>

                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="updateroleBtn">Change Role</button>
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
    let addEmployee = document.getElementById('addEmployee');
    let editBtn = document.getElementById('editBtn');
    let deleteBtn = document.getElementById('deleteBtn');
    let editModal = document.getElementById('editModal');
    let deleteModal = document.getElementById('deleteModal');
    let closeModalEdit = document.getElementById('closeModalEdit');
    let closeModalDelete = document.getElementById('closeModalDelete');
    let noBtn = document.getElementById('noBtn');


    addEmployee.addEventListener('click', () => {
        addModal.classList.remove('hidden');
    })

    let currentPage = 1;

    async function getList() {
        showLoader();
        let res = await axios.get(`/dashboard/admin/EmployeeList?page=${currentPage}`);

        hideLoader();
        updateTable(res.data);
    }

    let personIdForUpdate = '';
    let idForDelete = '';


    function updateTable(data) {

        // SortBy Status

        const sortByRoleBtn = document.getElementById('sortByRoleBtn');
        sortByRoleBtn.addEventListener('click', () => {
            data.sort((a, b) => {
                if (a[2] < b[2]) {
                    return -1;
                } else if (a[2] > b[2]) {
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
            const rowsHtml = data.map(person => {

                return `<tr>
                    <td class="border px-4 py-2 font-medium border border-blue-600">${person[1]}</td>
                    <td class="border px-4 py-2 text-center font-medium border border-blue-600">${person[2]}</td>
                    <td class="border px-4 py-2 text-center font-medium border border-blue-600">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 edit-btn"
                                id="${person[0]}"                                
                                data-role="${person[2]}">Edit</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-btn"
                                id="${person[0]}"">Delete</button>
                        </td>
                    </tr>
                `;
            }).join('');

            tableList.innerHTML = rowsHtml;

            const editButtons = document.querySelectorAll('.edit-btn');
            const deleteButtons = document.querySelectorAll('.delete-btn');

            editButtons.forEach(button => {

                button.addEventListener('click', () => {

                    editModal.classList.remove('hidden');
                    personIdForUpdate = button['id'];

                    if (button.getAttribute('data-role') == 'manager') {
                        option1.innerHTML = button.getAttribute('data-role');
                        option2.innerHTML = 'editor'


                    } else if (button.getAttribute('data-role') == 'editor') {
                        option1.innerHTML = button.getAttribute('data-role');
                        option2.innerHTML = 'manager'

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


    closeModaladd.addEventListener('click', () => {
        addModal.classList.add('hidden');
    })
    closeModalEdit.addEventListener('click', () => {
        editModal.classList.add('hidden');
    })
    closeModalDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    })
    noBtn.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    })



    addEmployeeBtn.addEventListener('click', () => {

        const employeeName = document.getElementById('employeeName').value;
        const email = document.getElementById('employee_email').value;
        const password = document.getElementById('password').value;
        const selectElement = document.getElementById('addrole').value;    

        addEmploye(employeeName, email, password, selectElement);
        addModal.classList.add('hidden');
        getList();
    })

    async function addEmploye(employeeName, email, password, selectElement) {
      
        showLoader();
        let res = await axios.post('/dashboard/admin/addEmployee', {
            employee_name: employeeName,
            email: email,
            password: password,
            role_id: selectElement
        })
        hideLoader();
        
        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }

    }


    const updateroleBtn = document.getElementById('updateroleBtn');

    updateroleBtn.addEventListener('click', () => {

        updateRole(personIdForUpdate);
        editModal.classList.add('hidden');
        getList();

    })

    async function updateRole(id) {

        let roleValue = document.getElementById('changerole').value;
        let roleId = '';
        if (roleValue === "manager") {
            roleId = 2;
        } else if (roleValue === "editor") {
            roleId = 3;
        }
        showLoader();
        let res = await axios.post('/dashboard/admin/changeEmployeeRole', {
            id: id,
            role_id: roleId
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
        deleteEmployee(idForDelete);
        deleteModal.classList.add('hidden');
        getList();

    })

    async function deleteEmployee(id) {

        showLoader();
        let res = await axios.post('/dashboard/admin/removeEmployee', {
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
