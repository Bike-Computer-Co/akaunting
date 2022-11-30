<x-layouts.admin>
    <x-slot name="title">
        {{$employee->first_name}} {{$employee->last_name}}
    </x-slot>

    <x-slot name="buttons">
        <x-link href="{{ route('employees.edit', $employee->id) }}">
            {{ trans('general.edit') }}
        </x-link>

    </x-slot>
    <x-slot name="content">
        <x-show.container>
            <x-show.summary>
                <x-show.summary.left>
                    <x-slot name="avatar">
                        {{$employee->first_name[0].$employee->last_name[0]}}
                    </x-slot>
                </x-show.summary.left>

                <x-show.summary.right>
                    @if($employee->salary)
                        <x-slot name="first" amount="{{ $employee->salary }} ден."
                                title="{{ trans('general.salary') }}"></x-slot>
                    @endif
                </x-show.summary.right>

            </x-show.summary>

            <x-show.content>

                <x-show.content.left>
                    <div class="flex flex-col text-sm mb-5">
                        <div class="font-medium">{{ trans('general.name') }}</div>
                        <span>{{ $employee->first_name }} {{ $employee->last_name }}</span>
                    </div>

                    <div class="flex flex-col text-sm mb-5">
                        <div class="font-medium">{{ trans('general.personal_number') }}</div>
                        <span>{{ $employee->personal_number }} {{ $employee->personal_number }}</span>
                    </div>

                    <div class="flex flex-col text-sm mb-5">
                        <div class="font-medium">{{ trans('general.birth_date') }}</div>
                        @if($employee->birth_date)
                            <span>{{ $employee->birth_date }}</span>
                        @else
                            <x-empty-data/>
                        @endif
                    </div>

                    <div class="flex flex-col text-sm mb-5">
                        <div class="font-medium">{{ trans('general.bank_account') }}</div>
                        @if($employee->bank_account)
                            <span>{{ $employee->bank_account }}</span>
                        @else
                            <x-empty-data/>
                        @endif
                    </div>


                    <div class="flex flex-col text-sm mb-5">
                        <div class="font-medium">{{ trans('general.occupation') }}</div>
                        @if($employee->occupation)
                            <span>{{ $employee->occupation }}</span>
                        @else
                            <x-empty-data/>
                        @endif
                    </div>

                    <div class="flex flex-col text-sm mb-5">
                        <div class="font-medium">{{ trans('general.address') }}</div>
                        @if($employee->address)
                            <span>{{ $employee->address }}</span>
                        @else
                            <x-empty-data/>
                        @endif
                    </div>


                    <div class="flex flex-col text-sm mb-5">
                        <div class="font-medium">{{ trans('general.email') }}</div>
                        @if($employee->email)
                            <span>{{ $employee->email }}</span>
                        @else
                            <x-empty-data/>
                        @endif
                    </div>

                    <div class="flex flex-col text-sm mb-5">
                        <div class="font-medium">{{ trans('general.phone') }}</div>
                        @if($employee->phone)
                            <span>{{ $employee->phone }}</span>
                        @else
                            <x-empty-data/>
                        @endif
                    </div>

                </x-show.content.left>

                <x-show.content.right>

                    <x-table>
                        <x-table.thead>
                            <x-table.tr class="flex items-center px-1">

                                <x-table.th class="w-3/12 hidden sm:table-cell">
                                    <x-sortablelink column="month"
                                                    title="{{ trans_choice('general.month', 1) }}"/>
                                </x-table.th>

                                <x-table.th class="w-4/12 lg:w-3/12" kind="amount">
                                    <x-sortablelink column="amount" title="{{ trans('general.amount') }}"/>
                                </x-table.th>
                            </x-table.tr>
                        </x-table.thead>

                        <x-table.tbody>
                            @forelse($salaries as $item)
                                <x-table.tr>

                                    <x-table.td class="w-3/12 hidden sm:table-cell">
                                        <x-date date="{{ $item->month }}"/>
                                    </x-table.td>

                                    <x-table.td class="w-4/12 lg:w-3/12" kind="amount">
                                        <x-money :amount="$item->amount" :currency="$item->currency_code" convert/>
                                    </x-table.td>

                                    <x-table.td kind="action">
                                        <x-table.actions :model="$item"/>
                                    </x-table.td>
                                </x-table.tr>
                            @empty
                                <x-table.tr>
                                    <x-table.td class="w-3/12 hidden sm:table-cell">
                                       No records found
                                    </x-table.td>
                                </x-table.tr>
                            @endforelse
                        </x-table.tbody>
                    </x-table>

                    <x-pagination :items="$salaries"/>

                </x-show.content.right>
            </x-show.content>

        </x-show.container>
    </x-slot>

</x-layouts.admin>
