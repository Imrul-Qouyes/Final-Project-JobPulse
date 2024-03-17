<section>
    <div class="text-center mb-8">
        <div class="relative h-[200px]">
            <img src="" alt="aboutUsBanner" class="w-full h-[200px] object-cover" id="aboutUsBanner">
            <h3 class="text-3xl text-white font-bold absolute top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4"
                id="aboutUsTitle"></h3>
        </div>
    </div>
    <div class="container">

        <div class="about-wrapper flex justify-between gap-x-8 py-12">

            <div class="w-full">
                <h3 class="text-2xl font-bold mb-3 text-center">Company History</h3>
                <p class="text-xl text-justify mb-3" id="companyHistory"></p>
            </div>

        </div>
        <div class="about-wrapper flex justify-between gap-x-8 py-12">
            <div class="w-full">
                <h3 class="text-2xl font-bold mb-3 text-center">Our Vision</h3>
                <p class="text-xl text-justify mb-3" id="companyVision"></p>
            </div>

        </div>
        <div class="about-wrapper flex justify-between gap-x-8 py-12">
            <div class="w-full">
                <h3 class="text-2xl font-bold mb-3 text-center">Our Mission</h3>
                <p class="text-xl text-justify mb-3" id="companyMission"></p>
            </div>

        </div>


        <div class="mb-12 bg-zinc-300 rounded-lg p-9">
            <div class="text-center py-4 mb-6">
                <h3 class="text-3xl text-purple-700 font-extrabold">Companies Believe in Us</h3>
            </div>
            <div id="companyBelieves" class="flex justify-around"></div>
        </div>

    </div>
</section>

<script>
    async function getAboutUsPageDetails() {
        showLoader();
        let res = await axios.get('/dashboard/admin/aboutUsPageDetail');
        hideLoader();

        res.data.map(item => {

            document.getElementById('aboutUsBanner').src = item.image_url;
            document.getElementById('aboutUsTitle').innerText = item.title;
            document.getElementById('companyHistory').innerText = item.company_history;
            document.getElementById('companyVision').innerText = item.company_vision;
            document.getElementById('companyMission').innerText = item.company_mission;
        })
    }

    getAboutUsPageDetails();


    async function getTopCompanies() {
        let res = await axios.get('/topcompanies');


        updateTopCompanies(res.data);
    }

    function updateTopCompanies(data) {
        const topCompanies = data.map(item => {
            return `<div class="bg-emerald-800 p-11 rounded-lg"><span class="text-xl font-semibold text-white">${item}</span></div>`
        }).join('')
        document.getElementById('companyBelieves').innerHTML = topCompanies;
    }
    getTopCompanies();


</script>
