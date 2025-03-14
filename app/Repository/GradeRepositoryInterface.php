<?php
namespace App\Repository;

interface GradeRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request);

    public function destroy($request);

}
