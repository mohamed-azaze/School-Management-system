<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        return view('pages.Teachers.Teachers', compact('Teachers'));
    }

    public function create()
    {
        $specializations = $this->Teacher->getSpecialization();
        $genders = $this->Teacher->getGender();

        return view('pages.Teachers.create', compact('genders', 'specializations'));
    }

    public function store(StoreTeachers $request)
    {
        return $this->Teacher->StoreTeacher($request);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $Teachers = $this->Teacher->editTeachers($id);
        $specializations = $this->Teacher->getSpecialization();
        $genders = $this->Teacher->getGender();
        return view('pages.Teachers.edit', compact('Teachers', 'specializations', 'genders'));
    }

    public function update(Request $request, string $id)
    {
        return $this->Teacher->UpdateTeachers($request);

    }

    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeachers($request);

    }
}