<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class StudentController extends Controller
{

    public function getStudent()
    {
        // return DataTables::eloquent(Student::query())->make(true);
        try
        {
            $students = Student::select(['id', 'studname', 'surname1', 'surname2', 'region', 'city']);

            return DataTables::of($students)
                ->addColumn('action', function ($students) {
                    return '<button student_id="' . $students->id . '" class="btn btn-xs btn-primary edit"><i class="glyphicon glyphicon-edit"></i> Editar</button> <button student_id="' . $students->id . '" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>';
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
        return view('students.index');
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
            Student::create($request->all());

            return response()->json(['success' => 'data is successfully added'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        try
        {
            return response()->json(['success' => 'successfull retrieve data', 'data' => $student->toJson()], 200);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        try
        {

            $student = Student::findOrFail($student->id);
            $student->studname = $request->studname;
            $student->surname1 = $request->surname1;
            $student->surname2 = $request->surname2;
            $student->region = $request->region;
            $student->city = $request->city;
            $student->update();

            return response()->json(['success' => 'data is successfully updated'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try
        {
            Student::destroy($student->id);

            return response()->json(['success' => 'data is successfully deleted'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


}
