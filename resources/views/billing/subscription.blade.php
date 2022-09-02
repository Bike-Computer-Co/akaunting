<x-layouts.admin>
    <x-slot name="title">
        @lang('billing.subscription')
    </x-slot>
    <x-slot name="buttons">
        <a href="{{route('billing.redirect')}}">@lang('billing.stripe_dashboard')</a>
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-4 mt-10">
            <div></div>
            <a href="/{{company_id()}}/billing/subscription"
                @class(['text-center mb-2 px-3 py-1.5 rounded-xl text-sm font-medium leading-6','text-white bg-blue hover:bg-blue-700'=> !$yearly])>
                @lang('billing.monthly')
            </a>
            <a href="/{{company_id()}}/billing/subscription?yearly=1"
                @class(['text-center mb-2 px-3 py-1.5 rounded-xl text-sm font-medium leading-6','text-white bg-blue hover:bg-blue-700'=> $yearly])>
                @lang('billing.yearly')

            </a>
            <div></div>
        </div>
        <div class="text-center mt-20">
            Придружи се и добиј 70% попуст <br>
            за првите 3 месеци
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mt-6">

            @foreach($packages as $key=> $package)
                <div @class([
                        'border'=> $package['featured'],
                        'p-2 rounded-md flex flex-col mb-10'
                    ])>
                    <h1 class="text-xl mb-2"> {{$package['name']}}</h1>
                    <div class="text-8xl font-bold px-4  py-6 text-blue">
                        <div @class(["line-through",'text-gray-500'=>$package[$keyword.'_price'],  'text-gray-50'=> !$package[$keyword.'_price']]) >
                            <span class="text-xl ">$</span><span
                                class="text-3xl ">{{number_format($package[$keyword.'_price'], 2)}}</span>
                        </div>
                        {{--                        <div @class(['text-xs', 'text-gray-50'=> !$package[$keyword.'_price']])>--}}
                        {{--                            @if($yearly)--}}
                        {{--                                @lang('billing.first_year',['duration'=>$package[$keyword.'_promo_duration'] ])--}}
                        {{--                            @else--}}
                        {{--                                @lang('billing.first_month',['duration'=>$package[$keyword.'_promo_duration']] )--}}
                        {{--                            @endif--}}
                        {{--                        </div>--}}
                        @if($package[$keyword.'_promo_price'])
                            <span class="text-4xl">$</span>{{number_format($package[$keyword.'_promo_price'], 2)}}
                        @else
                            Free
                        @endif
                        <div class="text-sm text-gray-500">/месечно</div>
                    </div>

                    @if(isset($package[$keyword.'_stripe_id']))
                        @if(company()->subscribedToPrice($package[$keyword.'_stripe_id']))
                            @if(company()->subscribed() && company()->subscription()->onGracePeriod())
                                <x-form method="PATCH" url="/{{company_id()}}/billing/resume">
                                    <x-button
                                        type="submit"
                                        class="w-full mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700"
                                        override="class">
                                        @lang('billing.continue')
                                    </x-button>
                                </x-form>
                            @else
                                <x-button
                                    class="w-full mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700 disabled disabled:bg-blue-400"
                                    disabled="disabled"
                                    override="class">
                                    @lang('billing.selected')
                                </x-button>
                            @endif
                        @else
                            @if(company()->subscribed())
                                <x-form method="PATCH" url="/{{company_id()}}/billing/swap">
                                    <input type="hidden" name="price_id" value="{{$package[$keyword.'_stripe_id']}}">
                                    <x-button
                                        type="submit"
                                        class="w-full mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700"
                                        override="class">

                                        @lang('billing.change')
                                    </x-button>
                                </x-form>
                            @else
                                <x-button
                                    onclick="checkout('{{$package[$keyword.'_stripe_id']}}')"
                                    class="w-full mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700"
                                    override="class">

                                    @lang('billing.buy_now')
                                </x-button>
                            @endif
                        @endif
                        @if(!company()->subscribed())
                            <div @class(['invisible'=> !$package['trial_days']])>
                                <x-button
                                    onclick="checkout('{{$package[$keyword.'_stripe_id']}}', true)"
                                    class="w-full mb-2 px-3 py-1.5  rounded-xl text-sm font-medium leading-6 bg-gray-100 hover:bg-gray-200"
                                    override="class">
                                    @lang('billing.trial_days', ['days'=> $package['trial_days']])
                                </x-button>
                            </div>
                        @endif
                    @else
                        @if(company()->subscribed() && !company()->subscription()->onGracePeriod())
                            <x-form method="PATCH" url="/{{company_id()}}/billing/cancel">
                                <x-button
                                    type="submit"
                                    class="w-full mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700"
                                    override="class">
                                    @lang('billing.change')
                                </x-button>
                            </x-form>
                        @else
                            <x-button
                                class="w-full mb-2 px-3 py-1.5 rounded-xl text-sm text-white font-medium leading-6 bg-blue hover:bg-blue-700 disabled disabled:bg-blue-400"
                                disabled="disabled"
                                override="class">@lang('billing.selected')
                            </x-button>
                        @endif
                    @endif
                    @php
                        $lang = app()->getLocale()  === 'mk-MK' ? 'mk' : 'en';
                    @endphp
                    <ul class="list">
                        @if($key > 0)
                            <li class="text-gray-500 text-xs font-bold mb-1">&#10004; Се
                                од {{$packages[$key-1]['name']}}:
                            </li>
                        @endif
                        @foreach($package['features'][$lang] as $feature)
                            @if($key !== 0 && in_array($feature, $packages[$key-1]['features'][$lang]))
                                @continue
                            @endif
                            <li class="text-gray-500 text-xs mb-1">
                                &#10004;
                                {{$feature}}
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-auto pt-3">@lang('billing.support'):</div>
                    <div class="text-xs">{{implode(', ', $package['support'])}}</div>
                </div>

            @endforeach

        </div>
    </x-slot>
    <x-contacts.script type="customer"/>


    @push('scripts')
        <script src="https://js.stripe.com/v3/" defer></script>

        <script>
            const checkout = (priceId, trial = false) => {
                fetch('/{{company_id()}}/billing/subscribe', {
                    headers: {
                        'Content-Type': "application/json",
                        'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        'Accept': "application/json"
                    },
                    method: "POST",
                    body: JSON.stringify({
                        price_id: priceId,
                        trial
                    })
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
