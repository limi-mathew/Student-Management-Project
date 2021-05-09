<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMarks extends Model
{
    use HasFactory;
	protected $guarded = [];
	protected $table = 'student_marks';

	 public function Student()
	 {
	   return $this->hasMany(Student::class, 'student_id');
	 }
}
