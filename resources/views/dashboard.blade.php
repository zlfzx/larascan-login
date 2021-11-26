<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                    <div class="bg-red-400 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 bg-red-400 border-b border-gray-200">
                            {{ $error }}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @if (session('login'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-green-400 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-green-400 border-b border-gray-200">
                        {{ session('login') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Hello World!
                    <br>
                    <a href="/scan">LOGIN WITH SCAN QRCODE</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
