<section>
    <div class="text-center mb-8 relative z-10">
        <div class="relative h-[200px]">
            <img src="" alt="contactBanner" class="w-full h-[200px] object-cover" id="contactBanner">
            <h3 class="text-3xl text-white font-semibold absolute top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4"
                id="contactTitle"></h3>
        </div>
    </div>
    <div class="container">
        <div class="contact-wrapper flex justify-around pb-5 mb-14">
            <div class="contact-us w-1/2 flex flex-col justify-center items-center">
                <div class="bg-zinc-100 rounded-lg p-8">
                    <h4 class="text-2xl text-green-700 font-bold mb-4">Contact Info</h4>
                    <div>
                        <address class="text-lg font-semibold">
                            Address: <span id="address" class="font-medium text-base"></span><br>
                            Phone: <span id="phone" class="font-medium text-base"></span> <br>
                            Tel: <span id="telephone" class="font-medium text-base"></span> <br>
                            Email: <span id="contactEmail" class="font-medium text-base"></span>
                        </address>
                    </div>
                </div>
            </div>
            <div class="w-1/2 text-center bg-green-100 rounded-lg p-5">
                <h3 class="text-2xl text-green-700 font-bold mb-4">Get in Touch</h3>
                <div>
                    <input type="text" placeholder="Your Name" class="w-1/2 mb-3 rounded-md">
                    <input type="email" name="email" id="" placeholder="Your Email"
                        class="w-1/2 mb-3 rounded-md">
                    <input type="text" placeholder="Your Phone" class="w-1/2 mb-3 rounded-md">
                    <input type="text" placeholder="Subject" class="w-1/2 mb-3 rounded-md">
                    <textarea name="" id="" cols="30" rows="5" class="w-1/2 mb-3 rounded-md"
                        placeholder="Write Your Query Here..."></textarea>
                    <div>
                        <a href=""
                            class="bg-rose-500 py-2 px-8 text-white font-semibold rounded-lg hover:bg-rose-800">SEND</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-12 bg-zinc-300 rounded-lg p-9">
            <div class="text-center py-4 mb-6">
                <h3 class="text-3xl text-purple-700 font-extrabold">Companies Believe in Us</h3>
            </div>
            <div id="companyBelieves" class="flex justify-around"></div>
        </div>
    </div>
    </div>
</section>


<script>
    async function getContactPageDetails() {
        showLoader();
        let res = await axios.get('/dashboard/admin/contactUsPageDetail');
        hideLoader();

        res.data.map(item => {

            document.getElementById('contactBanner').src = item.image_url;
            document.getElementById('contactTitle').innerText = item.contact_title;
            document.getElementById('address').innerText = item.address;
            document.getElementById('phone').innerText = item.phone;
            document.getElementById('telephone').innerText = item.telephone;
            document.getElementById('contactEmail').innerText = item.email;
        })
    }

    getContactPageDetails();



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
