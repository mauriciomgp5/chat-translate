<div class="flex flex-col h-full">
    <div class="flex-1 overflow-auto p-4 space-y-2">
        @foreach ($messages as $message)
            <div class="flex {{ $message['user'] === 'You' ? 'justify-end' : 'justify-start' }}">
                <div
                    class="flex flex-col p-2 rounded-lg max-w-xs {{ $message['user'] === 'You' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-800' }}">
                    <div>{{ $message['message'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $message['timestamp'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <form wire:submit.prevent="sendMessage" class="flex p-2 border-t dark:border-gray-700">
        <input type="text" wire:model="newMessage"
            class="flex-1 px-4 py-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
            placeholder="Type a message..." />
        <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded">Send</button>
    </form>
</div>
