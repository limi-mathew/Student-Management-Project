<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

  protected $guarded = [];
  protected $table = 'students';

  public function studentmarks()
  {
    return $this->belongsTo(StudentMarks::class, 'student_id');
  }
}
