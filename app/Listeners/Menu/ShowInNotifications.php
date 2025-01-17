<?php

namespace App\Listeners\Menu;

use App\Events\Menu\NotificationsCreated as Event;
use App\Traits\Modules;
use App\Utilities\Versions;
use Illuminate\Notifications\DatabaseNotification;

class ShowInNotifications
{
    use Modules;

    /**
     * Handle the event.
     *
     * @param    $event
     * @return void
     */
    public function handle(Event $event)
    {
        if (user()->cannot('read-notifications')) {
            return;
        }

        // Notification tables
        $notifications = collect();

        // Update notifications
//        if (user()->can('read-install-updates')) {
//            $updates = Versions::getUpdates();
//
//            foreach ($updates as $key => $update) {
//                $prefix = ($key == 'core') ? 'core' : 'module';
//                $name = ($prefix == 'core') ? 'Akaunting' : module($key)->getName();
//
//                $new = new DatabaseNotification();
//                $new->id = $key;
//                $new->type = 'updates';
//                $new->notifiable_type = "users";
//                $new->notifiable_id = user()->id;
//                $new->data = [
//                    'title' => $name . ' (v' . $update . ')',
//                    'description' => '<a href="' . route('updates.index') . '">' . trans('install.update.' . $prefix, ['module' => $name]) . '</a>',
//                ];
//                $new->created_at = \Carbon\Carbon::now();
//
//                $notifications->push($new);
//            }
//        }

        // New app notifcations
//        $new_apps = $this->getNotifications('new-apps');
//
//        foreach ($new_apps as $key => $new_app) {
//            if (setting('notifications.' . user()->id . '.' . $new_app->alias)) {
//                unset($new_apps[$key]);
//
//                continue;
//            }
//
//            $app_url = route('apps.app.show', [
//                'alias'         => $new_app->alias,
//                'utm_source'    => 'notification',
//                'utm_medium'    => 'app',
//                'utm_campaign'  => str_replace('-', '_', $new_app->alias),
//            ]);
//
//            $new = new DatabaseNotification();
//            $new->id = $key;
//            $new->type = 'new-apps';
//            $new->notifiable_type = "users";
//            $new->notifiable_id = user()->id;
//            $new->data = [
//                'title' => $new_app->name,
//                'description' => trans('notifications.new_apps', ['app' => $new_app->name, 'url' => $app_url]),
//                'alias' => $new_app->alias,
//            ];
//            $new->created_at = $new_app->started_at->date;
//
//            $notifications->push($new);
//        }

        $unReadNotifications = user()->unReadNotifications;

        foreach ($unReadNotifications as $unReadNotification) {
            $notifications->push($unReadNotification);
        }

        $event->notifications->notifications = $notifications;
    }
}
