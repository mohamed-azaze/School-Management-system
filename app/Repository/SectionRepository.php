<?php
namespace App\Repository;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
        $grades      = Grade::with(['Sections'])->get();
        $grades_list = Grade::all();
        $teachers    = Teacher::all();
        return view('pages.sections.sections', compact('grades', 'grades_list', 'teachers'));
    }

    public function store($request)
    {
        try {
            $validated = $request->validated();

            $sections = new Section();

            $sections->section_name = ['ar' => $request->section_name_ar, 'en' => $request->section_name_en];
            $sections->grade_id     = $request->grade_id;
            $sections->class_id     = $request->class_id;
            $sections->status       = 1;
            $sections->save();
            $sections->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.success'));

            return redirect()->route('sections.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $validated              = $request->validated();
            $sections               = Section::findorFail($request->id);
            $sections->section_name = ['ar' => $request->section_name_ar, 'en' => $request->section_name_en];
            $sections->grade_id     = $request->grade_id;
            $sections->class_id     = $request->class_id;

            if (isset($request->Status)) {
                $sections->Status = 1;
            } else {
                $sections->Status = 2;
            }

            // update pivot tABLE
            if (isset($request->teacher_id)) {
                $sections->teachers()->sync($request->teacher_id);
            } else {
                $sections->teachers()->sync([]);
            }

            $sections->save();
            toastr()->success(trans('messages.Update'));

            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function destroy($request)
    {
        $sections = Section::findorFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Sections.index');
    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where('grade_id', $id)->pluck('class_name', "id");
        return $list_classes;
    }
}