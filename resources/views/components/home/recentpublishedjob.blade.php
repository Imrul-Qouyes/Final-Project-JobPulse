<section class="bg-white">
    <div class="container">
        <div class="recentjob-wrapper py-10">
            <h3 class="text-3xl font-bold text-center pb-12">Recent Published Jobs</h3>
            <div class="flex justify-center gap-x-5 pb-10">

                <span 
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg">
                Developers
                <span
                    class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full" id="developers">
                    
                </span>
            </span>
            <span
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-rose-600 rounded-lg">
                Designers
                <span
                    class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full" id="designers">
                    
                </span>
            </span>
            <span
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-lg">
                Marketers
                <span
                    class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full" id="marketers">
                    
                </span>
            </span>
            <span 
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-violet-600 rounded-lg">
                UI/UX
                <span
                    class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full" id="ui_ux">
                    
                </span>
            </span>

            </div>

            <div class="bg-zinc-200 p-3 h-[590px] overflow-hidden" id="eachJob"></div>
            <div class="text-center pt-8 mb-5">
                <a href="{{ route('page.alljobs') }}"
                    class="bg-teal-700 px-4 py-2 text-white text-lg font-bold rounded-lg hover:bg-teal-500">View
                    More</a>
            </div>
        </div>
    </div>
</section>


<script>
    async function getJobsDevelopersCount() {
        let res = await axios.get('/getJobsDevelopersCount');
        document.getElementById('developers').innerText = res.data;
    }
    getJobsDevelopersCount();


    async function getJobsDesignersCount() {
        let res = await axios.get('/getJobsDesignersCount');
        document.getElementById('designers').innerText = res.data;
    }
    getJobsDesignersCount();


    async function getJobsMarketerCount() {
        let res = await axios.get('/getJobsMarketerCount');
        document.getElementById('marketers').innerText = res.data;
    }
    getJobsMarketerCount();


    async function getJobsUiUxCount() {
        let res = await axios.get('/getJobsUiUxCount');
        document.getElementById('ui_ux').innerText = res.data;
    }
    getJobsUiUxCount();







    async function allJobsList() {
        showLoader();
        let res = await axios.get('/allPublishedJobs');
        hideLoader();

        updateJobs(res);

    }


    function updateJobs(res) {

        if (res.data.length === 0) {
            document.getElementById('eachJob').innerHTML =
                `<div><h3 class="text-center font-medium">No Jobs Available.</h3></div>`
        } else {

            const titleData = res.data.map(item => {
                let skills = item.job_skills;
                let skillArray = skills.split(',');
                let skillElements = skillArray.map(skill =>
                    `<span class="bg-red-100 text-pink-800 text-sm font-medium me-2 px-3 py-1 rounded dark:bg-gray-700 dark:text-green-400 border border-green-800">${skill}</span>`
                ).join('');


                return ` <div class="flex justify-between items-center bg-blue-200 p-5 rounded-xl mb-3"> 
                        <div class="leftPart flex flex-col">
                                <div class="flex gap-x-4 mb-3">
                                    <div>
                                        <h3 class="text-xl font-medium pb">${item.job_title}</h3>
                                    </div>
                                    <div>
                                        <span
                                            class="bg-green-100 text-rose-800 text-sm font-medium me-2 px-3 py-1 rounded dark:bg-gray-700 dark:text-green-400 border-2 border-rose-800">${item.employment_type}</span>
                                        <span
                                            class="bg-green-100 text-green-800 text-sm font-medium me-2 px-3 py-1 rounded dark:bg-gray-700 dark:text-green-400 border-2 border-green-800">${item.company_name}</span>
                                            
                                    </div>
                                </div>
                                <div id="skillPart">
                                ${skillElements}
                                </div>
                        </div>                         


                        <div class="rightPart">
                            <span
                                class="bg-green-100 text-green-800 text-sm font-medium me-2 px-3 py-1 rounded dark:bg-gray-700 dark:text-green-400 border border-green-800" id="jobSalary">Salary: ${item.salary}/-
                            </span>
                            <button 
                                class="text-base text-white font-medium bg-blue-600 px-3 py-1 rounded-lg hover:bg-blue-900 applyJobBtn" data-jobid="${item.id}">APPLY</button>
                        </div>
                </div>`
            }).join('');

            document.getElementById('eachJob').innerHTML = titleData;

            const applyBtn = document.querySelectorAll(".applyJobBtn");
            applyBtn.forEach(button => {
                button.addEventListener('click', async () => {
                    let t = localStorage.getItem('token')
                    if (!t) {
                        errorToast('Please Login To Apply!');
                    } else {
                        let jobId = button.getAttribute('data-jobid');
                        let res = await axios.post('/candidate/applyJob', {
                            job_id: jobId
                        })

                        successToast(res.data.message)
                    }
                })
            })
        }

    }


    allJobsList();
</script>
