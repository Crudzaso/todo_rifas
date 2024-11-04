<?php

namespace App\Listeners;


use App\Services\DiscordWebhookService;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class SendLoginNotification
{
    /**
     * Create the event listener.
     */
    protected $discordWebhook;

    public function __construct(DiscordWebhookService $discordWebhook)
    {
        $this->discordWebhook = $discordWebhook;
    }

    public function handle(Login $event)
    {
        try {
            $this->discordWebhook->logLogin($event->user);
        } catch (\Exception $e) {
            Log::error('Error en DiscordLoginListener: ' . $e->getMessage());
        }
    }
}
