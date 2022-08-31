<x-layouts.admin>
    <x-slot name="title">
        Subscription
    </x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mt-6">

            @foreach($packages as $package)
                <div @class([
                        'border'=> $package['featured'],
                        'p-2 rounded-md'
                    ])>
                    <h1 class="text-xl mb-2"> {{$package['name']}}</h1>
                    <div class="text-8xl font-bold px-4  py-6 text-blue">
                        <div @class(["line-through",'text-gray-500'=>$package['monthly_price'],  'text-gray-50'=> !$package['monthly_price']]) >
                            <span class="text-xl ">€</span><span
                                class="text-3xl ">{{number_format($package['monthly_price'], 2)}}</span>
                        </div>
                        @if($package['monthly_promo_price'])
                            <span class="text-4xl">€</span>{{number_format($package['monthly_promo_price'], 2)}}
                        @else
                            Free
                        @endif
                    </div>
                    <x-button
                        class="w-full mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700"
                        override="class">Купи веднаш
                    </x-button>
                    <div @class(['invisible'=> !$package['trial_days']])>
                        <x-button
                            class="w-full mb-2 px-3 py-1.5  rounded-xl text-sm font-medium leading-6 bg-gray-100 hover:bg-gray-200"
                            override="class">30-дневен период
                        </x-button>
                    </div>
                    <div class="text-sm my-2"> {{$package['name']}} вклучува:</div>
                    <ul>
                        @foreach($package['features']['mk'] as $feature)
                            <li class="text-gray-500 text-xs">
                                {{$feature}}
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-3">Support:</div>
                    <div class="text-xs">{{implode(', ', $package['support'])}}</div>
                </div>

            @endforeach

        </div>
        {{--        <div class="mt-5">--}}
        {{--            @if(company()->subscribed())--}}
        {{--                Subscribed to starter--}}
        {{--            @else--}}
        {{--                <x-button onclick="checkout()">--}}
        {{--                    Subscribe to Starter--}}
        {{--                </x-button>--}}
        {{--            @endif--}}
        {{--            <div class="mt-5">--}}
        {{--                <a href="{{route('billing.redirect')}}">Manage billing on Stripe</a>--}}
        {{--            </div>--}}
        {{--        </div>--}}
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
