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
<div class="p-4 sm:ml-64 bg-zinc-100">
    <div class="p-4 border-2 border-green-400 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-8 border-b border-green-500">
            <h2 class="text-3xl font-semibold">Employer Dashboard</h2>
            
        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl text-red-900 font-semibold">All Jobs</h3>
        </div>
        <div class="flex justify-end mb-8">
            <div>
                <button class="bg-cyan-700 hover:bg-cyan-600 py-1 px-2 text-base text-white font-medium rounded-lg mr-2"
                    id="createNewJobBtn">Create New Job</button>
                <button class="bg-green-700 hover:bg-green-500 py-1 px-2 text-base text-white font-medium rounded-lg"
                    id="sortByMonthBtn">Sort By
                    Month</button>
            </div>

        </div>
        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr class="border">
                        <th class="px-4 py-2 text-left">Job Title</th>
                        <th class="px-4 py-2 text-center">Published At</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody id="tableListJobs">

                </tbody>
            </table>
        </div>

        <div class="flex justify-center gap-x-3 mt-8">
            <button class="bg-blue-700 px-3 py-1 text-white text-lg font-medium" onclick="handPrev()">Previous</button>
            <button class="bg-green-700 px-3 py-1 text-white text-lg font-medium" onclick="handNext()">Next</button>

        </div>


    </div>
</div>


{{-- Modal for Create New Job --}}

<div class="modal w-full h-full top-0 left-0 absolute z-50 hidden" id="createJobModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-3/4 h-[90%] mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModalCreateJob" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Post New Job</ins></p>
                </div>

                <div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="job_title" class="block mb-2 text-sm font-medium text-white">Job Title</label>
                        <input type="text" id="job_title" name="job_title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="job_description" class="block mb-2 text-sm font-medium text-white">Job
                            Description</label>
                        <textarea id="job_description" name="job_description" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> </textarea>
                    </div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="job_skills" class="block mb-2 text-sm font-medium text-white">Job Skills (Add skills
                            by comma)</label>
                        <input type="text" id="job_skills" name="job_skills"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="job_benefits" class="block mb-2 text-sm font-medium text-white">Job Benefits</label>
                        <textarea id="job_benefits" name="job_benefits" rows="2"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> </textarea>
                    </div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="salary" class="block mb-2 text-sm font-medium text-white">Job Salary</label>
                        <input type="text" id="salary" name="salary"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="flex justify-center">
                        <label for="employment_type" class="text-white font-medium pt-2 mr-2">Choose Employment Type:
                        </label>
                        <select id="employment_type" name="employment_type"
                            class="bg-blue-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2.5 mb-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>full-time</option>
                            <option>part-time</option>
                            <option>contractual</option>
                            <option>remote</option>
                            <option>on-site</option>
                        </select>
                    </div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="location" class="block mb-2 text-sm font-medium text-white">Job Location</label>
                        <input type="text" id="location"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="mb-6 w-1/2 mx-auto">
                        <label for="deadline" class="block mb-2 text-sm font-medium text-white">Deadline</label>
                        <input type="date" id="deadline"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                </div>



                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="postNewJobBtn">Post New Job</button>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Modal For View --}}

<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="viewModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-3/4 h-[90%] mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModalView" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins><span id="jobName"></span></ins></p>
                    <div class="bg-zinc-100 rounded-lg p-2 w-auto">

                        <p class="text-left text-base font-medium mb-2">Job Title: <span
                                class="text-md text-purple-600 ml-3" id="jobTitle"></span>
                        </p>
                        <p class="text-left text-base font-medium mb-2">Job Description: <span
                                class="text-md text-purple-600 ml-3" id="jobDescription"></span></p>
                        <p class="text-left text-base font-medium mb-2">Skills Required: <span
                                class="text-md text-purple-600 ml-3" id="skills"></span></p>
                        <p class="text-left text-base font-medium mb-2">Job Benefits: <span
                                class="text-md text-purple-600 ml-3" id="jobBenefits"></span>
                        </p>
                        <p class="text-left text-base font-medium mb-2">Job Location: <span
                                class="text-md text-purple-600 ml-3" id="jobLocation"></span></p>

                        <p class="text-left text-base font-medium mb-2">Application Deadline: <span
                                class="text-md text-purple-600 ml-3" id="jobDeadline"></span>
                        </p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button id="appliedCandiates"
                        class="bg-white text-green-700 font-medium text-center text-lg py-4 px-4 rounded-lg w-1/2 cursor-pointer hover:bg-green-300">
                        Candidate Applied (<span id="appliedCount"></span>)</button>
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
    const createNewJobBtn = document.getElementById('createNewJobBtn');

    createNewJobBtn.addEventListener('click', () => {
        document.getElementById('createJobModal').classList.remove('hidden');
    })

    document.getElementById('closeModalCreateJob').addEventListener('click', () => {
        document.getElementById('createJobModal').classList.add('hidden');
    })

    postNewJobBtn.addEventListener('click', () => {
        const jobTitle = document.getElementById('job_title').value;
        const jobDescription = document.getElementById('job_description').value;
        const jobSkills = document.getElementById('job_skills').value;
        const jobBenefits = document.getElementById('job_benefits').value;
        const salary = document.getElementById('salary').value;
        const employmentType = document.getElementById('employment_type').value;
        const location = document.getElementById('location').value;
        const deadline = document.getElementById('deadline').value;



        const date = new Date(deadline);
        const formattedDate = new Intl.DateTimeFormat('en-US', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            formatMatcher: 'basic'
        }).format(date);

        const formData = new FormData();
        formData.append('job_title', jobTitle);
        formData.append('job_description', jobDescription);
        formData.append('job_skills', jobSkills);
        formData.append('job_benefits', jobBenefits);
        formData.append('salary', salary);
        formData.append('employment_type', employmentType);
        formData.append('location', location);
        formData.append('deadline', formattedDate);

        createNewJob(formData);
        document.getElementById('createJobModal').classList.add('hidden');

    })

    async function createNewJob(formData) {
        showLoader();
        let res = await axios.post('/dashboard/employer/createJob', formData);
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
    }

    let currentPage = 1;


    async function getAllJobs() {
        showLoader();
        let res = await axios.get(`/dashboard/employer/jobList?page=${currentPage}`);
        hideLoader();
       
        
        updateTable(res.data);

    }

    let jobIdForDelete = '';

    function updateTable(data) {

        // SortBy Month

        const sortBtn = document.getElementById('sortByMonthBtn');
        sortBtn.addEventListener('click', () => {
            data.data.sort((a, b) => {

                if (a['published_at'] < b['published_at']) {
                    return -1;
                } else if (a['published_at'] > b['published_at']) {
                    return 1;
                } else {
                    return 0;
                }
            });

            updateTable(data);
        });



        //Creating Dynamic table

        const tableList = document.getElementById('tableListJobs');

        if (!data.data || data.data.length === 0) {

            tableList.innerHTML = `<tr><td colspan="4" class="text-center font-semibold">No Data Found!</td></tr>`;

            return;

        } else {
            const rows = data.data.map((job) => {



                return `<tr>
            <td class="border px-4 py-2 font-medium">${job.job_title}</td>
            <td class="border px-4 py-2 font-medium text-center">${job.published_at}</td>
            <td class="border px-4 py-2 font-medium text-center">
              <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 view-btn"
            data-id="${job.id}"
            data-title="${job.job_title}"
            data-description="${job.job_description}"
            data-skills="${job.job_skills}"
            data-benefits="${job.job_benefits}"
            data-location="${job.location}"
            data-deadline="${job.deadline}">View</button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-btn"
            id="${job.id}">Delete</button>  
            </td>
            </tr>`
            }).join('');

            document.getElementById('tableListJobs').innerHTML = rows;


            const viewButtons = document.querySelectorAll('.view-btn');
            const deleteButtons = document.querySelectorAll('.delete-btn');

            viewButtons.forEach(button => {
                let jobId = button.getAttribute('data-id');
                let jobName = button.getAttribute('data-title');
                button.addEventListener('click', () => {

                    async function jobid() {
                        let res = await axios.post('/dashboard/employer/candiateCount', {
                            id: jobId
                        });
                        document.getElementById('appliedCount').innerHTML = res.data;

                    }

                    jobid();

                    document.getElementById('viewModal').classList.remove('hidden');
                    document.getElementById('jobName').innerText = button.getAttribute(
                        'data-title');
                    document.getElementById('jobTitle').innerText = button.getAttribute(
                        'data-title');
                    document.getElementById('jobDescription').innerText = button.getAttribute(
                        'data-description');
                    document.getElementById('skills').innerText = button.getAttribute(
                        'data-skills');
                    document.getElementById('jobBenefits').innerText = button.getAttribute(
                        'data-benefits');
                    document.getElementById('jobLocation').innerText = button.getAttribute(
                        'data-location');
                    document.getElementById('jobDeadline').innerText = button.getAttribute(
                        'data-deadline');

                    document.getElementById('appliedCandiates').addEventListener('click', () => {
                        document.getElementById('viewModal').classList.add('hidden');
                        location.href = '/dashboard/employer/appliedCandidates';
                        localStorage.setItem('jobId', jobId);
                        localStorage.setItem('jobName', jobName);
                    })

                });
            });

            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    deleteModal.classList.remove('hidden');
                    jobIdForDelete = button['id']
                });
            });

        }
    }

    

    async function removeJob(jobId) {
        showLoader();
        let res = await axios.post('/dashboard/employer/deleteJob',{id:jobId});
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }

        getAllJobs();
    }

    document.getElementById('closeModalView').addEventListener('click', () => {
        document.getElementById('viewModal').classList.add('hidden');
    })

    document.getElementById('closeModalDelete').addEventListener('click', () => {
        document.getElementById('deleteModal').classList.add('hidden');
    })
    document.getElementById('noBtn').addEventListener('click', () => {
        document.getElementById('deleteModal').classList.add('hidden');
    })
    document.getElementById('yesBtn').addEventListener('click', () => {
        removeJob(jobIdForDelete);
        document.getElementById('deleteModal').classList.add('hidden');
    })



    function handNext() {
        if (currentPage) {
            currentPage++;
            getAllJobs();
        }
    }

    function handPrev() {
        if (currentPage > 1) {
            currentPage--;
            getAllJobs();
        }
    }


    getAllJobs();
</script>
