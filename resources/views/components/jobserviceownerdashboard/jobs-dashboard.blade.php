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
            <h3 class="text-xl text-red-900 font-semibold">All Jobs</h3>
        </div>
        <div class="flex justify-end mb-8">
            <div>
                <button class="bg-cyan-700 hover:bg-cyan-600 py-1 px-2 text-base text-white font-medium rounded-lg mr-2"
                    id="sortcompanyBtn">Sort By Company</button>
                <button class="bg-green-700 hover:bg-green-500 py-1 px-2 text-base text-white font-medium rounded-lg"
                    id="sortstatusBtn">Sort By
                    Status</button>
            </div>

        </div>
        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left border border-blue-600">Job Title</th>
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

        <div class="modal-container bg-zinc-700 w-3/4 h-[90%] mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModalEdit" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Company Detail Informations</ins></p>
                    <div class="bg-zinc-100 rounded-lg p-2 w-auto">
                        <p class="text-left text-base font-medium mb-2">Company Name: <span
                                class="text-md text-purple-600 ml-3" id="companyName"></span></p>
                        <p class="text-left text-base font-medium mb-2">Job Title: <span
                                class="text-md text-purple-600 ml-3" id="jobTitle"></span>
                        </p>
                        <p class="text-left text-base font-medium mb-2">Job Description: <span
                                class="text-md text-purple-600 ml-3" id="jobdescription"></span></p>
                        <p class="text-left text-base font-medium mb-2">Skills Required: <span
                                class="text-md text-purple-600 ml-3" id="skills"></span></p>
                        <p class="text-left text-base font-medium mb-2">Job Benefits: <span
                                class="text-md text-purple-600 ml-3" id="jobBenefits"></span>
                        </p>
                        <p class="text-left text-base font-medium mb-2">Salary: <span
                                class="text-md text-purple-600 ml-3" id="salary"></span></p>
                        <p class="text-left text-base font-medium mb-2">Employment Type: <span
                                class="text-md text-purple-600 ml-3" id="employmentType"></span></p>
                        <p class="text-left text-base font-medium mb-2">Job Location: <span
                                class="text-md text-purple-600 ml-3" id="location"></span></p>

                        <p class="text-left text-base font-medium mb-2">Application Deadline: <span
                                class="text-md text-purple-600 ml-3" id="deadline"></span>
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
        let res = await axios.get(`/dashboard/admin/allJobList?page=${currentPage}`);
        hideLoader();
        updateTable(res.data);
    }

    let idForUpdate = '';
    let idForDelete = '';

    function updateTable(data) {

        // SortBy Company

        const sortcompanyBtn = document.getElementById('sortcompanyBtn');
        sortcompanyBtn.addEventListener('click', () => {
            data.sort((a, b) => {
               
                if (a['company_name'] < b['company_name']) {
                    return -1;
                } else if (a['company_name'] > b['company_name']) {
                    return 1;
                } else {
                    return 0;
                }
            });

            updateTable(data);
        });

        //Sort By Status
        const sortstatusBtn = document.getElementById('sortstatusBtn');
        sortstatusBtn.addEventListener('click', () => {
            data.sort((a, b) => {
                
                if (a['status'] < b['status']) {
                    return -1;
                } else if (a['status'] > b['status']) {
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
            const rowsHtml = data.map(job => {

                return `<tr>
                    <td class="border px-4 py-2 font-medium border border-blue-600">${job['job_title']}</td>
                    <td class="border px-4 py-2 text-left font-medium border border-blue-600">${job['company_name']}</td>
                    <td class="border px-4 py-2 text-center font-medium border border-blue-600">${job['status']}</td>
                    <td class="border px-4 py-2 text-center font-medium border border-blue-600">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 edit-btn"
                                id="${job['id']}" 
                                data-companyname="${job['company_name']}" 
                                data-jobname="${job['job_title']}"
                                data-jobdescription="${job['job_description']}"
                                data-skills="${job['job_skills']}"
                                data-jobbenefits="${job['job_benefits']}"
                                data-salary="${job['salary']}"
                                data-jobtype="${job['employment_type']}"
                                data-joblocation="${job['location']}"
                                data-jobdeadline="${job['deadline']}"
                                data-status="${job['status']}">Edit</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-btn"
                                id="${job['id']}"">Delete</button>
                        </td>
                    </tr>
                `;
            }).join('');

            tableList.innerHTML = rowsHtml;

            const editButtons = document.querySelectorAll('.edit-btn');
            const deleteButtons = document.querySelectorAll('.delete-btn');

            editButtons.forEach(button => {

                button.addEventListener('click', () => {
                    document.getElementById('companyName').innerText = button.getAttribute('data-companyname');
                    document.getElementById('jobTitle').innerText = button.getAttribute('data-jobname');
                    document.getElementById('jobdescription').innerText = button.getAttribute('data-jobdescription');
                    document.getElementById('skills').innerText = button.getAttribute('data-skills');
                    document.getElementById('jobBenefits').innerText = button.getAttribute('data-jobbenefits');
                    document.getElementById('salary').innerText = button.getAttribute('data-salary');
                    document.getElementById('employmentType').innerText = button.getAttribute('data-jobtype');
                    document.getElementById('location').innerText = button.getAttribute('data-joblocation');
                    document.getElementById('deadline').innerText = button.getAttribute('data-jobdeadline');


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
        let res = await axios.post('/dashboard/admin/jobStatus', {
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

    yesBtn.addEventListener('click', () => {
        deleteJob(idForDelete);
        deleteModal.classList.add('hidden');
        getList();

    })

    async function deleteJob(id) {

        showLoader();
        let res = await axios.post('/dashboard/admin/removeJob', {
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
