<?php

namespace App\Livewire;

use Livewire\Component;

class Chat extends Component
{
    public $messages = [];
    public $newMessage = '';

    public function sendMessage()
    {
        if ($this->newMessage) {
            $this->messages[] = [
                'user' => 'You',
                'message' => $this->newMessage,
                'timestamp' => now()->toDateTimeString(),
            ];
            $this->newMessage = '';
        }
    }

    public function receiveMessage($message)
    {
        $this->messages[] = [
            'user' => 'Other',
            'message' => $message,
            'timestamp' => now()->toDateTimeString(),
        ];
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
