<x-layouts.admin>
    <x-slot name="title">
        {{ trans('general.title.edit', ['type' => trans_choice('general.salary', 1)]) }}
    </x-slot>


    <x-slot name="content">
        <x-form.container>
            <x-form id="salary" method="PATCH"
                    :route="['employees.salaries.update', [$salary->employee_id, $salary->id]]" :model="$salary">

                <x-form.section>

                    <x-slot name="body">

                        <x-form.group.text name="amount" label="{{ trans('general.amount') }}"
                                           form-group-class="sm:col-span-6"/>


                    </x-slot>
                </x-form.section>

                <x-form.section>
                    <x-slot name="foot">
                        <x-form.buttons :cancel-route="['employees.show', $salary->employee_id]"/>
                    </x-slot>
                </x-form.section>
            </x-form>
        </x-form.container>
    </x-slot>

    <x-script file="salaries"/>
</x-layouts.admin>
