<?php

namespace App\Http\Controllers;

use App\Exceptions\EntityNotFoundException;
use App\Mappers\DepartmentMapper;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private Department $department;

    public function __construct(Department $department) {
        $this->department = $department;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = $this->department->all();
        $dtos = DepartmentMapper::mapToDTOs($departments);
        return response($dtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->department->rules(), $this->department->feedback());
        $department = new Department();
        $department->fill($request->all());
        $department->save();
        $dto = DepartmentMapper::mapToDTO($department);
        return response($dto, 201);
    }

    public function show($id) {
        $department = $this->getDepartmentById($id);
        $dto = DepartmentMapper::mapToDTO($department);
        return response($dto);
    }

    private function getDepartmentById($id): Department {
        $department = $this->department->find($id);
        if($department === null) {
            throw new EntityNotFoundException('Department not found');
        }
        return $department;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $department = $this->getDepartmentById($id);
        $request->validate($department->rules(), $department->feedback());
        $department->fill($request->all());
        $department->update();
        $dto = DepartmentMapper::mapToDTO($department);
        return response($dto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department = $this->getDepartmentById($id);
        $department->delete();
        return response()->json([], 204);
    }
}
