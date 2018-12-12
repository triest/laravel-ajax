<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SenMessagesToOrganizer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $user;
    protected $did;
    protected $userName;
    protected $userEmail;
    protected $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $userName, $userEmail, $did, $event)
    {
        //
        $this->message = $message;
        $this->userName = $userName;
        $this->did = $did;
        $this->userEmail = $userEmail;
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        //  info($this->message);
        $name = $this->userName;
        $mail2 = $this->userEmail;
        $event = $this->event;
        $did = $this->did;
        $user = $this->user;
        dump($event);

        Mail::send('mail.organizer', ['name' => $name, 'event' => $event, 'did' => $did],
            function ($message) use ($mail2) {
                $message
                    ->to($mail2, 'some guy')
                    ->from('sakura-testmail@sakura-city.info')
                    ->subject('Новая заявка на мероприятие');
            });
        return null;

    }


}
