
<div class="container">
    <div class="flex justify-between items-center py-14 gap-x-2">
        <div class="w-3/5">
            <h1 class="text-5xl pb-4 max-w-lg" id="heroTitle"></h1>
            <p class="text-xl pb-11 pr-5" id="heroDetails"></p>
            <div>
                <a href="{{route('page.alljobs')}}"
                    class="text-white font-semibold bg-slate-800 py-3 px-5 rounded-lg hover:bg-zinc-600">Explore Now</a>
            </div>
        </div>
        <div class="w-2/5 ">
            <picture>
                <img src="" alt="jobpulseherobanner.png" id="heroImage">
            </picture>
        </div>
    </div>
</div>

<script>

    async function  getHomePageDetails() {

        let res = await axios.get('/dashboard/admin/homePageDetail');

        res.data.map(item=>{

            document.getElementById('heroTitle').innerText = item.hero_title;
            document.getElementById('heroDetails').innerText = item.hero_details;
            document.getElementById('heroImage').src = item.hero_image_url;
        })
    }

    getHomePageDetails();
</script>
