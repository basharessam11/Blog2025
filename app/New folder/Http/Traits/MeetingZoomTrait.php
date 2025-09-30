<?php

namespace App\Http\Traits;

use Jubaer\Zoom\Facades\Zoom;

trait MeetingZoomTrait
{
    public function createMeeting($request){

         $meetings = Zoom::createMeeting([
           'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
            // 'timezone' => config('zoom.timezone'),
            'timezone' => 'Africa/Cairo',
            "settings" => [
                'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => 0,
            'audio' => 'both',
            'auto_recording' => 'local',
             ],

        ]);




        return  $meetings;


    }
}
