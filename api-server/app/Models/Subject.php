<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 * 
 * @property int $subject_id
 * @property string $name
 * @property string|null $type
 * 
 * @property Collection|ClassHarmonogram[] $class_harmonograms
 * @property Collection|StudentActivity[] $student_activities
 * @property Collection|StudentMark[] $student_marks
 * @property Collection|Student[] $students
 * @property Collection|Teacher[] $teachers
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subject';
	protected $primaryKey = 'subject_id';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'type'
	];

	public function class_harmonograms()
	{
		return $this->hasMany(ClassHarmonogram::class);
	}

	public function student_activities()
	{
		return $this->hasMany(StudentActivity::class);
	}

	public function student_marks()
	{
		return $this->hasMany(StudentMark::class);
	}

	public function students()
	{
		return $this->belongsToMany(Student::class)
					->withPivot('student_subject_id');
	}

	public function teachers()
	{
		return $this->belongsToMany(Teacher::class, 'teacher_subject')
					->withPivot('teacher_subject_id');
	}
}
