<x-layouts.admin>
    <x-slot name="title">
        {{ trans_choice('general.employees', 2) }}
    </x-slot>

    <x-slot name="favorite"
            title="{{ trans_choice('general.employees', 2) }}"
            icon="account_balance"
            route="employees.index"
    ></x-slot>

    <x-slot name="buttons">
        @can('create-employee')
            <x-link href="{{ route('employees.create') }}" kind="primary">
                {{ trans('general.title.new', ['type' => trans_choice('general.employees', 1)]) }}
            </x-link>
        @endcan
    </x-slot>

    <x-slot name="content">
        <x-index.container>
                        <x-index.search
                            search-string="App\Models\Employee"
                            bulk-action="App\BulkActions\Employees"
                        />

            <x-table>
                <x-table.thead>
                    <x-table.tr class="flex items-center px-1">

                        <x-table.th class="ltr:pr-6 rtl:pl-6 hidden sm:table-cell" override="class">
                            <x-index.bulkaction.all/>
                        </x-table.th>


                        <x-table.th class="w-3/12 sm:w-6/12">
                            <x-slot name="first">
                                <x-sortablelink column="first_name" title="{{ trans('general.first_name') }}"/>
                            </x-slot>
                        </x-table.th>

                        <x-table.th class="w-3/12 sm:w-6/12">
                            <x-slot name="first">
                                <x-sortablelink column="last_name" title="{{ trans('general.last_name') }}"/>
                            </x-slot>
                        </x-table.th>

                        <x-table.th class="w-3/12 sm:w-6/12">
                            <x-slot name="first">
                                <x-sortablelink column="personal_number"
                                                title="{{ trans('general.personal_number') }}"/>
                            </x-slot>
                        </x-table.th>

                        <x-table.th class="w-3/12 sm:w-6/12">
                            <x-slot name="first">
                                <x-sortablelink column="occupation" title="{{ trans('general.occupation') }}"/>
                            </x-slot>
                        </x-table.th>
                    </x-table.tr>

                </x-table.thead>

                <x-table.tbody>
                    @foreach($employees as $item)
                        <x-table.tr href="{{ route('accounts.show', $item->id) }}">
                            <x-table.td class="ltr:pr-6 rtl:pl-6 hidden sm:table-cell" override="class">
                                <x-index.bulkaction.single id="{{ $item->id }}"
                                                           name="{{ $item->first_name.' '.$item->last_name }}"/>
                            </x-table.td>
                            <x-table.td class="w-3/12 sm:w-6/12 truncate">
                                {{ $item->first_name }}
                            </x-table.td>
                            <x-table.td class="w-3/12 sm:w-6/12 truncate">
                                {{ $item->last_name }}
                            </x-table.td>
                            <x-table.td class="w-3/12 sm:w-6/12 truncate">
                                {{ $item->personal_number }}
                            </x-table.td>
                            <x-table.td class="w-3/12 sm:w-6/12 truncate">
                                {{ $item->occupation }}
                            </x-table.td>
                            <x-table.td kind="action">
                                <x-table.actions :model="$item"/>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>

            <x-pagination :items="$employees"/>
        </x-index.container>
    </x-slot>
    <x-script file="employees" />
</x-layouts.admin>
