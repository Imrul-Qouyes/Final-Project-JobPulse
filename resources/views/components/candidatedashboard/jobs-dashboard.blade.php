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
    <div class="p-4 border-2 border-blue-400 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-8 border-b border-blue-500">
            <h2 class="text-3xl font-semibold">Candidate Dashboard</h2>
            
        </div>
        <div class="text-center mb-7">
            <h3 class="text-xl text-red-900 font-semibold">Applied Jobs List</h3>
        </div>
        <div class="flex justify-end mb-8">
            <div>
                <button class="bg-green-700 hover:bg-green-500 py-1 px-2 text-base text-white font-medium rounded-lg"
                    id="sortByYearBtn">Sort By Year</button>
            </div>
        </div>
        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr class="border">
                        <th class="px-4 py-2 text-left">Job Title</th>
                        <th class="px-4 py-2 text-center">Applied Date</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody id="appliedJobtableList">

                </tbody>
            </table>
        </div>

        <div class="flex justify-center gap-x-3 mt-8 mb-8">
            <button class="bg-blue-700 px-3 py-1 text-white text-lg font-medium" onclick="handPrev()">Previous</button>
            <button class="bg-green-700 px-3 py-1 text-white text-lg font-medium" onclick="handNext()">Next</button>

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
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Job Details</ins></p>
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


            </div>
        </div>
    </div>
</div>

<script>

    let currentPage = 1;


    async function getAppliedJobs() {
        showLoader();
        let res = await axios.get(`/dashboard/candidate/appliedJobList?page=${currentPage}`);
        hideLoader();

        updateTable(res.data);

    }


    function updateTable(data) {

        // SortBy Year

        const sortBtn = document.getElementById('sortByYearBtn');

        sortBtn.addEventListener('click', () => {
            data.data.sort((a, b) => {

                const yearA = parseInt(a.applied_date.split(' ')[2]);
                const yearB = parseInt(b.applied_date.split(' ')[2]);
                if (yearA < yearB) {
                    return -1;
                } else if (yearA > yearB) {
                    return 1;
                } else {
                    return 0;
                }
            });

            updateTable(data);
        });



        //Creating Dynamic table

        const tableList = document.getElementById('appliedJobtableList');

        if (!data.data || data.data.length === 0) {

            tableList.innerHTML = `<tr><td colspan="4" class="text-center font-semibold">No Data Found!</td></tr>`;

            return;

        } else {
            const rows = data.data.map((job) => {


                return `<tr>
        <td class="border px-4 py-2 font-medium">${job.all_jobs.job_title}</td>
        <td class="border px-4 py-2 font-medium text-center">${job.applied_date}</td>
        <td class="border px-4 py-2 font-medium text-center">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 view-btn"
        data-title="${job.all_jobs.job_title}"
        data-description="${job.all_jobs.job_description}"
        data-skills="${job.all_jobs.job_skills}"
        data-benefits="${job.all_jobs.job_benefits}"
        data-location="${job.all_jobs.location}"
        data-deadline="${job.all_jobs.deadline}">View</button>
        </td>
        </tr>`
            }).join('');

            tableList.innerHTML = rows;


            const viewButtons = document.querySelectorAll('.view-btn');

            viewButtons.forEach(button => {

                button.addEventListener('click', () => {
                    document.getElementById('viewModal').classList.remove('hidden');

                    document.getElementById('jobTitle').innerText = button.getAttribute('data-title');
                    document.getElementById('jobDescription').innerText = button.getAttribute(
                        'data-description');
                    document.getElementById('skills').innerText = button.getAttribute('data-skills');
                    document.getElementById('jobBenefits').innerText = button.getAttribute(
                        'data-benefits');
                    document.getElementById('jobLocation').innerText = button.getAttribute(
                        'data-location');
                    document.getElementById('jobDeadline').innerText = button.getAttribute(
                        'data-deadline');


                });
            });



        }
    }


    document.getElementById('closeModalView').addEventListener('click', () => {
        document.getElementById('viewModal').classList.add('hidden');
    })


    function handNext() {
        if (currentPage) {
            currentPage++;
            getAppliedJobs();
        }
    }

    function handPrev() {
        if (currentPage > 1) {
            currentPage--;
            getAppliedJobs();
        }
    }


    getAppliedJobs();
</script>
