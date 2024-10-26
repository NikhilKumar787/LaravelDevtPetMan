<?php

namespace App\Observers;

use App\Models\Customer;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class CustomerActionObserver
{
    public function created(Customer $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Customer'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
