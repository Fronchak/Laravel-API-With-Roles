<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function rules() {
        return [
            'name' => 'required|min:3'
        ];
    }

    public function feedback() {
        return [
            'required' => 'The :attribute is required'
        ];
    }
}
