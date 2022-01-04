<?php

namespace App\Http\Livewire;

use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NavbarNotification extends Component
{
    public function render()
    {
        return view('livewire.navbar-notification', [
            'expiryMedicines' => $this->expiryMedicines,
            'totalNotifications' => $this->totalNotifications,
        ]);
    }

    public function getExpiryMedicinesProperty()
    {
        return Medicine::select('expiration_day',
                'code',
                'name',
                DB::raw('SUM(stock) as stockCount'),
                DB::raw('COUNT(id) as bundleCount')
            )
            ->where('expiration_day', '<=', now()->addDays(2))
            ->where('isExpired', 0)
            ->groupBy('code')
            ->get();
    }

    public function getTotalNotificationsProperty()
    {
        return Medicine::where('expiration_day', '<=', now()->addDays(2))
        ->where('isExpired', 0)
        ->groupBy('code')
        ->get()
        ->count();
    }
}
