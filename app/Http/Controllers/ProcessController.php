<?php

namespace App\Http\Controllers;

use App\Process;
use App\Http\Requests\ProcessRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::orderBy('name')->get();

        return view('process.index.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('process.create.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessRequest $request)
    {
        $inputs = $request->except('_token');
        try {
            DB::transaction(function() use ($inputs) {
                $process = new Process($inputs);
                $process->save();
            });
        } catch(QueryException $ex) {
            return $this->redirectBack();
        } catch(Exception $ex) {
            return $this->redirectBack();
        }

        return redirect()->route('process.index')->with([
            'success' => 'Process successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        return response()->json($process->delete());
    }
}
