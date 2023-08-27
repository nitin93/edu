<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'edu_courses';
    protected $fillable = [
        'course_name_en', 'course_name_hn', 'description_en', 'description_hn', 'teacher_id',
    ];
}
