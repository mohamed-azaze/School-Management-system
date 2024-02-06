<?php

namespace App\Repository;

use App\Models\fee;
use App\Models\Grade;

class StudentFeesRepository implements StudentFeesRepositoryInterface
{

    public function index()
    {
        $fees = fee::all();
        return view('pages.fees.index', compact('fees'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.fees.add', compact('Grades'));

    }

    public function store($request)
    {
        try {
            $fee = new fee();
            $fee->name = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fee->price = $request->amount;
            $fee->Grade_id = $request->Grade_id;
            $fee->Classroom_id = $request->Classroom_id;
            $fee->academic_year = $request->year;
            $fee->description = $request->description;
            $fee->Fee_type = $request->Fee_type;
            $fee->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('fees.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        $fee = fee::findorFail($id);
        $Grades = Grade::all();

        return view('pages.fees.edit', compact('fee', 'Grades'));

    }

    public function update($request)
    {
        try {
            $fee = fee::findorFail($request->id);
            $fee->name = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fee->price = $request->amount;
            $fee->Grade_id = $request->Grade_id;
            $fee->Classroom_id = $request->Classroom_id;
            $fee->academic_year = $request->year;
            $fee->description = $request->description;
            $fee->Fee_type = $request->Fee_type;
            $fee->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('fees.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            fee::findorFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('fees.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
