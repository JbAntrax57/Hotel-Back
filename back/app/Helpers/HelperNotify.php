<?php

namespace App\Helpers;

class HelperNotify
{
    public function getNotify ($key = 'exception', $message = '') {
        $notifications = [
            'success' => [
                'message' => $message,
                'color' => 'positive',
                'position' => 'top',
                'icon' => 'check',
                'timeout' => 3000,
            ],
            'error' => [
                'message' => $message,
                'color' => 'warning',
                'position' => 'top',
                'icon' => 'check',
                'timeout' => 3000,
            ],
            'exception' => [
                'message' => $message,
                'color' => 'red-6',
                'avatar' => 'https://cdn.quasar.dev/img/boy-avatar.png',
                'position' => 'top',
                'timeout' => 5000
            ]
        ];

        return array_key_exists($key, $notifications) ? $notifications[$key] : $notifications['exception'];
        
        // return array_key_exists($key, $nortifications) ? ['result' => strpos($key, 'error') === 0 ? false : true, 'message' => $nortifications[$key]] : ['result' => false, 'message' => parent::getInternalServer()];
    }
}