<?php

namespace App\Mappers;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class DepartmentMapper {

    public static function mapToDTO(Department $department) {
        return [
            'id' => $department->id,
            'name' => $department->name
        ];
    }

    public static function mapToDTOs(Collection $departments) {
        return $departments->map(function($department) {
            return DepartmentMapper::mapToDTO($department);
        });
    }
}

?>
