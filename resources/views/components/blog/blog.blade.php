
<section>
    <div class="text-center mb-8 z-50">
        <div class="relative h-[200px]">
            <img src="" alt="blogBanner"
                class="w-full h-[200px] object-cover" id="blogBanner">
            <h3 class="text-3xl text-white font-semibold absolute top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4"
                id="blogTitle"></h3>
        </div>
    </div>
    <div class="container">        
        <div class="all-cards flex flex-wrap justify-center gap-4 mb-10" id="eachBlogPost">
            
        </div>
    </div>
</section>


<script>
    async function getBlogPageDetails() {
        showLoader();
        let res = await axios.get('/dashboard/admin/blogPageDetail');
        hideLoader();
        res.data.map(item => {

            document.getElementById('blogBanner').src = item.blog_banner_url;
            document.getElementById('blogTitle').innerText = item.blog_title;
        })
    }

    getBlogPageDetails();


    async function getBlogPosts() {
        let res = await axios.get('/dashboard/admin/allPostedBlogs');
        updateBlogPost(res.data);

    }

    function updateBlogPost(data){
        if(data.data.length === 0){
            document.getElementById('eachBlogPost').innerHTML = `<div><h3 class="text-lg font-semibold">No Blogs Found!</h3></div>`
        } else {
            const blogPost = data.data.map(item=>{
                return `<div
                class="max-w-lg bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-navShadow">
                <picture>
                    <img class="rounded-t-lg w-full" src="${item.image}" alt="noImage" id="blogPostImg"/>
                </picture>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${item.title}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">${item.content}</p>
    
                </div>
            </div>`
            }).join('');

            document.getElementById('eachBlogPost').innerHTML = blogPost;
        }
    }

    getBlogPosts();
</script>
