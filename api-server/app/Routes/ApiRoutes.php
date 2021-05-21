<?php


namespace App\Routes;

/**
 * The relative routes to all Api calls in the server
 */
class ApiRoutes {

    #region Auth

    public const LOGIN = '/logowanie';

    #endregion

    #region Teacher

    public const TEACHER_SUBJECT = '/teacher/subjects';

    public const TEACHER_CLASS_OF_SUBJECT = 'teacher/subject={subjectName}/classes';

    public const MARKS_LIST_CLASS = '/teacher/subject={subjectName}/class={class}/marks';

    #endregion

    #region Student

    public const STUDENTS_OF_CLASS = 'students/class={class}/subject={subject}/date={date}';

    public const STUDENT_SUBJECTS = 'student/subjects';

    public const MARKS_OF_EACH_SUBJECT = '/student/subjects/marks';

    public const MARKS_AVERAGE = '/student/marks/average';

    public const FREQUENCY_OF_EACH_SUBJECT = '/student/subjects/frequencies';

    #endregion
}
