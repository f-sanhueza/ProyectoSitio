<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class ProfessorController extends Controller
{

    public function getProfessor()
    {
        // return DataTables::eloquent(Student::query())->make(true);
        try
        {
            $professors = Professor::select(['id', 'names', 'surnames', 'department', 'specialty']);

            return DataTables::of($professors)
                ->addColumn('action', function ($professors) {
                    return '<button professor_id="' . $professors->id . '" class="btn btn-xs btn-primary edit"><i class="glyphicon glyphicon-edit"></i> Editar</button> <button professor_id="' . $professors->id . '" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
                })
                ->make(true);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('professors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            Professor::create($request->all());

            return response()->json(['success' => 'data is successfully added'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        try
        {
            return response()->json(['success' => 'successfull retrieve data', 'data' => $professor->toJson()], 200);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {
        try
        {

            $professor = Professor::findOrFail($professor->id);
            $professor->names = $request->names;
            $professor->surnames = $request->surnames;
            $professor->department = $request->department;
            $professor->specialty = $request->specialty;
            $professor->update();

            return response()->json(['success' => 'data is successfully updated'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        try
        {
            Professor::destroy($professor->id);

            return response()->json(['success' => 'data is successfully deleted'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
