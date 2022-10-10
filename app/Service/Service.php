<?php

namespace App\Service;

class Service
{
    /**
     * Get send mail service.
     *
     * @return SendMailService
     */
    public static function getSendMail()
    {
        return app(SendMailService::class);
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
        return app(SendMailService::class);
    }
}
