<x-layouts.admin>
    <x-slot name="title">
        {{ trans('general.title.edit', ['type' => trans_choice('general.employees', 1)]) }}
    </x-slot>

    <x-slot name="favorite"
        title="{{ trans('general.title.edit', ['type' => trans_choice('general.employees', 1)]) }}"
        icon="account_balance"
        route="employees.edit"
    ></x-slot>

    <x-slot name="content">
        <x-form.container>
            <x-form id="employee" method="PATCH" :route="['employees.update', $employee->id]" :model="$employee">
                <x-form.group.switch name="enabled" label="{{ trans('general.enabled') }}" />

                <x-form.section>
                    <x-slot name="head">
{{--                        <x-form.section.head title="{{ trans('general.general') }}" description="{{ trans('accounts.form_description.general') }}" />--}}
                    </x-slot>

                    <x-slot name="body">

                        <x-form.group.text name="first_name" label="{{ trans('general.first_name') }}" form-group-class="sm:col-span-6" />

                        <x-form.group.text name="last_name" label="{{ trans('general.last_name') }}" form-group-class="sm:col-span-6" />

                        <x-form.group.text name="personal_number" label="{{ trans('general.personal_number') }}" form-group-class="sm:col-span-6" />

{{--                        <x-form.group.money name="opening_balance" label="{{ trans('accounts.opening_balance') }}" value="0" :currency="$currency" dynamicCurrency="currency" />--}}

                    </x-slot>
                </x-form.section>

                <x-form.section>
                    <x-slot name="head">
{{--                        <x-form.section.head title="{{ trans_choice('accounts.banks', 1) }}" description="{{ trans('accounts.form_description.bank') }}" />--}}
                    </x-slot>

                    <x-slot name="body">
                        <x-form.group.date
                            name="birth_date"
                            label="{{ trans('general.birth_date') }}"
                            icon="calendar_today"
                            show-date-format="{{ company_date_format() }}"
                            date-format="Y-m-d"
                            autocomplete="off"
                            change="setBirthDate"
                            not-required
                        />

                        <x-form.group.text name="bank_account" label="{{ trans('general.bank_account') }}" not-required />

                        <x-form.group.text name="occupation" label="{{ trans('general.occupation') }}" not-required />

                        <x-form.group.email name="address" label="{{ trans('general.address') }}" not-required />

                        <x-form.group.text name="email" label="{{ trans('general.email') }}" not-required />

                        <x-form.group.text name="phone" label="{{ trans('general.phone') }}" not-required />

                        <x-form.group.number name="salary" label="{{ trans('general.salary') }}" not-required />

                        @if(!$type || $type->value == \App\Enums\EmploymentHistoryType::SIGN_OUT->value)
                            <x-form.group.date
                                name="sign_up_employment_history"
                                label="{{ trans('general.sign_up_employment_history') }}"
                                icon="calendar_today"
                                show-date-format="{{ company_date_format() }}"
                                date-format="Y-m-d"
                                autocomplete="off"
                                change="setSignUpEmploymentHistory"
                                not-required
                            />
                        @else
                            <x-form.group.date
                                name="sign_out_employment_history"
                                label="{{ trans('general.sign_out_employment_history') }}"
                                icon="calendar_today"
                                show-date-format="{{ company_date_format() }}"
                                date-format="Y-m-d"
                                autocomplete="off"
                                change="setSignOutEmploymentHistory"
                                not-required
                            />
                        @endif

                    </x-slot>
                </x-form.section>

                <x-form.section>
                    <x-slot name="foot">
                        <x-form.buttons cancel-route="employees.index" />
                    </x-slot>
                </x-form.section>
            </x-form>
        </x-form.container>
    </x-slot>

    <x-script file="employees" />
</x-layouts.admin>
