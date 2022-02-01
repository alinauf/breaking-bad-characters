<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Character') }}
        </h2>
    </x-slot>

    <livewire:character.create/>


    <x-flash-message></x-flash-message>
</x-app-layout>
