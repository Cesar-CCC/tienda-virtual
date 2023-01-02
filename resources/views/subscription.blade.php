<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pasarela de pagos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 px-5">
                            <div class="card">
                                <div class="card-header">
                                    Precio del producto ${{ number_format($plan->price, 2) }} : {{ $plan->name }}
                                    Plan
                                </div>

                                <div class="card-body">

                                    <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">

                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Nombres completos</label>
                                                    <input type="text" name="name" id="card-holder-name"
                                                        class="form-control" value=""
                                                        placeholder="Nombre del titular de la targeta" class="rounded-lg">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Datos de la targeta</label>
                                                    <div id="card-element"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 mt-3 grid justify-end">
                                                <hr>
                                                <button type="submit" class="bg-sky-500 rounded-lg px-4 py-2 text-white" id="card-button"
                                                    data-secret="{{ $intent->client_secret }}">Pagar</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')

        const elements = stripe.elements()
        const cardElement = elements.create('card')

        cardElement.mount('#card-element')

        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('card-button')
        const cardHolderName = document.getElementById('card-holder-name')

        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            cardBtn.disabled = true
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                cardBtn.dataset.secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            )

            if (error) {
                cardBtn.disable = false
            } else {
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit();
            }
        })
    </script>

</x-app-layout>
