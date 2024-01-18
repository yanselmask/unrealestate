<x-master-layout>
    <section class="mb-md-4 row justify-content-center container mt-5 py-5">
        <div class="card col-12 col-md-6">
            <div class="card-header">
                <h5 class="card-title">{{ __('Checkout') }}</h5>
            </div>
            <div class="card-body">
                <!-- Stripe Elements Placeholder -->
                <div id="card-element" class="my-5"></div>

                <button id="card-button" class="btn btn-primary">
                    {{ __('Process Payment') }}
                </button>
            </div>
        </div>
    </section>

    @push('js_vendor')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe(@js(env('STRIPE_KEY')));

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const cardButton = document.getElementById('card-button');

            cardButton.addEventListener('click', async () => {
                cardButton.setAttribute('disabled', true);
                let contentData = new FormData();
                contentData.append('package_id', @js($package->id));
                let url = @js(route('intent.create'));
                let options = {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': @js(csrf_token())
                    },
                    body: contentData
                }
                let req = await fetch(url, options);
                let res = await req.json();

                if (res.error) {
                    cardButton.removeAttribute('disabled')
                }
                if (res.data) {
                    stripe
                        .confirmCardPayment(res.data.client_secret, {
                            payment_method: {
                                card: cardElement,
                                billing_details: {
                                    name: @js(request()->user()?->fullname),
                                },
                            },
                        })
                        .then(async function(result) {
                            if (result.paymentIntent && result.paymentIntent.status == "succeeded") {
                                let bodyContent = new FormData();
                                bodyContent.append('package_id', @js($package->id))
                                bodyContent.append('trx_id', result.paymentIntent.id)
                                let url = @js(route('buy.plan'));
                                let req = await fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': @js(csrf_token())
                                    },
                                    body: bodyContent
                                });
                                let res = await req.json();


                                if (res.data) {
                                    cardButton.innerHTML = `Loading...`
                                    window.location.href = @js(route('home.success'));
                                }

                                if (res.error) {
                                    console.log(res)
                                    cardButton.removeAttribute('disabled')
                                }


                            }

                            if (result.error) {
                                cardButton.removeAttribute('disabled')
                            }
                        });
                }
            })
        </script>
    @endpush
</x-master-layout>
