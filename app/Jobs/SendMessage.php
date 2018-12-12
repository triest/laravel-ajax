<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Mail;


class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $mail;
    protected $name;
    protected $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $email, $name, $event)
    {
        //
        $this->message = $message;
        $this->mail = $email;
        $this->name = $name;
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
        $name = $this->name;
        $mail2 = $this->mail;
        $event = $this->event;
        Mail::send('mail.test', ['name' => $name, 'event' => $event], function ($message) use ($mail2) {
            $message
                ->to($mail2, 'some guy')
                ->from('sakura-testmail@sakura-city.info')
                ->subject('Спасибо что зарегистрировались');
        });
        return null;

    }
    /*
        public function sendMail()
        {
            $testname = 'testname1';
            $mail2=$this->mail;
            Mail::send('mail.test', ['name' => $testname], function ($message) use ($mail2) {
                $message
                    ->to($mail2, 'some guy')
                    ->from('sakura-testmail@sakura-city.info')
                    ->subject('Спасибо что зарегистрировались');
            });
            return null;
        }
    */
}
