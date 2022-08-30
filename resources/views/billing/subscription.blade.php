<x-layouts.admin>
    <x-slot name="title">
        Subscription
    </x-slot>

    <x-slot name="content">
        <div class="mt-5">
            @if(company()->subscribed())
                Subscribed to starter
            @else
                <x-button onclick="checkout()">
                    Subscribe to Starter
                </x-button>
            @endif
            <div class="mt-5">
                <a href="{{route('billing.redirect')}}">Manage billing on Stripe</a>
            </div>
        </div>
    </x-slot>


    @push('scripts')
        <script src="https://js.stripe.com/v3/" defer></script>

        <script>
            function checkout() {
                console.log('test')
                window
                    .Stripe('{{$stripeKey}}')
                    .redirectToCheckout({
                        sessionId: '{{$sessionId}}',
                    })
                    .then(function (result) {
                        console.error('result', result);
                    });
            }
        </script>
    @endpush
</x-layouts.admin>
