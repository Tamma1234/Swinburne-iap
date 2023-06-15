<?php

namespace App\Service;

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

    public static function confirmSendMail()
    {
        return app(CheckGroupName::class);
    }
}
