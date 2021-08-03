<?php


namespace App\Helper;


use Illuminate\Support\Facades\DB;

class Tt
{
    static public function test($class_timetables,$class_id){
        $tt = [];
        $prevDay="";
        $day="";

        $prevSub='';
        $sub='';

        $day_count=0;
        $sub_count=0;
        foreach ($class_timetables as $class_timetable){

            $day=$class_timetable->day_name;
            $sub=$class_timetable->subject_name;
            if ($day != $prevDay){
                $result = DB::select("SELECT count(*) as total FROM timetables t
        left join days d on t.day_id =d.id
        left join semister se on t.semister_id =se.id
        left join slots s on t.slots_id = s.id
        left JOIN rooms r on t.room_id = r.id
        left join subjects s2 on t.subject_id  = s2.id
        left join class_subjects cs on s2.id=cs.subject_id
        left JOIN classes cl on cs.class_id=cl.id WHERE cl.id=? and d.day_name = ?",[$class_id,$day]);
                $day_count=$result[0]->total;
                $prevDay = $day;
            }

            if ($sub != $prevSub){
                $result = DB::select("SELECT count(*) as total FROM timetables t
        left join days d on t.day_id =d.id
        left join semister se on t.semister_id =se.id
        left join slots s on t.slots_id = s.id
        left JOIN rooms r on t.room_id = r.id
        left join subjects s2 on t.subject_id  = s2.id
        left join class_subjects cs on s2.id=cs.subject_id
        left JOIN classes cl on cs.class_id=cl.id WHERE cl.id=? and d.day_name = ? and s2.subject_name= ?",[$class_id,$day,$sub]);
                $prevSub = $sub;
                $sub_count=$result[0]->total;
                $class_timetable->subject_start=true;
            }else{
                $class_timetable->subject_start=false;
            }
            $class_timetable->day_total =$day_count;
            $class_timetable->subject_total =$sub_count;
            array_push($tt,$class_timetable);
        }
        return $tt;
    }
}
