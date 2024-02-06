<?php

namespace App\Repository;

interface TeacherRepositoryInterface
{
    public function getAllTeachers();
    public function getGender();
    public function getSpecialization();
    public function StoreTeacher($request);
    public function editTeachers($request);
    public function UpdateTeachers($request);
    public function DeleteTeachers($request);
}