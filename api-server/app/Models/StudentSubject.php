<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int        $student_id
 * @property int        $subject_id
 * @property int        $student_subject_id
 */
class StudentSubject extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_subject';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'student_subject_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'subject_id',
        'student_subject_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_id' => 'int',
        'subject_id' => 'int',
        'student_subject_id' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...

    // Functions ...

    // Relations ...
}
