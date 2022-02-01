@props(['placeholder'])

<input wire:model="search" type="search" name="datatable-search" id="datatable-search"
       class="max-w-xs shadow-sm focus:ring-primary-500 focus:border-primary-500 block
                   w-full sm:text-sm border-gray-300 rounded-md"
       placeholder="{{$placeholder}}">
