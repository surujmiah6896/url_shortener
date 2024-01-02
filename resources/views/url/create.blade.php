<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Url') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-5 text-center">
                    <!-- component -->
                        @if (session('shortenedUrl'))
                         <p class=" text-green-500">Shortened URL: <a href="{{ session('shortenedUrl') }}" target="_blank">{{ session('shortenedUrl') }}</a></p>
                        @endif
                       

                    </div>
                    <form action="{{route("url.store")}}" method="POST" class="max-w-sm mx-auto">
                        @csrf
                        <div class="mb-5">
                            <label for="original_url"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-Black">Your URL</label>
                            <input type="url" id="original_url" name="original_url"
                                class="shadow-sm mt-2 bg-gray-50 border border-gray-300 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-Black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                placeholder="Ex: www.example.com" required>
                                @error('original_url')
                                    <div class=" text-Black alert alert-danger">{{ $message }}</div>
                                @enderror
                                 @if (session('error'))
                                    <span class="text-red-500">{{ session('error') }}</span>
                                @endif
                        </div>

                        <div class="flex py-6 items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <a href="{{route('dashboard')}}" class ='inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>List</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
