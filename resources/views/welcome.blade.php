<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 p-6">
        <!-- رسالة ترحيبية مع Alpine.js -->
        <div x-data="{ open: false }">
            <button @click="open = ! open">Toggle</button>

            <div x-show="open" @click.outside="open = false">Contents...</div>
        </div>
        <!-- مكون Livewire بسيط -->
        <livewire:counter />

    </div>
</x-app-layout>
