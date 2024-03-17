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
            <h3 class="text-xl text-red-900 font-semibold">Candidates for <span id="jobName"></span></h3>
        </div>
        <div class="flex justify-end mb-8">
            <div>
                <button class="bg-green-700 hover:bg-green-500 py-1 px-2 text-base text-white font-medium rounded-lg"
                    id="sortByDateBtn">Sort By
                    Date</button>
            </div>
        </div>
        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr class="border">
                        <th class="px-4 py-2 text-left">Candidate Name</th>
                        <th class="px-4 py-2 text-center">Applied Date</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>

        <div class="flex justify-center gap-x-3 mt-8 mb-8">
            <button class="bg-blue-700 px-3 py-1 text-white text-lg font-medium" onclick="handPrev()">Previous</button>
            <button class="bg-green-700 px-3 py-1 text-white text-lg font-medium" onclick="handNext()">Next</button>

        </div>

        <hr>

        <div class="text-center mt-8 mb-7">
            <h3 class="text-xl text-red-900 font-semibold">Selected Candidates List</h3>
        </div>
        <div class="flex justify-center">
            <table class="w-full">
                <thead>
                    <tr class="border">
                        <th class="px-4 py-2 text-left">Candidate Name</th>
                        <th class="px-4 py-2 text-center">Applied Date</th>
                        <th class="px-4 py-2">Remarks</th>
                    </tr>
                </thead>
                <tbody id="selectedCandidateTableList">

                </tbody>
            </table>
        </div>



    </div>
</div>


{{-- Modal for Applied Candidate Details --}}
<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="viewModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-y-scroll">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-zinc-700 w-11/12 h-[90%] mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center">
                    <button id="closeModalView" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class=" flex justify-center flex-col items-center text-center mb-10">
                    <p class="text-2xl text-white font-semibold mb-3"><ins>Candidate Detail Informations</ins></p>
                    <div class="border p-2 rounded-lg mb-3 w-3/4">
                        <h3 class="text-2xl text-yellow-300 mb-3">General Information</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <div class="flex justify-center"> <img src="" alt="no image" class="w-28 h-24"
                                    id=candidateImg></div>
                            <div class="">
                                <p class="text-left text-base font-medium mb-2">Full Name: <span
                                        class="text-md text-purple-600 ml-3 p-1 w-auto" id="fullName"></span></p>
                                <p class="text-left text-base font-medium mb-2">Father's Name: <span
                                        class="text-md text-purple-600 ml-3" id="fatherName"></span></p>
                                <p class="text-left text-base font-medium mb-2">Mother's Name: <span
                                        class="text-md text-purple-600 ml-3" id="motherName"></span></p>
                                <p class="text-left text-base font-medium mb-2">Date of Birth: <span
                                        class="text-md text-purple-600 ml-3" id="dateOfBirth"></span></p>
                                <p class="text-left text-base font-medium mb-2">Blood Group: <span
                                        class="text-md text-purple-600 ml-3" id="bloodGroup"></span></p>
                                <p class="text-left text-base font-medium mb-2">SocialID/NID: <span
                                        class="text-md text-purple-600 ml-3" id="nID"></span></p>
                                <p class="text-left text-base font-medium mb-2">Passport No: <span
                                        class="text-md text-purple-600 ml-3" id="passportNo"></span></p>
                                <p class="text-left text-base font-medium mb-2">Cellphone No: <span
                                        class="text-md text-purple-600 ml-3" id="cellPhoneNo"></span></p>
                                <p class="text-left text-base font-medium mb-2">Emergency Contact No: <span
                                        class="text-md text-purple-600 ml-3" id="emergencyNo"></span></p>
                                <p class="text-left text-base font-medium mb-2">Email: <span
                                        class="text-md text-purple-600 ml-3" id="emailAddress"></span></p>
                                <p class="text-left text-base font-medium mb-2">What's App: <span
                                        class="text-md text-purple-600 ml-3" id="whatsApp"></span></p>
                                <p class="text-left text-base font-medium mb-2">Linkdein Link: <span
                                        class="text-md text-purple-600 ml-3" id="linkedinLink"></span></p>
                                <p class="text-left text-base font-medium mb-2">Facebook Link: <span
                                        class="text-md text-purple-600 ml-3" id="fbLink"></span></p>
                                <p class="text-left text-base font-medium mb-2">GitHub Link: <span
                                        class="text-md text-purple-600 ml-3" id="githubLink"></span></p>
                                <p class="text-left text-base font-medium mb-2">Behance/Dribble Link: <span
                                        class="text-md text-purple-600 ml-3" id="behanceLink"></span></p>
                                <p class="text-left text-base font-medium mb-2">Porfolio Website: <span
                                        class="text-md text-purple-600 ml-3" id="portfolioLink"></span></p>
                            </div>

                        </div>

                    </div>
                    <div class="border p-2 rounded-lg w-3/4 mb-3">
                        <h3 class="text-2xl text-yellow-300 mb-3">Educational Information</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <table class="w-full">
                                <thead>
                                    <tr class="border">
                                        <th class="px-4 py-2 text-left">Degree Type</th>
                                        <th class="px-4 py-2 text-center">University / Institution Name</th>
                                        <th class="px-4 py-2 text-center">Department / Group</th>
                                        <th class="px-4 py-2 text-center">Passing Year</th>
                                        <th class="px-4 py-2 text-center">CGPA/GPA</th>
                                    </tr>
                                </thead>
                                <tbody id="educationDetails">

                                </tbody>

                            </table>

                        </div>

                    </div>
                    <div class="border p-2 rounded-lg w-3/4 mb-3">
                        <h3 class="text-2xl text-yellow-300 mb-3">Professional Trainings</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <table class="w-full">
                                <thead>
                                    <tr class="border">
                                        <th class="px-4 py-2 text-left">Training Name</th>
                                        <th class="px-4 py-2 text-center">Institution Name</th>
                                        <th class="px-4 py-2 text-center">Completion Year</th>
                                    </tr>
                                </thead>
                                <tbody id="trainingDetails">

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <div class="border p-2 rounded-lg w-3/4 mb-3">
                        <h3 class="text-2xl text-yellow-300 mb-3">Job Experiences</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <table class="w-full">
                                <thead>
                                    <tr class="border">
                                        <th class="px-4 py-2 text-left">Designation</th>
                                        <th class="px-4 py-2 text-center">Company Name</th>
                                        <th class="px-4 py-2 text-center">Joining Date</th>
                                        <th class="px-4 py-2 text-center">Deperture Date</th>
                                    </tr>
                                </thead>
                                <tbody id="experienceDetails">

                                </tbody>

                            </table>

                        </div>

                    </div>
                    <div class="border p-2 rounded-lg w-3/4 mb-3">
                        <h3 class="text-2xl text-yellow-300 mb-3">Skills</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <div id="skillsDetails"></div>
                        </div>
                    </div>

                    <div class="border p-2 rounded-lg w-3/4">
                        <h3 class="text-2xl text-yellow-300 mb-3">Extra Information</h3>
                        <div class="bg-zinc-100 rounded-lg p-2">
                            <div id="extraInfo">

                            </div>
                        </div>
                    </div>
                </div>




                <div class="flex justify-center gap-x-3">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        id="selectBtn">Select Candidate</button>

                </div>

            </div>
        </div>
    </div>
</div>


{{-- Modal For Delete & Reject Candidate --}}
<div class="modal w-full h-full top-0 left-0 hidden absolute z-50" id="rejectModal">
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-slate-300 opacity-50"></div>

        <div class="modal-container bg-slate-700 w-2/5 mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-end items-center pb-3">

                    <button id="closeRejectModal" class="text-white">
                        <span class="text-2xl font-medium">&times;</span>
                    </button>
                </div>
                <div class="text-center mb-10">
                    <p class="text-2xl text-white font-semibold">Are you sure to Reject this Candidate?</p>
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
    document.getElementById('jobName').innerText = localStorage.getItem('jobName');

    let currentPage = 1;
    const jobId = localStorage.getItem('jobId');


    async function getAllAppliedCandidate() {
        showLoader();
        let res = await axios.post(`/dashboard/employer/appliedCandiateList?page=${currentPage}`, {
            id: jobId
        });
        hideLoader();

        updateTable(res.data);

    }


    let idForReject = '';
    let appliedIdForSelection = '';

    function updateTable(data) {

        // SortBy Date

        const sortBtn = document.getElementById('sortByDateBtn');
        sortBtn.addEventListener('click', () => {

            data.data.sort((a, b) => {

                if (a['applied_date'] < b['applied_date']) {
                    return -1;
                } else if (a['applied_date'] > b['applied_date']) {
                    return 1;
                } else {
                    return 0;
                }
            });

            updateTable(data);
        });


        //Creating Dynamic table

        const tableList = document.getElementById('tableList');

        if (!data.data || data.data.length === 0) {

            tableList.innerHTML = `<tr><td colspan="4" class="text-center font-semibold">No Data Found!</td></tr>`;

            return;

        } else {

            const rows = data.data.map(appliedJob => {


                return `<tr>
                          <td class="border px-4 py-2 font-medium">${appliedJob.candidates.basic_info.full_name}</td>
                          <td class="border px-4 py-2 font-medium text-center">${appliedJob.applied_date}</td>
                          <td class="border px-4 py-2 font-medium text-center">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 view-btn"
                          data-candidateid="${appliedJob.candidate_id}"
                          data-appliedid="${appliedJob.id}"
                          >View</button>
                          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded reject-btn"
                          id="${appliedJob.id}">Reject</button>  
                          </td>
                          </tr>`

            }).join('');

            document.getElementById('tableList').innerHTML = rows;


            const viewButtons = document.querySelectorAll('.view-btn');
            const rejectButtons = document.querySelectorAll('.reject-btn');

            viewButtons.forEach(button => {

                let Id = button.getAttribute('data-candidateid');
                appliedIdForSelection = button.getAttribute('data-appliedid');


                button.addEventListener('click', async () => {

                    async function getCVDetails() {

                        let res = await axios.post('/dashboard/employer/candidateCVDetails', {
                            id: Id
                        })

                        // For candidate Image
                        res.data.candidateImgUrl.forEach(image => {

                            document.getElementById('candidateImg').src =
                                `{{ asset('${image.image_url}') }}`

                        });


                        //For Candidate Basic Info

                        res.data.basicInfo.forEach(item => {

                            document.getElementById('fullName').innerText = item
                                .full_name;
                            document.getElementById('fatherName').innerText = item
                                .father_name;
                            document.getElementById('motherName').innerText = item
                                .mother_name;
                            document.getElementById('dateOfBirth').innerText = item
                                .date_of_birth;
                            document.getElementById('bloodGroup').innerText = item
                                .blood_group;
                            document.getElementById('nID').innerText = item.nid;
                            document.getElementById('passportNo').innerText = item
                                .passport_no;
                            document.getElementById('cellPhoneNo').innerText = item
                                .cellphone_no;
                            document.getElementById('emergencyNo').innerText = item
                                .emergency_contact_no;
                            document.getElementById('emailAddress').innerText = item
                                .email;
                            document.getElementById('whatsApp').innerText = item
                                .whatsapp_no;
                            document.getElementById('linkedinLink').innerText = item
                                .linkedin_link;
                            document.getElementById('fbLink').innerText = item.fb_id;
                            document.getElementById('githubLink').innerText = item
                                .github_link;
                            document.getElementById('behanceLink').innerText = item
                                .behance_or_dribble_link;
                            document.getElementById('portfolioLink').innerText = item
                                .portfolio_link;
                        })

                        //For Candidate Education Info

                        const eduInfo = res.data.eduInfo.map(item => {

                            return `<tr>
                                <td class="border px-4 py-2 font-normal">${item.degree_type}</td>
                                <td class="border px-4 py-2 font-normal">${item.education_institution}</td>
                                <td class="border px-4 py-2 font-normal">${item.department}</td>
                                <td class="border px-4 py-2 font-normal">${item.passing_year}</td>
                                <td class="border px-4 py-2 font-normal">${item.result}</td>
                                </tr>`

                        }).join('')

                        document.getElementById('educationDetails').innerHTML = eduInfo


                        //For Candidate Training Info

                        const trainingInfo = res.data.trainingInfo.map(item => {
                            return `<tr>
                                <td class="border px-4 py-2 font-normal">${item.training_name}</td>
                                <td class="border px-4 py-2 font-normal">${item.training_institution}</td>
                                <td class="border px-4 py-2 font-normal">${item.completion_year}</td>
                                </tr>`
                        }).join('')

                        document.getElementById('trainingDetails').innerHTML = trainingInfo;


                        //For Candidate Experience Info

                        const experienceInfo = res.data.experienceInfo.map(item => {

                            return `<tr>
                                <td class="border px-4 py-2 font-normal">${item.designation}</td>
                                <td class="border px-4 py-2 font-normal">${item.company_name}</td>
                                <td class="border px-4 py-2 font-normal">${item.join_date}</td>
                                <td class="border px-4 py-2 font-normal">${item.deperture_date}</td>
                                </tr>`

                        }).join('')

                        document.getElementById('experienceDetails').innerHTML = experienceInfo;


                        // For Candidate Skill Info

                        const skillsInfo = res.data.skills.map(item => {

                            return `<p class="font-medium">${item.skills}</p>`

                        })

                        document.getElementById('skillsDetails').innerHTML = skillsInfo


                        // For Candidate Extra Info

                        const extraInfo = res.data.skills.map(item => {

                            return `<p class="text-base font-medium">Current Salary: <span>${item.current_salary} /-</span></p>
                            <p class="text-base font-medium">Expected Salary: <span>${item.expected_salary} /-</span></p>`

                        })

                        document.getElementById('extraInfo').innerHTML = extraInfo

                    }

                    getCVDetails();

                    document.getElementById('viewModal').classList.remove('hidden');

                });
            });

            rejectButtons.forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById('rejectModal').classList.remove('hidden');
                    idForReject = button['id']
                });
            });

        }
    }

    async function getSelectedCandidateList() {
        let res = await axios.post(`/dashboard/employer/selectedCandidateList?page=${currentPage}`, {
            id: jobId
        });

        updateSelectedCandidateTable(res.data);
    }

    function updateSelectedCandidateTable(data) {


        //Creating Dynamic table

        const selectedCandidateTableList = document.getElementById('selectedCandidateTableList');

        if (!data.data || data.data.length === 0) {

            selectedCandidateTableList.innerHTML =
                `<tr><td colspan="4" class="text-center font-semibold">No Data Found!</td></tr>`;

            return;

        } else {

            const rows = data.data.map(candidate => {


                return `<tr>
                  <td class="border px-4 py-2 font-medium">${candidate.candidates.basic_info.full_name}</td>
                  <td class="border px-4 py-2 font-medium text-center">${candidate.applied_date}</td>
                  <td class="border px-4 py-2 font-semibold text-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3 view-btn"
                          data-candidateid="${candidate.candidate_id}"
                          data-appliedid="${candidate.id}">View</button>
                     <span class="text-green-500 font-semibold border-2 p-2 border-green-400 rounded-lg">${candidate.selection_status}</span>
                  </td>
                  </tr>`

            }).join('');

            document.getElementById('selectedCandidateTableList').innerHTML = rows;

            const viewButtons = document.querySelectorAll('.view-btn');

            viewButtons.forEach(button => {

                let Id = button.getAttribute('data-candidateid');
                appliedIdForSelection = button.getAttribute('data-appliedid');


                button.addEventListener('click', async () => {

                    async function getCVDetails() {

                        let res = await axios.post('/dashboard/employer/candidateCVDetails', {
                            id: Id
                        })

                        // For candidate Image
                        res.data.candidateImgUrl.forEach(image => {

                            document.getElementById('candidateImg').src =
                                `{{ asset('${image.image_url}') }}`

                        });


                        //For Candidate Basic Info

                        res.data.basicInfo.forEach(item => {

                            document.getElementById('fullName').innerText = item
                                .full_name;
                            document.getElementById('fatherName').innerText = item
                                .father_name;
                            document.getElementById('motherName').innerText = item
                                .mother_name;
                            document.getElementById('dateOfBirth').innerText = item
                                .date_of_birth;
                            document.getElementById('bloodGroup').innerText = item
                                .blood_group;
                            document.getElementById('nID').innerText = item.nid;
                            document.getElementById('passportNo').innerText = item
                                .passport_no;
                            document.getElementById('cellPhoneNo').innerText = item
                                .cellphone_no;
                            document.getElementById('emergencyNo').innerText = item
                                .emergency_contact_no;
                            document.getElementById('emailAddress').innerText = item
                                .email;
                            document.getElementById('whatsApp').innerText = item
                                .whatsapp_no;
                            document.getElementById('linkedinLink').innerText = item
                                .linkedin_link;
                            document.getElementById('fbLink').innerText = item.fb_id;
                            document.getElementById('githubLink').innerText = item
                                .github_link;
                            document.getElementById('behanceLink').innerText = item
                                .behance_or_dribble_link;
                            document.getElementById('portfolioLink').innerText = item
                                .portfolio_link;
                        })

                        //For Candidate Education Info

                        const eduInfo = res.data.eduInfo.map(item => {

                            return `<tr>
                <td class="border px-4 py-2 font-normal">${item.degree_type}</td>
                <td class="border px-4 py-2 font-normal">${item.education_institution}</td>
                <td class="border px-4 py-2 font-normal">${item.department}</td>
                <td class="border px-4 py-2 font-normal">${item.passing_year}</td>
                <td class="border px-4 py-2 font-normal">${item.result}</td>
                </tr>`

                        }).join('')

                        document.getElementById('educationDetails').innerHTML = eduInfo


                        //For Candidate Training Info

                        const trainingInfo = res.data.trainingInfo.map(item => {
                            return `<tr>
                <td class="border px-4 py-2 font-normal">${item.training_name}</td>
                <td class="border px-4 py-2 font-normal">${item.training_institution}</td>
                <td class="border px-4 py-2 font-normal">${item.completion_year}</td>
                </tr>`
                        }).join('')

                        document.getElementById('trainingDetails').innerHTML = trainingInfo;


                        //For Candidate Experience Info

                        const experienceInfo = res.data.experienceInfo.map(item => {

                            return `<tr>
                <td class="border px-4 py-2 font-normal">${item.designation}</td>
                <td class="border px-4 py-2 font-normal">${item.company_name}</td>
                <td class="border px-4 py-2 font-normal">${item.join_date}</td>
                <td class="border px-4 py-2 font-normal">${item.deperture_date}</td>
                </tr>`

                        }).join('')

                        document.getElementById('experienceDetails').innerHTML = experienceInfo;


                        // For Candidate Skill Info

                        const skillsInfo = res.data.skills.map(item => {

                            return `<p class="font-medium">${item.skills}</p>`

                        })

                        document.getElementById('skillsDetails').innerHTML = skillsInfo


                        // For Candidate Extra Info

                        const extraInfo = res.data.skills.map(item => {

                            return `<p class="text-base font-medium">Current Salary: <span>${item.current_salary} /-</span></p>
            <p class="text-base font-medium">Expected Salary: <span>${item.expected_salary} /-</span></p>`

                        })

                        document.getElementById('extraInfo').innerHTML = extraInfo;

                        document.getElementById('selectBtn').classList.add('hidden');

                    }

                    getCVDetails();

                    document.getElementById('viewModal').classList.remove('hidden');

                });
            });



        }
    }


    async function selectCandidate(appliedId) {

        let res = await axios.post('/dashboard/employer/selectCandidate', {
            applied_id: appliedId
        })


        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
        getAllAppliedCandidate();
        getSelectedCandidateList();
    }

    document.getElementById('selectBtn').addEventListener('click', () => {
        selectCandidate(appliedIdForSelection)
        document.getElementById('viewModal').classList.add('hidden');
    })


    async function rejectCandidate(id) {

        let res = await axios.post('/dashboard/employer/rejectCandidate', {
            id: id
        })

        if (res.status === 200 && res.data.status === 'success') {
            successToast(res.data.message);
        } else {
            errorToast(res.data.message);
        }
        getAllAppliedCandidate();
    }


    document.getElementById('closeModalView').addEventListener('click', () => {
        document.getElementById('viewModal').classList.add('hidden');
    })

    document.getElementById('closeRejectModal').addEventListener('click', () => {
        document.getElementById('rejectModal').classList.add('hidden');
    })
    document.getElementById('noBtn').addEventListener('click', () => {
        document.getElementById('rejectModal').classList.add('hidden');
    })
    document.getElementById('yesBtn').addEventListener('click', () => {
        rejectCandidate(idForReject);
        document.getElementById('rejectModal').classList.add('hidden');
    })



    function handNext() {
        if (currentPage) {
            currentPage++;
            getAllAppliedCandidate();
        }
    }

    function handPrev() {
        if (currentPage > 1) {
            currentPage--;
            getAllAppliedCandidate();
        }
    }

    let currentPage2 = 1;

    function handNext2() {
        if (currentPage2) {
            currentPage2++;
            getSelectedCandidateList();
        }
    }

    function handPrev2() {
        if (currentPage2 > 1) {
            currentPage2--;
            getSelectedCandidateList();
        }
    }
    getSelectedCandidateList();

    getAllAppliedCandidate();
</script>
