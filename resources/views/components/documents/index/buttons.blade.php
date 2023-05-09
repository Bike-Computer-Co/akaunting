@php
$route ='general.title.new';
if($textPage == 'general.invoices' || $textPage  == 'general.bills')
    $route.='_femine';
@endphp

@if ($checkPermissionCreate)
    @can($permissionCreate)
        @if (! $hideCreate)
            <x-link href="{{ route($createRoute) }}" kind="primary">
                {{ trans($route, ['type' => trans_choice($textPage, 1)]) }}
            </x-link>
        @endif
    @endcan
@else
    @if (! $hideCreate)
        <x-link href="{{ route($createRoute) }}" kind="primary">
            {{ trans($route, ['type' => trans_choice($textPage, 1)]) }}
        </x-link>
    @endif
@endif
