<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate policy User
        Gate::define('view_user', 'App\Policies\UserPolicy@view');
        Gate::define('add_user', 'App\Policies\UserPolicy@create');
        Gate::define('edit_user', 'App\Policies\UserPolicy@update');
        Gate::define('delete_user', 'App\Policies\UserPolicy@delete');

        // Gate policy Items
        Gate::define('view_items', 'App\Policies\ItemPolicy@view');
        Gate::define('add_items', 'App\Policies\ItemPolicy@create');
        Gate::define('edit_items', 'App\Policies\ItemPolicy@update');
        Gate::define('delete_items', 'App\Policies\ItemPolicy@delete');

        // Gate Policy Rooms
        Gate::define('view_room', 'App\Policies\RoomPolicy@view');
        Gate::define('add_room', 'App\Policies\RoomPolicy@create');
        Gate::define('edit_room', 'App\Policies\RoomPolicy@update');
        Gate::define('delete_room', 'App\Policies\RoomPolicy@delete');

        // Gate Policy Rooms
        Gate::define('view_gold', 'App\Policies\GoldPolicy@view');
        Gate::define('add_gold', 'App\Policies\GoldPolicy@create');
        Gate::define('edit_gold', 'App\Policies\GoldPolicy@update');
        Gate::define('delete_gold', 'App\Policies\GoldPolicy@delete');

        // Gate Policy Groups
        Gate::define('view_groups', 'App\Policies\GroupPolicy@view');
        Gate::define('add_groups', 'App\Policies\GroupPolicy@create');
        Gate::define('edit_groups', 'App\Policies\GroupPolicy@update');
        Gate::define('delete_groups', 'App\Policies\GroupPolicy@delete');

        // Gate Policy Events
        Gate::define('view_events', 'App\Policies\EventPolicy@view');
        Gate::define('add_events', 'App\Policies\EventPolicy@create');
        Gate::define('edit_events', 'App\Policies\EventPolicy@update');
        Gate::define('delete_events', 'App\Policies\EventPolicy@delete');

        // Gate Policy Events
        Gate::define('view_fees', 'App\Policies\FeePolicy@view');
        Gate::define('add_fees', 'App\Policies\FeePolicy@create');
        Gate::define('edit_fees', 'App\Policies\FeePolicy@update');
        Gate::define('delete_fees', 'App\Policies\FeePolicy@delete');

        // Gate Policy Clubs
        Gate::define('view_clubs', 'App\Policies\ClubPolicy@view');
        Gate::define('add_clubs', 'App\Policies\ClubPolicy@create');
        Gate::define('edit_clubs', 'App\Policies\ClubPolicy@update');
        Gate::define('delete_clubs', 'App\Policies\ClubPolicy@delete');

//        Gate::define('view_club', function ($user) {
//            return $user->checkRolePermisson('view_club');
//        });
//
//        Gate::define('attendance_edit', function ($user) {
//            return $user->checkRolePermisson('attendance_edit');
//        });
//
//        Gate::define('user_level', function ($user) {
//            if ($user->user_level == 1) {
//                return true;
//            } else {
//                return false;
//            }
//        });
    }
}
