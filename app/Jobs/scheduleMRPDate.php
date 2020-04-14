<?php

namespace App\Jobs;

use App\mrp;
use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class scheduleMRPDate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $checkMRP = mrp::all();
        $projects = Project::all();

        $first_day = date('d-m-Y');
        $currentDate = strtotime($first_day);
        if(count($checkMRP) == 0){
            foreach($projects as $project){
                for($i=1; $i<=14; $i++){
                    $formatted = date("d-m-Y", $currentDate);
                    $mrp = new mrp;
                    $mrp->date = $formatted;
                    $mrp->product_id = $project->product_id;
                    $mrp->save();
    
                    //Add one day onto the timestamp / counter.
                    $currentDate = strtotime("+1 day", $currentDate);
                }
                $first_day = date('d-m-Y');
                $currentDate = strtotime($first_day);
            } 
        }
        else{
            foreach($projects as $project){
                $formatted = date("d-m-Y", $currentDate);
                $currentDate = strtotime("+13 day", $currentDate);
                $latest = date('d-m-Y', $currentDate);

                $each_date = mrp::where('date', $latest)->where('product_id', $project->product_id)->get();
                if(count($each_date) == 0){
                    $mrp = new mrp;
                    $mrp->date = $latest;
                    $mrp->product_id = $project->product_id;
                    $mrp->save();
                }
                
                $first_day = date('d-m-Y');
                $currentDate = strtotime($first_day); 
            }
        }
    }
}
