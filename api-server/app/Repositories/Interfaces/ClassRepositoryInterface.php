<?php


namespace App\Repositories\Interfaces;
use App\Repositories\Base\BaseRepositoryInterface;


interface ClassRepositoryInterface extends BaseRepositoryInterface {

    /**
     * @param $subjectName string The subject for find classes which teacher have
     * @return mixed All classes which teacher have this subject
     */
    public function readTeacherClasses ( string $subjectName);

    /**
     * @param $identifier string The student identifier to get list of rest students from class where the student is
     * @return mixed The ids of all student from specific class
     */
    public function readStudentsByIdentifier( string $identifier);

    /**
     * @param int $classId
     * @return mixed
     */
    public function readStudentsIdByClassId ( int $classId );

    /**
     * @param $number
     * @param $numberIdentifier
     * @return mixed
     */
    public function readStudentsByClass ( $number, $numberIdentifier );

    /**
     * @param $identifier string
     */
    public function readClassIdByStudentIdentifier ( string $identifier );

    public function readClassIdByIdentifierAndNumber($number, $identifier);

}
