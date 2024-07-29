<div class="flex flex-col h-screen">
    <div id="messages-container" class="flex-1 overflow-y-auto p-4 space-y-2 bg-gray-900 flex flex-col-reverse">
        <div class="flex flex-col-reverse space-y-2 space-y-reverse">
            @foreach (array_reverse($messages) as $message)
                <div class="flex {{ $message['user'] === 'You' ? 'justify-end' : 'justify-start' }}">
                    <div
                        class="relative flex flex-col p-2 rounded-lg max-w-xs {{ $message['user'] === 'You' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-800' }}">
                        @if ($message['photo'])
                            <div class="relative">
                                <img src="{{ Storage::url($message['photo']) }}" alt="photo" class="mt-2 rounded">
                                <button wire:click="removePhoto({{ $loop->index }})"
                                    class="absolute top-0 right-0 m-2 text-white bg-red-600 rounded-full p-1">
                                    &times;
                                </button>
                            </div>
                        @endif
                        <div>{{ $message['message'] }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $message['timestamp'] }}</div>
                    </div>
                </div>
            @endforeach
            @if ($photoPreview)
                <div class="flex justify-end">
                    <div class="relative flex flex-col p-2 rounded-lg max-w-xs bg-blue-500 text-white">
                        <div class="relative">
                            <img src="{{ $photoPreview }}" alt="Preview" class="mt-2 rounded w-32 h-32 object-cover">
                            <button wire:click="resetPhoto"
                                class="absolute top-0 right-0 m-2 text-white bg-red-600 rounded-full p-1">
                                &times;
                            </button>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Preview</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="p-2 border-t dark:border-gray-700 bg-gray-800">
        <form wire:submit.prevent="sendMessage" class="flex items-center space-x-2">
            <input type="text" wire:model="newMessage"
                class="flex-1 px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                placeholder="Type a message..." />
            <input type="file" wire:model="photo" class="hidden" id="photo">
            <label for="photo" class="cursor-pointer px-4 py-2 bg-gray-600 text-white rounded">Upload</label>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Send</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        let container = document.getElementById('messages-container');
        container.scrollTop = container.scrollHeight;

        Livewire.hook('message.processed', (message, component) => {
            container.scrollTop = container.scrollHeight;
        });
    });
</script>
