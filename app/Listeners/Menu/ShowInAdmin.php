<?php

namespace App\Listeners\Menu;

use App\Events\Menu\AdminCreated as Event;
use App\Traits\Permissions;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class ShowInAdmin
{
    use Permissions;

    /**
     * Handle the event.
     *
     * @param    $event
     * @return void
     */
    public function handle(Event $event)
    {
        $menu = $event->menu;

        $attr = ['icon' => ''];

        $menu->addDivider();

        // Dashboards
        $title = trim(trans_choice('general.dashboards', 1));
        if ($this->canAccessMenuItem($title, 'read-common-dashboards')) {
            $inactive = ('dashboard' != Route::currentRouteName()) ? true : false;
            $menu->route('dashboard', $title, [], 10, ['icon' => 'speed', 'inactive' => $inactive]);
        }

        $title = trim(trans_choice('general.customers', 2));
        if ($this->canAccessMenuItem($title, 'read-sales-customers')) {
            $menu->route('customers.index', $title, [], 20, ['icon' => 'people']);
        }

        $title = trim(trans_choice('general.employees', 2));
        if ($this->canAccessMenuItem($title, 'read-employee')) {
            $menu->route('employees.index', $title, [], 20, ['icon' => 'people']);
        }

        // Items
        $title = trim(trans_choice('general.items', 2));
        if ($this->canAccessMenuItem($title, 'read-common-items')) {
            $menu->route('items.index', $title, [], 30, ['icon' => 'inventory_2']);
        }
        $menu->addDivider(40);

        //Sales
        $title = trim(trans_choice('general.invoices', 2));
        if ($this->canAccessMenuItem($title, 'read-sales-invoices')) {
            $menu->route('invoices.index', $title, [], 50, ['icon' => 'receipt']);
        }
        //Sales
        $title = trim(trans_choice('general.recurring_invoices', 2));
        if ($this->canAccessMenuItem($title, 'read-sales-invoices')) {
            $menu->route('recurring-invoices.index', $title, [], 60, ['icon' => 'receipt']);
        }

        $title = trim(trans('general.title.new', ['type' => trans_choice('general.incomes', 1)]));
        if ($this->canAccessMenuItem($title, 'read-sales-invoices')) {
            $menu->route('transactions.create', $title, ['type' => 'income'], 61, ['icon' => 'control_point']);
        }
        $menu->addDivider(70);

        $title = trim(trans('general.title.new', ['type' => trans_choice('general.expenses', 1)]));
        if ($this->canAccessMenuItem($title, 'create-banking-transactions')) {
            $menu->route('transactions.create', $title, ['type' => 'expense'], 70, ['icon' => 'control_point']);
        }
        $title = trim(trans('general.title.new', ['type' => trans_choice('general.recurring_expenses', 1)]));
        if ($this->canAccessMenuItem($title, 'create-banking-transactions')) {
            $menu->route('recurring-transactions.create', $title, ['type' => 'expense-recurring'], 80, ['icon' => 'control_point']);
        }
        $menu->addDivider(90);

        $title = trim(trans_choice('general.transactions', 2));
        if ($this->canAccessMenuItem($title, 'read-banking-transactions')) {
            $menu->route('transactions.index', $title, [], 100, ['icon' => 'receipt_long']);
        }

        $menu->addDivider(110);

        // Purchases
        $title = trim(trans_choice('general.bills', 2));
        if ($this->canAccessMenuItem($title, 'read-purchases-bills')) {
            $menu->route('bills.index', $title, [], 110, ['icon' => 'redeem']);
        }
        $title = trim(trans_choice('general.vendors', 2));
        if ($this->canAccessMenuItem($title, 'read-purchases-vendors')) {
            $menu->route('vendors.index', $title, [], 120, ['icon' => 'storefront']);
        }

        // Banking
        $title = trim(trans('general.banking'));
        if ($this->canAccessMenuItem($title, ['read-banking-accounts', 'read-banking-transfers', 'read-banking-transactions', 'read-banking-reconciliations'])) {
            $menu->dropdown($title, function ($sub) use ($attr) {
                $title = trim(trans_choice('general.accounts', 2));
                if ($this->canAccessMenuItem($title, 'read-banking-accounts')) {
                    $sub->route('accounts.index', $title, [], 10, $attr);
                }

                $title = trim(trans_choice('general.transfers', 2));
                if ($this->canAccessMenuItem($title, 'read-banking-transfers')) {
                    $sub->route('transfers.index', $title, [], 30, $attr);
                }

                $title = trim(trans_choice('general.reconciliations', 2));
                if ($this->canAccessMenuItem($title, 'read-banking-reconciliations')) {
                    $sub->route('reconciliations.index', $title, [], 40, $attr);
                }
            }, 130, [
                'title' => $title,
                'icon' => 'account_balance',
            ]);
        }

        // Reports
        $title = trim(trans_choice('general.reports', 2));
        if ($this->canAccessMenuItem($title, 'read-common-reports')) {
            $menu->route('reports.index', $title, [], 150, ['icon' => 'donut_small']);
        }

//        // Reports
//        $title = trim(trans_choice('general.billing', 2));
//        if ($this->canAccessMenuItem($title, 'read-settings-defaults')) {
//            $menu->route('billing.redirect', $title, [], 150, ['icon' => 'invoice']);
//        }

        // Apps
//        $title = trim(trans_choice('general.modules', 2));
//        if ($this->canAccessMenuItem($title, 'read-modules-home')) {
//            $active = (Str::contains(Route::currentRouteName(), 'apps')) ? true : false;
//            $menu->route('apps.home.index', $title, [], 80, ['icon' => 'rocket_launch', 'active' => $active]);
//        }
    }
}
