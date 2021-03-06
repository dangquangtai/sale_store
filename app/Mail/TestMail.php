<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $demo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dqtai.19it1@vku.udn.vn')->subject("Send from FURN")
            ->view('admin.test_mail');
            // ->text('admin.text_mail')
            // ->with(
            //     [
            //         'testVarOne' => '1',
            //         'testVarTwo' => '2',
            //     ]
            //     );
            // ->attach(public_path('/images') . '/demo.jpg', [
            //     'as' => 'demo.jpg',
            //     'mime' => 'image/jpeg',
            // ]);
    }
}
