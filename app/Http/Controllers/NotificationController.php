<?php

namespace App\Http\Controllers;

use App\Http\Requests\Queues\EmailSenderRequest;
use App\Http\Requests\Queues\SmsSenderRequest;
use App\Jobs\EmailSender;
use App\Jobs\SmsSender;

class NotificationController extends Controller
{

    public function sendEmail(EmailSenderRequest $request): void
    {
        EmailSender::dispatch($request->get('email'))->onQueue('email');
    }

    public function sendSms(SmsSenderRequest $request): void
    {
        SmsSender::dispatch($request->get('phone'))->onQueue('sms');
    }

}
