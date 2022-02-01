<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Character Edit') }}
        </h2>
    </x-slot>

    <livewire:character.edit :character="$character"/>

    <x-flash-message></x-flash-message>
</x-app-layout>
