<?php

namespace App\Repository;

interface StudentpromotionRepositoryInterface
{
    public function index();

    public function store($request);

    public function create();

    public function destroy($request);
}
