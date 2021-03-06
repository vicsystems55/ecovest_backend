<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payment_plan()
    {
        return $this->belongsTo('App\Models\PaymentPlan', 'payment_plans_id');
    }
}
