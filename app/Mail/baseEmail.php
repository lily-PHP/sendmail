<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class baseEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $blade = 'email';
    private $title = '';
    private $content = '';

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->blade = $data['view'];
        $this->title = $data['title'];
        $this->content = $data['content'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)->view($this->blade, ['data' => $this->content]);
    }
}
