<?php
class Students{

    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function get_batch_id($year, $department){
        $results = $this->_db->query("SELECT `id` from `batch` WHERE `Year_of_joining`= ? AND `Department` = ?;",[$year, $department])->first()->id;
        return $results;
    }

    public function get_subjects($year, $department, $semester){
        $batch_id = $this->get_batch_id($year, $department);
        $results = $this->_db->query("SELECT * FROM `batch_subjects` WHERE `batch_id` = ? AND `semester` = ?;",[$batch_id, $semester])->results();
        return $results;
    }

    public function generate_students($year, $department){
        $students = $this->_db->query("SELECT * FROM `students_details` WHERE `Department` = ? and YEAR(`Joining_year`) = ?;",[$department, $year])->results();
        return $students;
    }


    public function generate_students_with_subjects($year, $department) {
        $students = $this->_db->query("SELECT `students_details.id`, `students_details.Register_number`, `students_details.Name`, `batch.Subject`FROM 
        `students_details`JOIN `batch` ON `students_details.batchid` = `batch.batchid` WHERE `students_details.Department` = ? 
        AND `students_details.Joining_year` = ?;", [$department, $year])->results();
        return $students;
    }
    
    public function get_subject_id($batch_id, $sem){
        $results = $this->_db->query("SELECT `id`, `subject` FROM `batch_subjects` WHERE `batch_id` = ? and `semester` = ?;", [$batch_id, $sem])->results();
        return $results;
    }

    // public function get_student_subject($batch_id, $subject_id, $student_id, ){
    //     $results = $this->_db->query("SELECT * FROM `internal_marks` WHERE `batch_id` = ? and `semester` = ? and `student_id` = ?;", [$batch_id, $sem, $student_id])->results();
    //     return $results;
    // }

    public function get_marks($batch_id, $subject_id, $student_id, $internal = null){
        if(!empty($internal)){
            $results = $this->_db->query("SELECT * FROM `internal_marks` where `batch_id`= ? AND `subject_id`= ? AND `student_id` = ? AND exam = ?",[$batch_id,$subject_id, $student_id, $internal])->results();
        } else {
            $results = $this->_db->query("SELECT * FROM `semester_marks` where `batch_id`= ? AND `subject_id`= ? AND `student_id` = ?",[$batch_id,$subject_id, $student_id])->results();
        }
        return $results;
    }

    public function get_unique_exams($batch_id, $subject_id, $student_id) {
       
        $internalExams = $this->_db->query("SELECT DISTINCT(`exam`) FROM `internal_marks` WHERE `batch_id` = ? AND `subject_id` = ? AND `student_id` = ?", [$batch_id, $subject_id, $student_id])->results();
        $semesterExams = $this->_db->query("SELECT DISTINCT(`exam`) FROM `semester_marks` WHERE `batch_id` = ? AND `subject_id` = ? AND `student_id` = ?", [$batch_id, $subject_id, $student_id])->results();
        $allExams = array_merge($internalExams, $semesterExams);
        $uniqueExams = [];
        foreach ($allExams as $exam) {
            if (!in_array($exam->exam, $uniqueExams)) {
                $uniqueExams[] = $exam->exam;
            }
        }
    
        return $uniqueExams;
    }

    public function get_subjectmark($sub_id){
        $results = $this->_db->get("batch_subjects",["id","=",$sub_id])->first();
        return $results->subject;
    }
}