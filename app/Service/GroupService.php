<?php

namespace App\Service;

use App\Models\Fu\Groups;
use Illuminate\Support\Facades\Mail;

class GroupService
{
   public function checkGroupName($group) {
       $result = [];
       foreach ($group as $key => $item) {
           dd($key);
           $term = trim($item['term']);
           $date = trim($item['date']);
           $start_time = trim($item['start_time']);
           $end_time = trim($item['end_time']);
           $room = trim($item['room']);
           $teacher_login = trim($item['teacher_login']);
           $subject_code = trim($item['subject_code']);
           $course_session = trim($item['course_session']);
           $group_name = trim($item['group_name']);

           $checkGroupName = Groups::where('pterm_name', $term)
               ->where('group_name', $group_name)->select('group_name')
               ->first();

           if ($checkGroupName != null) {
               $result[] = "Group Name" .' '. $checkGroupName->group_name .' ' .'Đã tồn tại trong danh sách group';
               continue;
           }
           if (!$this->checkDateImport($date)) {
                dd(32131);
           }
       }
   }



   public function checkDateImport($date) {
       $intDate = strtotime($date);
       $dateFormat = date('Y-m-d', $intDate);
       $arrayDate = explode('-', $dateFormat);
       if (count($arrayDate) != 3) {
           return fales;
       }
       $year = $arrayDate[0];
       $month = $arrayDate[1];
       $day = $arrayDate[2];

       if (strlen($year) != 4) {
           return  false;
       }
       if (strlen($month) != 2) {
           return false;
       }
       if (strlen($day) != 2) {
           return false;
       }
       $parse_result = date_parse($date);
       if ($parse_result['warning_count'] > 0 || $parse_result['error_count'] > 0) {
           return false;
       }
       return true;
   }
}
