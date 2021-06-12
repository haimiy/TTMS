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
    public static function timetableGenerate($day,$room,$slot){
        $subjects = Subject::all();

        foreach($subjects as $subject){
            
            if(self::restrictOneSubjectPerSlotInOneRoomInOneDay($day->id,$room->id,$slot->id)){
                return;
            }
            if(!self::restrictOneSubjectPerDay($day->id,$subject->id)){
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
            
        }
    }
    private static  function restrictOneSubjectPerSlotInOneRoomInOneDay($day_id,$room_id,$slot_id){
        $timetables = DB::select('SELECT * FROM timetables where day_id='.$day_id.' and room_id='.$room_id.' and slots_id = '.$slot_id);
        if(!empty($timetables)){
            return true;
        }
        return false;
    } 

    private static  function restrictOneSubjectPerDay($day_id,$subject_id){
        $timetables = DB::select('SELECT * FROM timetables where day_id='.$day_id.' and subject_id='.$subject_id);
        if(!empty($timetables)){
            return true;
        }
        return false;
    }
    private static  function restrictOneClassToBeInOneRoomInOneTimeSlots($day_id,$slot_id,$subject_id){
        $clsses_slot_days = DB::select('SELECT cl.class_name FROM timetables t left join subjects s on t.subject_id=s.id LEFT JOIN class_subjects cs on s.id=cs.subject_id left join classes cl on cs.class_id=cl.id WHERE day_id='.$day_id.' and slots_id='.$slot_id);
        $class_subjects = DB::select('SELECT cl.class_name FROM subjects s LEFT JOIN class_subjects cs on s.id=cs.subject_id left join classes cl on cs.class_id=cl.id WHERE s.id='.$subject_id);
        foreach ($class_subjects as $class_subject) {
            if (in_array($class_subject,$clsses_slot_days)) {
                return true;
            }
        }
        return false;
    }
    public static function test(){
        return "test Timetable generator";
    }91
}
