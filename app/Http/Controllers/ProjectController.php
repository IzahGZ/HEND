<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Process;
use App\Product;
use App\Project;
use App\RawMaterial;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ProjectController extends Controller
{
    public function index(){
        $project = Project::all();
        return view('Project.index', compact('project'));
    }

    public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('project.delete',['id'=>$id]);
          return view('Project/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $delete = Project::destroy($id);
           return redirect(route('project.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function create(){
        $products = Product::all();
        $rawMaterials = RawMaterial::with('uoms')->get();
        $process = Process::all();

        return view('Project.create', compact('products', 'rawMaterials', 'process'));
    }

    public function store(ProjectRequest $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $project = new Project;
                $project->code = $request->code;
                $project->product_id = $request->product_id;
                $project->save();

                foreach ($request->material as $material) {
                    $project->materials()->attach($material['id'], [
                        'quantity' => $material['quantity'],
                    ]);
                }

                foreach ($request->process as $process) {
                    $project->processes()->attach($process['process'], [
                        'raw_material_id' => $process['materialId'],
                        'duration' => $process['duration'],
                    ]);
                }
            });
        } catch(Exception $ex) {
            return $this->redirectBack();
        } catch(QueryException $ex) {
            return $this->redirectBack();
        }

        return redirect()
            ->route('project.index')
            ->with('success', 'Project successfully created');
    }

    public function view(Project $Project)
    {
        return view('project.view', compact('Project'));
    }

    public function edit(Project $Project){
        $products = Product::all();
        $rawMaterials = RawMaterial::with('uoms')->get();
        $process = Process::all();

        return view('project.edit', compact('rawMaterials','process', 'products', 'Project'));
    }

    public function update(ProjectRequest $request, Project $Project){
        try {
            DB::transaction(function() use ($request, $Project) {
                $Project->materials()->detach();
                $Project->processes()->detach();

                $Project->code = $request->code;
                $Project->product_id = $request->product_id;
                $Project->save();

                foreach ($request->material as $material) {
                    $Project->materials()->attach($material['id'], [
                        'quantity' => $material['quantity'],
                    ]);
                }

                foreach ($request->process as $process) {
                    $Project->processes()->attach($process['process'], [
                        'raw_material_id' => $process['materialId'],
                        'duration' => $process['duration'],
                    ]);
                }
            });
        } catch(Exception $ex) {
            dd($ex->getMessage());
            return $this->redirectBack();
        } catch(QueryException $ex) {
            dd($ex->getMessage());
            return $this->redirectBack();
        }

        return redirect()
            ->route('project.index')
            ->with('success', 'Project successfully updated');
    }
}
