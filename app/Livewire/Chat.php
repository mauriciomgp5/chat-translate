<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Chat extends Component
{
    use WithFileUploads;

    public $messages = [];
    public $newMessage = '';
    public $photo;
    public $photoPreview;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        $this->photoPreview = $this->photo->temporaryUrl();
    }

    public function sendMessage()
    {
        $messageData = [
            'user' => 'You',
            'message' => $this->newMessage,
            'timestamp' => now()->toDateTimeString(),
            'photo' => null,
        ];

        if ($this->photo) {
            $messageData['photo'] = $this->photo->store('photos', 'public');
            $this->photo = null;
            $this->photoPreview = null;
        }

        if ($this->newMessage || $messageData['photo']) {
            $this->messages[] = $messageData;
            $this->newMessage = '';
        }
    }

    public function receiveMessage($message, $photo = null)
    {
        $this->messages[] = [
            'user' => 'Other',
            'message' => $message,
            'timestamp' => now()->toDateTimeString(),
            'photo' => $photo,
        ];
    }

    public function resetPhoto()
    {
        $this->photo = null;
        $this->photoPreview = null;
    }

    public function removePhoto($index)
    {
        unset($this->messages[$index]['photo']);
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
