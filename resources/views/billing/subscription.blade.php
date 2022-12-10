<x-layouts.admin>
    <x-slot name="title">
        @lang('billing.subscription')
    </x-slot>
    <x-slot name="buttons">
        <a href="{{route('billing.redirect')}}">@lang('billing.stripe_dashboard')</a>
    </x-slot>

    <x-slot name="content">
        <div class="grid mt-10">
            @if(!company()->stripe_plan_id)
                Нема доделено план од администратор.
            @elseif(company()->subscribed())
                <div class="mb-2">Активна претплата</div>

                <x-form method="PATCH" url="/{{company_id()}}/billing/cancel">
                    <x-button
                        type="submit"
                        class=" mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700"
                        override="class">
                        Откажи
                    </x-button>
                </x-form>
            @elseif(company()->subscription() && company()->subscription()->onGracePeriod())
                <div class="mb-2">Активирај претплата повторно</div>

                <x-form method="PATCH" url="/{{company_id()}}/billing/resume">
                    <x-button
                        type="submit"
                        class=" mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700"
                        override="class">
                        Претплати се
                    </x-button>
                </x-form>
            @else
              <div>
                  <x-button
                      onclick="checkout()"
                      class=" mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700"
                      override="class">
                      Претплати се
                  </x-button>
              </div>
            @endif
        </div>

    </x-slot>
    {{--    <x-contacts.script type="customer"/>--}}
    <x-script  file="billing" />



    @push('scripts')
        <script src="https://js.stripe.com/v3/" defer></script>

        <script>
            const checkout = () => {
                fetch('/{{company_id()}}/billing/subscribe', {
                    headers: {
                        'Content-Type': "application/json",
                        'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        'Accept': "application/json"
                    },
                    method: "POST"
                })
                    .then(a => a.json())
                    .then(a => {
                        window
                            .Stripe('{{$stripeKey}}')
                            .redirectToCheckout({
                                sessionId: a.session_id,
                            })
                            .then(function (result) {
                                console.error('result', result);
                            });
                    })


            }
        </script>
    @endpush
</x-layouts.admin>
