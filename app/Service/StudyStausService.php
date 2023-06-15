<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\Payer;

class StudyStausService
{
        public function listStudentStudyStatus() {
            $array = [
                ['name' => 'HDI ( Học đi )', 'value' => 1, 'join_group' => true],
                ['name' => 'Tạm ngừng bắt buộc', 'value' => 2, 'join_group' => true],
                ['name' => 'TN1 ( Bảo lưu tự nguyện )', 'value' => 3, 'join_group' => true],
                ['name' => 'THO ( Dropout )', 'value' => 4, 'join_group' => false],
                ['name' => 'Chuyển cơ sở', 'value' => 5, 'join_group' => false],
                ['name' => 'Đình chỉ', 'value' => 6, 'join_group' => false],
                ['name' => 'BB3 ( Chờ thi lại tốt nghiệp )', 'value' => 7, 'join_group' => true],
                ['name' => 'TNG ( Đã tốt nghiệp ', 'value' => 8, 'join_group' => false],
                ['name' => 'Đã rút hồ sơ', 'value' => 9, 'join_group' => false],
                ['name' => 'TN2 ( Học lại )', 'value' => 10, 'join_group' => true],
                ['name' => 'TN3 ( Chờ xếp lớp học lại )', 'value' => 11, 'join_group' => true],
                ['name' => 'BB1 ( Bảo lưu do kỷ luật )', 'value' => 12, 'join_group' => false],
                ['name' => 'BB2 ( Chờ xét tốt nghiệp )', 'value' => 13, 'join_group' => true],
                ['name' => 'BB4 ( Chờ đủ điều kiện tốt nghiệp )', 'value' => 14, 'join_group' => true],
                ['name' => 'TN11 ( Bảo lưu tự nguyện )', 'value' => 15, 'join_group' => true],
                ['name' => 'TN21 ( Học lại )', 'value' => 16, 'join_group' => true],
                ['name' => 'TN31 ( Chờ xếp lớp học lại )', 'value' => 17, 'join_group' => true],
                ['name' => 'TN4 ( Chờ xếp lớp học đi )', 'value' => 18, 'join_group' => true],
                ['name' => 'BB5 ( Chờ thi đi tốt nghiệp )', 'value' => 19, 'join_group' => true],
                ['name' => 'TN22 ( Học lại )', 'value' => 20, 'join_group' => true],
            ];

            return $array;
        }

        public function canBeGroupMember($number) {
            $list = $this->listStudentStudyStatus();
            foreach ($list as $item) {
                if ($item['value'] == $number) {
                    return $item['join_group'];
                }
            }
            return 'Không xác định';
        }

        public function getStudyStatusStudent($student_login) {
          $studyStatus = User::where('user_login', $student_login)->where('user_level', 3)->select('study_status')->first();
          $status = $studyStatus->study_status;
          if (isset($status)) {
              return $status;
          }

          return null;
        }
}
