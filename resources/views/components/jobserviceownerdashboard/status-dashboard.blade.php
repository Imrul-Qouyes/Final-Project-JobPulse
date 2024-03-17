<div class="p-4 sm:ml-64 bg-slate-100">
    <div class="p-4 border-2 border-red-500 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-8 border-b border-red-500">
            <h2 class="text-3xl font-semibold">Admin Dashboard</h2>
            
        </div>
        <div id="statusDashboard" class="mb-8">
            <h3 class="text-xl font-semibold mb-6">Company Status</h3>
            <div class="flex justify-around gap-x-4">
                <div class="w-2/6 h-48 bg-slate-300 flex flex-col justify-center items-center rounded-lg">
                    <div>
                        <h3 class="text-lg font-medium mb-6">Active Companies</h3>
                    </div>
                    <div class="bg-green-600 text-lg text-white text-center flex flex-col justify-center items-center font-medium rounded-full w-16 h-16"
                        id="activeCompanies"></div>
                </div>
                <div class="w-2/6 h-48 bg-slate-300 flex flex-col justify-center items-center rounded-lg">
                    <div>
                        <h3 class="text-lg font-medium mb-6">Pending Companies</h3>
                    </div>
                    <div class="bg-pink-600 text-lg text-white text-center flex flex-col justify-center items-center font-medium rounded-full w-16 h-16"
                        id="pendingCompanies"></div>
                </div>
                <div class="w-2/6 h-48 bg-slate-300 flex justify-center flex-col items-center rounded-lg">
                    <div>
                        <h3 class="text-lg font-medium mb-6">Jobs Posted</h3>
                    </div>
                    <div class="bg-blue-500 text-lg text-white text-center flex flex-col justify-center items-center font-medium rounded-full w-16 h-16"
                        id="jobsPosted"></div>
                </div>
            </div>
        </div>

    </div>
</div>



<script>
    const activeCompanies = document.getElementById('activeCompanies');
    const pendingCompanies = document.getElementById('pendingCompanies');
    const jobsPosted = document.getElementById('jobsPosted');



    window.addEventListener('DOMContentLoaded', () => {
        status();

    })

    async function status() {
        showLoader();
        let res = await axios.get('/dashboard/admin');
        let res2 = await axios.get('/dashboard/admin/postedJobs');
        hideLoader();
        activeCompanies.innerText = res.data.activeStatus;
        pendingCompanies.innerText = res.data.pendingStatus;
        jobsPosted.innerText = res2.data;
    }

    
</script>
