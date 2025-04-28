@extends('app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="text-center w-full mb-10">
            <img class="mx-auto w-2/5" src="/images/tapp_starter_kit.png" alt="Tapp Laravel Starter Kit" />
        </div>

        <h1 class="text-4xl font-bold text-center mb-8">Welcome to Tapp Laravel Starter Kit</h1>

        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
            <p class="text-lg mb-4">
                A modern, production-ready starter kit for applications built on the powerful TALL stack
                (TailwindCSS, Alpine.js, Laravel, Livewire).
            </p>

            <h2 class="text-2xl font-semibold mt-6 mb-4">Key Features</h2>
            <ul class="list-disc list-inside space-y-2 mb-6">
                <li>Pre-configured User architecture (Model, Policy, Factory, Migration, and Seeder)</li>
                <li>Authorization using Spatie library (Permission, Role)</li>
            </ul>
        </div>
    </div>
@endsection
