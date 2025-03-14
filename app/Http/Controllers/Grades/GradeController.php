<?php
namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use App\Repository\GradeRepositoryInterface;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    protected $grade;

    public function __construct(GradeRepositoryInterface $grade)
    {
        $this->grade = $grade;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->grade->index();
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
        return $this->grade->store($request);
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
    public function update(StoreGrades $request)
    {
        return $this->grade->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->grade->destroy($request);
    }
}
