<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return view('pages.My_Classes.My_Classes', compact('My_Classes', 'Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreClassroom $request)
    {
        // $this->validate($request, [
        //     'Name' => 'required',
        //     'Name_class_en' => 'required',
        // ], [
        //     'Name.required' => trans('validation.required'),
        //     'Name_class_en.required' => trans('validation.required'),
        // ]);

        $List_Classes = $request->List_Classes;
        try {
            $validated = $request->validated();
            foreach ($List_Classes as $List_Class) {
                $My_Classes = new Classroom();

                $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];

                $My_Classes->Grade_id = $List_Class['Grade_id'];

                $My_Classes->save();
            }
            toastr()->success(trans('messages.success'));

            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        try {

            $Classroom = Classroom::findorFail($request->id);
            $Classroom->update([
                $Classroom->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Classroom->Grade_id = $request->Grade_id,
            ]);
            toastr()->success(trans('messages.Update'));

            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $Classroom = Classroom::findorFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('classrooms.index');
    }

    public function delete_All(Request $request)
    {
        $Delete_All_id = explode(',', $request->delete_all_id);

        Classroom::whereIn('id', $Delete_All_id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('classrooms.index');
    }

    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('Grade_id', $request->Grade_id)->get();

        return view('Pages.My_Classes.My_Classes', compact('Grades'))->withDetails($Search);

    }

}