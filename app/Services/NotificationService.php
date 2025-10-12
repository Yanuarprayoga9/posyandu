<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function create(array $data)
    {
        $notification = Notification::FindOrFail($data['id'] ?? null);

        $notification->update([
            'title' => $data['title'],
            'message' => $data['message'],
            'user_id' => $data['user_id'],
            // Add other fields as necessary
        ]);
        return Notification::create($data);

    }
}
