<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $plans = Plan::get();

        return view("admin.plans", compact("plans"));
    }

    public function create(Request $request)
    {
        Plan::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'stripe_plan' => $request->stripe_plan,
            'price' => $request->price,
            'description' => $request->description
        ]);
        return redirect('/adminplans');
    }
}
