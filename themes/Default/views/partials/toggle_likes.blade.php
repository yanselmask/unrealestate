<script>
    function toggleFor(e, value) {
        let currentUrl = new URL(@js(request()->fullUrl()))
        currentUrl.searchParams.set('for', value);

        // Redirecciona a la nueva URL
        window.location.href = currentUrl.toString();
    }

    let sortBySearch = document.getElementById('sortby_search');

    if (sortBySearch) {
        sortBySearch.addEventListener('change', function(e) {

            let currentUrl = new URL(@js(request()->fullUrl()))
            currentUrl.searchParams.set('sort_by', e.target.value);

            // Redirecciona a la nueva URL
            window.location.href = currentUrl.toString();
        })
    }

    let btnsLikeProperties = document.querySelectorAll('.like-properties-btn');
    btnsLikeProperties.forEach((btn) => {
        btn.addEventListener('click', async (e) => {
            let req = await fetch(`/properties/like/${btn.getAttribute('data-model')}`, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": @js(csrf_token())
                }
            });
            let res = await req.json()

            if (res.status == 1) {
                btn.classList.toggle('bg-primary');
                btn.classList.toggle('text-white');
            }

        })
    })
    let btnsLikeReviews = document.querySelectorAll('.like-reviews-btn');
    btnsLikeReviews.forEach((btn) => {
        btn.addEventListener('click', async (e) => {
            let req = await fetch(`/review/like/${btn.getAttribute('data-model')}`, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": @js(csrf_token())
                }
            });
            let res = await req.json()

            if (res.status == 1) {
                btn.getElementsByTagName('span')[0].innerHTML = res.count;
                btn.classList.toggle('text-success');
            }

        })
    })
</script>
