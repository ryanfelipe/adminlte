<?php 
namespace App\Push;

class Send {
    public function Send($message, $devicesAndroid, $devicesIOS, $message_id)
    {
        // dd($devicesAndroid, $devicesIOS);
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $headers = [
            'Authorization: key=AAAAvafdsa41OkcY:APA91bHBZo0FMxHlQCyWlxNccTYoGSvV-_eUdl-xGFGg-1sDvbSt_lZ3-qKIIxCQYIJDjrcAZXCsRmow3tlODV1YeXeq2bzVJqKLS9IjJ0z-JnrQDwIwFiW5RF3RCFx5l5BfV17wM5sm',
            'Content-Type: application/json'
        ];

        $notification = [
            'title' => $message['title'],
            'body'  => $message['text'],
            'sound' => 'enabled',
            'icon' => 'ic_notification',
            'color' => '#832cbe',
            'image' => 'icon'
        ];

        $data = [
            'title' => $message['title'],
            'body'  => $message['text'],
            'sound' => 'enabled',
            'icon' => 'ic_notification',
            'color' => '#832cbe',
            'image' => 'ic_notification'
        ];
        if( isset($message['all']) && $message['all'] )
        {
            $fcmNotification = array();
            $android = [
                'to' => '/topics/android',
                'data' => $data
                // 'notification' => $notification
            ];
            
            $ios = [
                'to' => '/topics/ios',
                'notification' => $notification,
            ];

            array_push($fcmNotification, $ios, $android);
        }
        else
        {
            $fcmNotification = array();
            $android = [
                'registration_ids' => $devicesAndroid, //multple token array
                'data' => $data
                // 'notification' => $notification
            ];

            $ios = [
                'registration_ids' => $devicesIOS, //multple token array
                'notification' => $notification
            ];

            array_push($fcmNotification, $ios, $android);
        }
        // dd($fcmNotification);
        foreach ($fcmNotification as $key => $item) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($item));
            $result = curl_exec($ch);
            curl_close($ch);
        }
    
        // dd($result);
    }
}