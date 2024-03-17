<section class="bg-[#28439B]">
    <div class="container">
        <div class="footer-wrapper flex justify-around py-14">
            <div class="footer-logo">
                <div class="flex items-center mb-4">
                    <picture>
                        <img src="" alt="footerLogo"
                            class="max-w-12 mr-3" id="footerLogo">
                    </picture>
                    <div>
                        <span class="text-[#e4ff00] text-2xl font-semibold" id="footerLogoTitle"></span>
                    </div>
                </div>
                <p class="text-base text-slate-200 font-medium">The Ulimate job portal <br> To find best jobs.</p>
            </div>
            <div class="services">
                <h4 class="text-xl text-white mb-3">Get Started</h4>
                <ul>
                    <li class="text-[#6dffff] mb-2"><a href="">Careers</a></li>
                    <li class="text-[#6dffff] mb-2"><a href="">Advertisers</a></li>

                </ul>
            </div>
            <div class="services">
                <h4 class="text-xl text-white mb-3">Employers</h4>
                <ul>
                    <li class="text-[#6dffff] mb-2"><a href="">Account</a></li>
                    <li class="text-[#6dffff] mb-2"><a href="">Get a Free Employer</a></li>
                    <li class="text-[#6dffff] mb-2"><a href="">Employer Center</a></li>
                </ul>
            </div>
            <div class="services">
                <h4 class="text-xl text-white mb-3">Information</h4>
                <ul>
                    <li class="text-[#6dffff] mb-2"><a href="">Help</a></li>
                    <li class="text-[#6dffff] mb-2"><a href="">Terms of Use</a></li>
                    <li class="text-[#6dffff] mb-2"><a href="">Contact Us</a></li>
                </ul>
            </div>
            <div class="services">
                <h4 class="text-xl text-white mb-3">About</h4>
                <ul>
                    <li class="text-[#6dffff] mb-2"><a href="">Explore Us</a></li>
                    <li class="text-[#6dffff] mb-2"><a href="">Blog</a></li>
                    <li class="text-[#6dffff] mb-2"><a href="">Guides</a></li>
                </ul>
            </div>

        </div>
        <div class="social-icons flex justify-center gap-x-5 mb-3">
            <div class="fb">
                <a href=""><i class="fa-brands fa-facebook text-3xl text-lime-50 hover:text-yellow-300"></i></a>
            </div>
            <div class="fb">
                <a href=""><i class="fa-brands fa-x-twitter text-3xl text-lime-50 hover:text-yellow-300"></i></a>
            </div>
            <div class="fb">
                <a href=""><i class="fa-brands fa-instagram text-3xl text-lime-50 hover:text-yellow-300"></i></a>
            </div>
            <div class="fb">
                <a href=""><i class="fa-brands fa-linkedin text-3xl text-lime-50 hover:text-yellow-300"></i></a>
            </div>
        </div>
        <hr>
        <div class="text-md text-center text-slate-50">
            <p class="py-1">Copyright &copy; 2024, All Rights Reserved.</p>
        </div>
    </div>
</section>

<script>
    async function getHomePageDetails() {

        let res = await axios.get('/dashboard/admin/homePageDetail');

        res.data.map(item => {

            document.getElementById('footerLogo').src = item.logo_image_url;
            document.getElementById('footerLogoTitle').innerText = item.logo_title;
        })
    }

    getHomePageDetails();
</script>
