<section class="bg-zinc-200">
    <div class="container">
        <div class="pt-5 pb-12">
            <h2 class="text-3xl font-bold text-center">Top Companies</h2>
        </div>
        <div class="pb-12">            
            <div id="topcompaniesthumb" class="flex justify-around"></div>            
        </div>
    </div>
</section>

<script>


    async function getTopCompanies() {
        let res = await axios.get('/topcompanies');
        

        updateTopCompanies(res.data);
    }

    function updateTopCompanies(data){
        const topCompanies = data.map(item=>{
            return `<div class="bg-emerald-800 p-11 rounded-lg"><span class="text-xl font-semibold text-white">${item}</span></div>`
        }).join('')
        document.getElementById('topcompaniesthumb').innerHTML = topCompanies;
    }
    getTopCompanies();


</script>
