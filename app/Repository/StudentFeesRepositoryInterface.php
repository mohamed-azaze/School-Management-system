<?php

namespace App\Repository;

interface StudentFeesRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit(string $id);

    public function update($request);

    public function destroy($request);

}