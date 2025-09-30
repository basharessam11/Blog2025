<?php
namespace App\Listeners;

use App\Events\SendMail;
use App\Mail\NewBlogNotification;
use App\Mail\NewProductNotification;
use App\Models\Subscribe;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMail $event): void
    {
        // جلب جميع المشتركين
        $subscribers = Subscribe::all();



        // إرسال الإشعارات لكل مشترك
        foreach ($subscribers as $subscriber) {
            if ($event->data['name'] == 'product') {
            if ($subscriber->country == 'Egypt') {
                $content = [
                    'subject' => 'New Product: ' . $event->data['title_ar'],
                    'title' => 'هناك منتج جديد قم برؤيته الان',
                    'body' =>$event->data['title_ar'],
                    'url' => $event->data['slug_ar']
                ];
            } else {
                $content = [
                    'subject' => 'منتج جديد: ' . $event->data['title_en'],
                    'title' =>'There is a new product, check it out now.',
                    'body' => $event->data['title_en'],
                    'url' => $event->data['slug_en']
                ];
            }

            Mail::to($subscriber->email)->send(new NewProductNotification($content));







        }else{
            if ($subscriber->country == 'Egypt') {
                $content = [
                    'subject' => 'تدوينة جديدة: ' . $event->data['title_ar'],
                    'title' => 'هناك تدوينة جديدة قم برؤياتها الان',
                    'body' =>$event->data['title_ar'],
                    'url' => $event->data['slug_ar']
                ];
            } else {
                $content = [
                    'subject' => 'New Post: ' . $event->data['title_en'],
                    'title' =>'There is a new post, check it out now',
                    'body' => $event->data['title_en'],
                    'url' => $event->data['slug_en']
                ];
            }



            Mail::to($subscriber->email)->send(new NewBlogNotification($content));



        }




        }
    }
}
