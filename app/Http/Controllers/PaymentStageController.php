<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PaymentStage;

use App\Models\PaymentPlan;

use Carbon\Carbon;

class PaymentStageController extends Controller
{
    //

    public function create_payment_stage(Request $request)
    {
        # code...


        // return $request->all();

        $no_stages = $request->no_stages;

        $unit_percent = 100/$no_stages;

        $unit_amount = $request->amount/$no_stages;

        $month_unit = $request->no_months / $no_stages;

        // return $month_unit;

        $start_date = Carbon::parse($request->start_date);

        $aboundary_date = $start_date;

        // return $aboundary_date;

        $bboundary_date = Carbon::parse($aboundary_date)->addMonths($month_unit);

        $payment_plan = PaymentPlan::find($request->payment_plan_id);


        PaymentStage::where('user_id', $payment_plan->user_id)->where('payment_plans_id', $request->payment_plan_id)->delete();
        // return $bboundary_date;


        for ($i=1; $i <= $no_stages ; $i++) { 

           

                    
         
                    //code...
                
                        //code...
                        PaymentStage::create([
                            'user_id' => $payment_plan->user_id,
                            'payment_plans_id' => $request->payment_plan_id,
                            'stage' => $i,
                            'percent' => $unit_percent,
                            'amount' => $unit_amount,
                            'aboundary_date' => $aboundary_date,
                            'bboundary_date' => $bboundary_date,
                            'amount_remitted' => 0,
                            'status' => 'active',
                        ]);

                        // return $aboundary_date;
                       
    
                        $aboundary_date = $bboundary_date;

                        
                        $bboundary_date = Carbon::parse($aboundary_date)->addMonth($month_unit);
                        
                       



                  
               
        }


        $payment_stages = PaymentStage::where('payment_plans_id', $request->payment_plan_id)->get();


        return $payment_stages;




    }

    public function payment_plan_stages(Request $request)
    {
        # code...

        $payment_stages = PaymentStage::where('payment_plans_id', $request->payment_plan_id)->get();

        return $payment_stages;
    }


    public function update_payment_stage(Request $request)
    {
        
        
        try {
            //code...
            $payment_stage = PaymentStage::where('id', $request->id)->update([
                'percent' => $request->percent,
                'amount' => $request->amount,
                'aboundary_date' => Carbon::parse($request->aboundary),
                'bboundary_date' => Carbon::parse($request->bboundary),
                'payment_plans_id' => $request->payment_plan_id,
            ]);
    
            return $payment_stage;

        } catch (\Throwable $th) {
            //throw $th;

            return $th;
        }


    }
}
