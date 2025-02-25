@extends('layouts.app')

@section('title', 'Softwares - TicketFlow')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    Softwares
                </h2>
            </div>
            <div class="mt-5 flex lg:ml-4 lg:mt-0">
                <span class="ml-3">
                    <a href="{{ route('softwares.create') }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Software
                    </a>
                </span>
            </div>
        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($softwares as $software)
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative p-6 bg-white dark:bg-gray-800 rounded-lg ring-1 ring-gray-900/5 shadow-xl">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            {{ $software->name }}
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            {{ $software->description }}
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('softwares.edit', $software) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                            <form action="{{ route('softwares.destroy', $software) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection