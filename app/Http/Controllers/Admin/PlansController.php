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

    public function edit($id){
        $plan = Plan::find($id);
        return view('admin.editPlans', compact('plan'));
    }

    public function update($id, Request $request){
        $plan = Plan::find($id);

        $plan->name = $request->name;
        $plan->slug = $request->slug;
        $plan->stripe_plan = $request->stripe_plan;
        $plan->price = $request->price;
        $plan->description = $request->description;
        $plan->save();

        return redirect('/adminplans');
    }

    public function delete($id){
        Plan::destroy($id);
        return redirect('/adminplans');
    }
}
