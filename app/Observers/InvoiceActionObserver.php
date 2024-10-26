<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class InvoiceActionObserver
{
    public function created(Invoice $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Invoice'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
