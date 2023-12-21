<?php
namespace App\Service;
use App\Models\Clubs;
use App\Models\SystemLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClubService {
    public $club;
    /**
     * ClubService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->ipAddress = $request->ip();
        $this->object = config('systemLog')->object->club;
        $this->action = config('systemLog')->action;
        $user = auth()->user();
        $this->actor = $user->user_code;
        $this->date = Carbon::now()->toDateTimeString();
    }

    /**
     * @param $name
     */
    public function addClubLog($name) {
        $systemLog = new SystemLog();
        $systemLog->object_name = $this->object;
        $systemLog->actor = $this->actor;
        $systemLog->log_time = $this->date;
        $systemLog->action = $this->action->a;
        $systemLog->description = $name;
        $systemLog->object_id = 0;
        $systemLog->brief = $this->action->a;
        $systemLog->from_ip = $this->ipAddress;
        $systemLog->relation_login = 0;
        $systemLog->save();
    }

    /**
     * @param $name
     */
    public function editClubLog($club, $name) {
        $systemLog = new SystemLog();
        $systemLog->object_name = $this->object;
        $systemLog->actor = $this->actor;
        $systemLog->log_time = $this->date;
        $systemLog->action = $this->action->e;
        $systemLog->description = "Update Club".' '. $name;
        $systemLog->object_id = 0;
        $systemLog->brief = $this->action->e;
        $systemLog->from_ip = $this->ipAddress;
        $systemLog->relation_login = 0;
        $systemLog->save();
    }

    /**
     *
     */
    public function deleteMemberClub($member) {
        $club_name = $member->club->name;
        $systemLog = new SystemLog();
        $systemLog->object_name = $this->object;
        $systemLog->actor = $this->actor;
        $systemLog->log_time = $this->date;
        $systemLog->action = $this->action->dm;
        $systemLog->description = "Delete Member" .' '. $member->user_code ."  Ra khỏi Club". ' '. $club_name;
        $systemLog->object_id = 0;
        $systemLog->brief = $this->action->dm;
        $systemLog->from_ip = $this->ipAddress;
        $systemLog->relation_login = 0;
        $systemLog->save();
    }

    public function addMemberClub($id, $user_code) {
        $club = Clubs::find($id);
        $systemLog = new SystemLog();
        $systemLog->object_name = $this->object;
        $systemLog->actor = $this->actor;
        $systemLog->log_time = $this->date;
        $systemLog->action = $this->action->am;
        $systemLog->description = "Create Member" .' '. $user_code ." vào Club". ' '. $club->name;
        $systemLog->object_id = 0;
        $systemLog->brief = $this->action->am;
        $systemLog->from_ip = $this->ipAddress;
        $systemLog->relation_login = 0;
        $systemLog->save();
    }
}
?>
