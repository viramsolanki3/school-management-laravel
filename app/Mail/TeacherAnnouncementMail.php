<?php

namespace App\Mail;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherAnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    public Announcement $announcement;
    /**
     * Create a new message instance.
     */
     public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

        public function build()
    {
        return $this->subject($this->announcement->title)
                    ->markdown('emails.teacher_announcement')
                    ->with([
                        'title' => $this->announcement->title,
                        'body' => $this->announcement->body,
                        'author' => $this->announcement->author->name ?? 'Teacher',
                    ]);
    }

}
