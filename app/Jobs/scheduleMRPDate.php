<?php

namespace App\Jobs;

use App\mrp;
use App\MrpRawMaterial;
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
        $checkMrpRawMaterial = MrpRawMaterial::all();
        $first_day = today();
        if(count($checkMRP) == 0 && count($checkMrpRawMaterial) == 0){
            foreach($projects as $project){
                // dd($project->materials);
                foreach($project->materials as $item){
                    for($i=1; $i<=31; $i++){
                        $mrp_raw_material = new MrpRawMaterial;
                        $mrp_raw_material->date = $first_day;
                        $mrp_raw_material->product_id = $project->product_id;
                        $mrp_raw_material->raw_material_id = $item->id;
                        $mrp_raw_material->save();
                        //Add one day onto the timestamp / counter
                        $first_day = $first_day->addDays(1);
                    }
                    $first_day = today();
                }
                $first_day = today();
                for($i=1; $i<=31; $i++){
                    $mrp = new mrp;
                    $mrp->date = $first_day;
                    $mrp->product_id = $project->product_id;
                    $mrp->save();
                    //Add one day onto the timestamp / counter
                    $first_day = $first_day->addDays(1);
                }
                $first_day = today();
            } 
        }
        else{
            foreach($projects as $project){
                $latest = today()->addDays(30);
                $each_date = mrp::where('date', $latest)->where('product_id', $project->product_id)->get();
                if(count($each_date) == 0){
                    foreach($project->materials as $item){
                        $mrp_raw_material = new MrpRawMaterial;
                        $mrp_raw_material->date = $latest;
                        $mrp_raw_material->product_id = $project->product_id;
                        $mrp_raw_material->raw_material_id = $item->id;
                        $mrp_raw_material->save();
                    }
                    $mrp = new mrp;
                    $mrp->date = $latest;
                    $mrp->product_id = $project->product_id;
                    $mrp->save();
                }
            }
        }
    }
}
