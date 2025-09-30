<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBlogNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $content;

    /**
     * إنشاء الـ Mailable مع تمرير المحتوى.
     */
    public function __construct($content)
    {
        $this->content = $content;

    }

    /**
     * تعريف عنوان الرسالة.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->content['subject'] ?? 'New Blog Notification',
        );
    }

    /**
     * تعريف محتوى الرسالة والقالب الخاص بها.
     */
    public function content(): Content
    {

        return new Content(
            view: 'emails.new_blog_notification', // القالب الخاص بالرسالة
            with: [
                'title' => $this->content['title'] ?? 'Default Title', // ضمان وجود قيمة
                'body' => $this->content['body'] ?? 'No content available', // ضمان وجود قيمة
                'url' => $this->content['url'] ?? '#', // ضمان وجود رابط
            ],
        );
    }

    /**
     * لا توجد مرفقات للرسالة.
     */
    public function attachments(): array
    {
        return [];
    }
}
