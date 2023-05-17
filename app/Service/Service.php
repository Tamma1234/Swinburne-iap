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
     * @return ProcessOrderService
     */
    public static function getProcessOrder()
    {
        return app(ProcessOrderService::class);
    }

    public static function confirmSendMail()
    {
        return app(CheckGroupName::class);
    }
}
