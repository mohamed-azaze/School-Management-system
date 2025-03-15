<?php
namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Repository\ClassroomRepositoryInterface;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    protected $classroom;

    public function __construct(ClassroomRepositoryInterface $classroom)
    {
        $this->classroom = $classroom;
    }

    public function index()
    {
        return $this->classroom->index();
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
        return $this->classroom->store($request);
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
        return $this->classroom->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        return $this->classroom->destroy($request);
    }

    public function delete_all(Request $request)
    {
        return $this->classroom->delete_all($request);
    }

    public function filter_classes(Request $request)
    {
        return $this->classroom->filter_classes($request);
    }

}
