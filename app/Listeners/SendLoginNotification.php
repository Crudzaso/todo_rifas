<?php

namespace App\Listeners;


use App\Services\DiscordWebhookService;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;



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
            if (session()->pull('just_registered', false)) {
                return;
            }
            $this->discordWebhook->logLogin($event->user);
        } catch (\Exception $e) {
            Log::error('Error en DiscordLoginListener: ' . $e->getMessage());
        }
    }
}
