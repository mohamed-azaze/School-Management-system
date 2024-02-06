<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.Grades.Grades', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrades $request)
    {

        // if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()) {
        //     return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        // }

        try {

            $validated = $request->validated();
            $Grade = new Grade();
            $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $Grade->Notes = $request->Notes;
            $Grade->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGrades $request, string $id)
    {
        try {

            $validated = $request->validated();
            $Grades = Grade::findorFail($request->id);
            $Grades->update([
                $Grades->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
                $Grades->Notes = $request->Notes,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $MY_Class_id = Classroom::where('Grade_id', $request->id)->pluck('Grade_id');
        if ($MY_Class_id->count() == 0) {
            $Grades = Grade::findorFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('grades.index');
        } else {
            toastr()->success(trans('Grades_trans.delete_Grade_Error'));
            return redirect()->route('grades.index');
        }

    }
}
