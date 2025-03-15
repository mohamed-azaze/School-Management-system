<?php
namespace App\Repository;

use App\Models\Classroom;
use App\Models\Grade;

class ClassroomRepository implements ClassroomRepositoryInterface
{

    public function index()
    {
        $my_classes = Classroom::all();
        $grades     = Grade::all();
        return view('pages.my_classes.my_classes', compact('my_classes', 'grades'));
    }

    public function store($request)
    {
        $List_Classes = $request->List_Classes;
        try {
            $validated = $request->validated();
            foreach ($List_Classes as $List_Class) {
                $My_Classes = new Classroom();

                $My_Classes->class_name = ['en' => $List_Class['name_class_en'], 'ar' => $List_Class['name']];

                $My_Classes->grade_id = $List_Class['grade_id'];

                $My_Classes->save();
            }
            toastr()->success(trans('messages.success'));

            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {

            $Classroom = Classroom::findorFail($request->id);
            $Classroom->update([
                $Classroom->class_name = ['ar' => $request->name, 'en' => $request->name_en],
                $Classroom->grade_id = $request->grade_id,
            ]);
            toastr()->success(trans('messages.Update'));

            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $Classroom = Classroom::findorFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('classrooms.index');
    }

    public function delete_all($request)
    {
        $Delete_All_id = explode(',', $request->delete_all_id);

        Classroom::whereIn('id', $Delete_All_id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('classrooms.index');
    }

    public function filter_classes($request)
    {
        $grades = Grade::all();
        $Search = Classroom::select('*')->where('grade_id', $request->grade_id)->get();

        return view('pages.my_classes.my_classes', compact('grades'))->withDetails($Search);
    }
}
