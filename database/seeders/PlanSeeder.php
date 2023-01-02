<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name' => 'iphone 11 pro',
                'slug' => 'iphone',
                'stripe_plan' => 'price_1MKtVkEyT1xhXXEmcLZXFPz4',
                'price' => 20000,
                'description' => 'iphonecscsc'
            ],
            [
                'name' => 'mac',
                'slug' => 'mac',
                'stripe_plan' => 'price_1MKtWoEyT1xhXXEmKaE0hPyZ',
                'price' => 20,
                'description' => 'mac'
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
