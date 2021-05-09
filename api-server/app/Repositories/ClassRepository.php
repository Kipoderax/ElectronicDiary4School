<?php


namespace App\Repositories;


use App\Helpers\KeyColumn;
use App\Models\ClassHarmonogram;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserClass;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Interfaces\ClassRepositoryInterface;

class ClassRepository extends BaseRepository implements ClassRepositoryInterface {

    #region Public Methods

    public function readTeacherClasses ( string $subjectName) {

        // get teacher id
        $teacherId = $this->getTeacherId();

        // if founded then
        if ($teacherId->count() != 0) {

            // Get subject id by arriving subject name from client
            $subjectId = $this->findByColumn(
                $subjectName,
                'name',
                Subject::class)->pluck(KeyColumn::fromModel(Subject::class));

            // get all classes ids
            $classesIds = $this->findByAndColumns(
                $teacherId[0],
                $subjectId,
                KeyColumn::fromModel(Teacher::class),
                KeyColumn::fromModel(Subject::class),
                ClassHarmonogram::class)
                ->pluck(KeyColumn::fromModel(UserClass::class));


            // by classes ids get objects of the classes list
            return UserClass::query()
                -> whereIn( KeyColumn::fromModel(UserClass::class), $classesIds )
                -> selectRaw( 'CONCAT(number, identifier_number) as klasa' )
                -> get();
        }

        return null;
    }

    public function readStudentsByIdentifier ( string $identifier ) {
        $userId = $this->findByColumn($identifier, 'identifier', User::class)
            ->pluck(KeyColumn::fromModel(User::class));

        $userClassId = $this->findByColumn($userId, KeyColumn::fromModel(User::class), Student::class)
            ->pluck(KeyColumn::fromModel(UserClass::class));

        $students = $this->findByColumn($userClassId, KeyColumn::fromModel(UserClass::class), Student::class)
            ->pluck(KeyColumn::fromModel(Student::class));

        return ($students);
    }

    /**
     * @param string $identifier The student identifier
     */
    public function readClassIdByStudentIdentifier ( string $identifier ) {
        $userId = $this->findByColumn($identifier, 'identifier', User::class)
            ->pluck(KeyColumn::fromModel(User::class));

        return $this->findByColumn($userId, KeyColumn::fromModel(User::class), Student::class)
            ->pluck(KeyColumn::fromModel(UserClass::class));
    }

    public function readStudentsByClass ( $number, $numberIdentifier ) {

        // Get class id by data from request
        $class_id = $this->getClassIdByIdentifierAndNumber($number, $numberIdentifier);


        // Get user ids of students from this class
        $userIdsOfStdents = $this->
                            findByColumn($class_id, KeyColumn::fromModel(UserClass::class), Student::class)->
                            pluck(KeyColumn::fromModel(User::class));


        // For each user id get details
        return $this->
                    findByMultipleValues($userIdsOfStdents, KeyColumn::fromModel(User::class), User::class)->
                    select('identifier', 'first_name', 'last_name')->
                    get();
    }

    #endregion

    private function getClassIdByIdentifierAndNumber($number, $identifier) {
        return $this->findByAndColumns($number, $identifier, 'number', 'identifier_number', UserClass::class)
            ->pluck(KeyColumn::fromModel(UserClass::class));
    }

}
