<?php

namespace App\Listeners;

use App\Services\DiscordWebhookService;
use Illuminate\Auth\Events\Registered;
use App\Models\User;


class sendMessegeRegisterNotification
{
    /**
     * Create the event listener.
     */
    private $discordWebhook;

    public function __construct(DiscordWebhookService $discordWebhook)
    {
        $this->discordWebhook = $discordWebhook;
    }

    public function handle(Registered $event)
    {
        $this->discordWebhook->logRegistration($event->user);
    }

}
