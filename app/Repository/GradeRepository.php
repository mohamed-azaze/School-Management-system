<?php
namespace App\Repository;

use App\Models\Classroom;
use App\Models\Grade;

class GradeRepository implements GradeRepositoryInterface
{

    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.grades', compact('grades'));
    }

    public function store($request)
    {
        try {

            $validated    = $request->validated();
            $grade        = new Grade();
            $grade->name  = ['en' => $request->name_en, 'ar' => $request->name];
            $grade->notes = $request->notes;
            $grade->save();
            toastr()->success(trans('messages.success'));

            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {

            $validated = $request->validated();
            $grades    = Grade::findorFail($request->id);
            $grades->update([
                $grades->name = ['en' => $request->name_en, 'ar' => $request->name],
                $grades->notes = $request->notes,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {

        $my_class_id = Classroom::where('grade_id', $request->id)->pluck('grade_id');
        if ($my_class_id->count() == 0) {
            $grades = Grade::findorFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('grades.index');
        } else {
            toastr()->success(trans('Grades_trans.delete_Grade_Error'));
            return redirect()->route('grades.index');
        }
    }
}
