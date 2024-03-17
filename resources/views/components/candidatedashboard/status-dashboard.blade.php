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
        <div class="mb-8 border-b border-blue-500 ">
            <h2 class="text-3xl font-semibold">Candidate Dashboard</h2>
            <hr>
        </div>
        <div id="statusDashboard" class="mb-8">
            <h3 class="text-xl font-semibold mb-6">All Status</h3>
            <div class="flex justify-around gap-x-4">
                <div class="w-2/6 h-48 bg-slate-300 flex flex-col justify-center items-center rounded-lg">
                    <div>
                        <h3 class="text-lg font-medium mb-6">Applied Jobs</h3>
                    </div>
                    <div class="bg-green-600 text-lg text-white text-center flex flex-col justify-center items-center font-medium rounded-full w-16 h-16"
                        id="jobAppliedCount">0</div>
                </div>
               
            </div>
        </div>

    </div>
</div>

<script>

    async function getAppliedJobCount() {
        
        let res = await axios.get('/dashboard/candidate/appliedJobCount')
        document.getElementById('jobAppliedCount').innerText = res.data;        

    }

    getAppliedJobCount();
</script>