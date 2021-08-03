<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;
use App\Models\Timetable;
use App\Models\Slot;
use App\Models\Day;
use App\Models\Subject;
use App\Models\Room;
use App\Models\Classes;

Class Helper{
    public static function timetableGenerate($day,$room,$slot){ //Not used
        $subjects = Subject::all();

        foreach($subjects as $subject){


            if(!self::restrictOneSubjectPerDay($day->id,$subject->id)){
                if(self::restrictOneSubjectPerSlotInOneRoomInOneDay($day->id,$room->id,$slot->id)){
                    return;
                }
                if (!self::restrictOneClassToBeInOneRoomInOneTimeSlots($day->id,$slot->id,$subject->id)) {
                DB::table('timetables')->insert([
                    'day_id'=>$day->id,
                    'slots_id'=>$slot->id,
                    'room_id'=>$room->id,
                    'subject_id'=>$subject->id,
                    'semister_id'=>1,
                ]);
                return;
                }
            }
//
        }
    }

    private static  function restrictOneSubjectPerSlotInOneRoomInOneDay($day_id,$room_id,$slot_id): bool
    {
        $timetables = DB::select('SELECT * FROM timetables where day_id='.$day_id.' and room_id='.$room_id.' and slots_id = '.$slot_id);
        if(!empty($timetables)){
            return true;
        }
        return false;
    }

    //to be imp
    private static  function restrictOneSubjectIndexPeriodInOneWeek($subject_id,$index): bool
    {
        $timetables = DB::select('SELECT * FROM timetables t where t.subject_id='.$subject_id.' and t.index ='.$index);
        if(!empty($timetables)){
            return true;
        }
        return false;
    }

    private static  function restrictOneSubjectPerDay($day_id,$subject_id): bool
    {
        $timetables = DB::select('SELECT * FROM timetables where day_id='.$day_id.' and subject_id='.$subject_id);
        if(!empty($timetables)){
            return true;
        }
        return false;
    }
    private static  function restrictOneClassToBeInOneRoomInOneTimeSlots($day_id,$slot_id,$subject_id): bool
    {
        $classes_slot_days = DB::select('SELECT cl.class_name FROM timetables t left join subjects s on t.subject_id=s.id LEFT JOIN class_subjects cs on s.id=cs.subject_id left join classes cl on cs.class_id=cl.id WHERE day_id='.$day_id.' and slots_id='.$slot_id);
        $class_subjects = DB::select('SELECT cl.class_name FROM subjects s LEFT JOIN class_subjects cs on s.id=cs.subject_id left join classes cl on cs.class_id=cl.id WHERE s.id='.$subject_id);
        foreach ($class_subjects as $class_subject) {
            if (in_array($class_subject,$classes_slot_days)) {
                return true;
            }
        }
        return false;
    }

    public static function generateTimetable(): array
    {
        $classes =DB::select('SELECT id from classes');
        $data = [];
        foreach ($classes as $class){
            array_push($data,self::generateClassTimetable($class->id));
        }
        return [
            'status'=>true,
            'message'=>'Timetable generated successful',
            'data'=>$data,
        ];
    }

    public static function generateClassTimetable($class_id)
    {
        $class_subjects = self::getClassSubjects($class_id);
        if ($class_subjects[0]->credit_no==null)
            return 0;
        $period_number_per_week = self::getNumberOfPeriodsPerGivenClassPerWeek($class_subjects);
        $period_number_per_day = self::getNumberOfPeriodsPerDayForAGivenClass($period_number_per_week);
        $class_subjects_periods = self::generateClassSubjectPeriodSpecList($class_subjects);
        $rooms = Room::all();
        $slots = Slot::all();
        $slots_count = $slots->count()*$rooms->count();

        $days = Day::all();
        foreach ($class_subjects_periods as $subject){
        foreach ($days as $day){
            $current_slot_count = 0;


            foreach ($rooms as $room){
                    $num_slot = $subject['slot_number'];
                    $current_slot = 0;
                    //subject level filters
                    if(self::restrictOneSubjectPerDay($day->id,$subject['id']))
                        break;

                    if (self::restrictOneSubjectIndexPeriodInOneWeek($subject['id'],$subject['index']))
                        break;
                    //end
                    $num = $num_slot;
                    foreach ($slots as $slot){
//
                        if (self::restrictOneSubjectPerSlotInOneRoomInOneDay($day->id, $room->id, $slot->id)) {
                            break;
                        }

                        if ($num>(7-$slot->id)){
                            break;
                        }// TODO: fail to set time for complete period
                        else{
                            if ($current_slot<$num_slot){
                                if (!self::restrictOneClassToBeInOneRoomInOneTimeSlots($day->id, $slot->id, $subject['id'])) {
                                    //TODO:: restrict room
                                    DB::table('timetables')->insert([
                                        'day_id' => $day->id,
                                        'slots_id' => $slot->id,
                                        'room_id' => $room->id,
                                        'subject_id' => $subject['id'],
                                        'semister_id' => 1,
                                        'index'=>$subject['index'],
                                    ]);
                                    $current_slot++;
                                    $current_slot_count++;
                                    $num=$num-1;
                                }
                            }
                            else{
                                break;
                            }
                        }
                    }
                }
            }
        }
        foreach ($class_subjects_periods as $subject){
            foreach ($days as $day){
                $current_slot_count = 0;


                foreach ($rooms as $room){
                    $num_slot = $subject['slot_number'];
                    $current_slot = 0;
                    //subject level filters
                    if(self::restrictOneSubjectPerDay($day->id,$subject['id']))
                        break;

                    if (self::restrictOneSubjectIndexPeriodInOneWeek($subject['id'],$subject['index']))
                        break;
                    //end
                    $num = $num_slot;
                    foreach ($slots as $slot){
//
                        if (self::restrictOneSubjectPerSlotInOneRoomInOneDay($day->id, $room->id, $slot->id)) {
                            continue;
                        }

                        if ($num>(7-$slot->id)){
                            break;
                        }// TODO: fail to set time for complete period
                        else{
                            if ($current_slot<$num_slot){
                                if (!self::restrictOneClassToBeInOneRoomInOneTimeSlots($day->id, $slot->id, $subject['id'])) {
                                    DB::table('timetables')->insert([
                                        'day_id' => $day->id,
                                        'slots_id' => $slot->id,
                                        'room_id' => $room->id,
                                        'subject_id' => $subject['id'],
                                        'semister_id' => 1,
                                        'index'=>$subject['index'],
                                    ]);
                                    $current_slot++;
                                    $current_slot_count++;
                                    $num=$num-1;
                                }

                            }
                            else{
                                break;
                            }
                        }


                    }
                }
            }
        }
        return [
            "period_number_per_day"=>$period_number_per_day,
            "period_number_per_week"=>$period_number_per_week,
            "classes"=>$class_subjects,
            "class_subjects_periods"=>$class_subjects_periods,
        ];
    }

//    public static function generateClassTimetable($class_id): array
//    {
//        $class_subjects = self::getClassSubjects($class_id);
//        $period_number_per_day = self::getNumberOfPeriodsPerDayForAGivenClass(self::getNumberOfPeriodsPerGivenClassPerWeek($class_subjects));
//        $class_subjects_periods = self::generateClassSubjectPeriodSpecList($class_subjects);
//        $rooms = Room::all();
//        $slots = Slot::all();
//        $days = Day::all();
//        foreach($days as $day){
//            $current_period = 0;
//            if ($current_period<=$period_number_per_day){
//                foreach($rooms as $room){
//                    foreach($class_subjects_periods as $subject){
//                        if(!self::restrictOneSubjectPerDay($day->id,$subject['id'])) {
//                            $num_slot = $subject['slot_number'];
//                            $current_slot = 0;
//                            //limit per number of slot
//                            if ($current_slot<$num_slot){
//                                foreach ($slots as $slot) {
//                                    if (self::restrictOneSubjectPerSlotInOneRoomInOneDay($day->id, $room->id, $slot->id)) {
//                                        continue;
//                                    }
//
//                                    if (!self::restrictOneClassToBeInOneRoomInOneTimeSlots($day->id, $slot->id, $subject['id'])) {
//                                        DB::table('timetables')->insert([
//                                            'day_id' => $day->id,
//                                            'slots_id' => $slot->id,
//                                            'room_id' => $room->id,
//                                            'subject_id' => $subject['id'],
//                                            'semister_id' => 1,
//                                            'index'=>$subject['index'],
//                                        ]);
//                                        $current_slot++;
//                                    }
//
//                                }
//                            }
//                            else{
//                                $current_period++;
//                                break;
//                            }
//                        }
//                        else{
//                            break;
//                        }
//                    }
//                }
//            }
//
//        }
//        return [
//            "period_number_per_day"=>$period_number_per_day,
//            "classes"=>$class_subjects,
//            "class_subjects_periods"=>$class_subjects_periods,
//        ];
//    }


    public static function generateClassSubjectPeriodSpecList($subjects): array
    {
        $class_subjects = [];
        //for first index/period of the week
         foreach ($subjects as $subject){
             $class_subject = [];
             if($subject->credit_no>=9 && $subject->credit_no<18)
             {
                 array_push($class_subjects,[
                     'id'=> $subject->id,
                     'subject_name'=> $subject->subject_name,
                     'credit_no' => $subject->credit_no,
                     'no_period' => 2,
                     'index'=>1,
                     'slot_number'=>3,
                 ]);
             }
             else
             {

                 array_push($class_subjects,[
                     'id'=> $subject->id,
                     'subject_name'=> $subject->subject_name,
                     'credit_no' => $subject->credit_no,
                     'no_period' => 1,
                     'index'=>1,
                     'slot_number'=>3,
                 ]);
             }

         }
         //for Second index/period of the week
        foreach ($subjects as $subject){
            $class_subject = [];
            if($subject->credit_no>=9 && $subject->credit_no<18)
            {
                array_push($class_subjects,[
                    'id'=> $subject->id,
                    'subject_name'=> $subject->subject_name,
                    'credit_no' => $subject->credit_no,
                    'no_period' => 2,
                    'index'=>2,
                    'slot_number'=>2,
                ]);
            }

        }
        return $class_subjects;
    }


    public static function getClassSubjects($class_id): array
    {
        return DB::select('select s.subject_name,s.credit_no,s.id from classes c left join class_subjects cs on c.id =cs.class_id left JOIN  subjects s on cs.subject_id =s.id WHERE c.id ='.$class_id);
    }

    public static function getNumberOfPeriodsPerDayForAGivenClass($period_number_per_week)
    {
        $number_of_day = Day::all()->count();
        return ceil($period_number_per_week/$number_of_day);
    }
    public static function getNumberOfPeriodsPerGivenClassPerWeek($class_subjects): int
    {
        $number_period = 0;
        foreach ($class_subjects as $class_subject){
            if($class_subject->credit_no>=9 && $class_subject->credit_no<18)
                $number_period+=2;
            else
                $number_period++;
        }
        return $number_period;
    }
    public static function test(){
        return "test Timetable generator";
    }
}
