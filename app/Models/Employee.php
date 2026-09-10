<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = ['name', 'sex', 'age', 'last_education'];

    public function getSexNameAttribute() 
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }
}
