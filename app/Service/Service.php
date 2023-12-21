<?php

namespace App\Service;

use Google\Auth\Cache\Item;

class Service
{
    /**
     * Get send mail service.
     *
     * @return GroupService
     */
    public static function getGroup()
    {
        return app(GroupService::class);
    }

    /**
     * Get process order service.
     *
     * @return StudyStausService
     */
    public static function getStudyStatus()
    {
        return app(StudyStausService::class);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function confirmSendMail()
    {
        return app(CheckGroupName::class);
    }

    public static function clubSystemLog() {
        return app(ClubService::class);
    }

    public static function ItemSystemLog() {
        return app(ItemService::class);
    }
}
