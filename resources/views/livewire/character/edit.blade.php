<div x-data="{
formValidationStatus:@entangle('formValidationStatus'),
}"

     class="mt-8 bg-white px-6 sm:px-6 md:px-4 py-4 shadow overflow-hidden sm:rounded-lg"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-90"
     x-transition:enter-end="opacity-100 transform scale-100"
>

    <form action="{{url("characters/$character->id")}}" method="POST">
        @method('PUT')
        @csrf


        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">


            {{--Show--}}

            <div class="sm:col-span-3">
                <label for="selected_shows" class="block text-sm font-medium text-gray-700">
                    Show <span class="text-red-800">*</span>
                </label>

                <fieldset class="space-y-5">
                    <legend class="sr-only">Show</legend>
                    @foreach($shows as $key => $show)
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="selected_shows.{{$key}}" value="{{$key}}"
                                       aria-describedby="comments-description"
                                       @if( in_array($show,$character->shows->pluck('name')->toArray()))
                                       checked
                                       @endif


                                       name="selected_shows[]" type="checkbox"
                                       class=" focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="selected_shows.{{$key}}" class="font-medium text-gray-700">{{$show}}</label>
                            </div>
                        </div>
                    @endforeach

                </fieldset>


                @if (session()->has('checkbox_validation_error'))
                    <div x-data="{showFlash:true}"
                         x-init="setTimeout(() => showFlash = false, 3000)"
                         x-show="showFlash">
                        <p class="mt-1 text-sm text-red-600">
                            {{session('checkbox_validation_error')}}
                        </p>
                    </div>
                @endif


            </div>

            {{--Status--}}
            <div class="sm:col-span-3">
                <label for="status" class="block text-sm font-medium text-gray-700">
                    Status <span class="text-red-800">*</span>
                </label>

                <div class="mt-1 rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="status" class="sr-only">Show</label>
                        <select id="status" name="status"
                                wire:model="status"
                                class="focus:ring-primary-500 @error('status') border border-red-500 @enderror focus:border-primary-500 relative block w-full rounded-md
                             bg-transparent focus:z-10 sm:text-sm border-gray-300">

                            @foreach($statuses as $key => $state)
                                <option value="{{$state}}">{{$state}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                @error('status')
                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                @enderror
            </div>


            {{--Character Name--}}
            <div class="sm:col-span-3">
                <label for="name" class="block text-sm font-medium text-gray-700"
                >
                    Character Name <span class="text-red-900">*</span>
                </label>
                <div class="mt-1">
                    <input type="text" name="name"
                           wire:model="name"
                           id="name"
                           class="
                            @error('name') border border-red-500 @enderror
                               shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm
                               border-gray-300 rounded-md">
                </div>

                @error('name')
                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                @enderror
            </div>

            {{--Nickname--}}
            <div class="sm:col-span-3">
                <label for="nickname" class="block text-sm font-medium text-gray-700"
                >
                    Nickname
                </label>
                <div class="mt-1">
                    <input type="text" name="nickname"
                           wire:model="nickname"
                           id="nickname"
                           class="
                            @error('nickname') border border-red-500 @enderror
                               shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm
                               border-gray-300 rounded-md">
                </div>

                @error('nickname')
                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                @enderror
            </div>


            {{--Character Occupation--}}
            <div class="sm:col-span-3">
                <label for="occupation" class="block text-sm font-medium text-gray-700"
                >
                    Occupation
                </label>
                <div class="mt-1">
                    <input type="text" name="occupation"
                           wire:model="occupation"
                           id="occupation"
                           class="
                            @error('occupation') border border-red-500 @enderror
                               shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm
                               border-gray-300 rounded-md">
                </div>

                @error('occupation')
                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                @enderror
            </div>


        </div>

        {{--    Validate the form. If Validation passes show modal to confirm--}}
        <div class="mt-8 flex justify-end">
            <button wire:click="validateForm" type="button"
                    style="background-color: #025F47"
                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-400 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Save
            </button>
        </div>


        <x-confirm-create-modal title="Are you sure"
                                subtitle="Please confirm if you would like to update the character"/>
    </form>
</div>
