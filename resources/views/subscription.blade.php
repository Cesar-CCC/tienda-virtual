<x-app-layout>
    <x-slot name="header">

        <div class="flex ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
              </svg>

        <h2 class="font-semibold text-md text-gray-800 leading-tight px-2 py-1">
            {{ __('Pasarela de pago') }}
        </h2></div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-3">
                    <div class="p-2">
                        <img src="https://banbif.solven.pe/img/banbif/tarjetas_banbif.png" alt="">
                    </div>
                    <div class="col-span-2">
                        <div class="card p-6">
                        <div class="card-header">
                            <div>
                            <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><strong>Producto: </strong>{{ $plan->name }}</span>
                            </div>
                            <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><strong>Precio: </strong>${{ number_format($plan->price, 2) }} </span>
                        </div>

                        <div class="card-body">

                            <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">

                                <div class="row">
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="form-group">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres Completos</label>
                                            <input type="text" name="name" id="card-holder-name"
                                            value=""
                                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="abcdef@gmail.com" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="form-group">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white py-2">Datos de la targeta</label>
                                            <div id="card-element"> </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 mt-3 grid justify-end">
                                        <hr>
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="card-button"
                                            data-secret="{{ $intent->client_secret }}">Pagar</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div></div>
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
