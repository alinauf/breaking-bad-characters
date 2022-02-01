<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

    <div class="px-3 sm:px-0"
         x-data="{
            'showDeleteModal': false,
            keydown(){
                this.showDeleteModal=false;
            }
        }" @keydown.escape="keydown()"
    >

        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class="p-6 bg-white ">
                        <div class="overflow-hidden ">
                            <div class="px-4 py-5 sm:px-6 flex justify-between">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Character Information
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        View character details and manage
                                    </p>
                                </div>
                                <div class="flex">
                                    <span class="hidden sm:block">
                                    <a href="{{ url("characters/$character->id/edit") }}"
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        <!-- Heroicon name: solid/pencil -->
                                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                        Edit
                                    </a>
                                </span>

                                    <span class="hidden sm:block ml-3">
                            <button type="button" @click="showDeleteModal=true"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <!-- Heroicon name: solid/link -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                          clip-rule="evenodd"/>
                                </svg>
                                Delete
                            </button>
                        </span>

                                </div>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                <div class="grid grid-cols-1 sm:grid-cols-3">

                                    <div class="block col-span-1 mb-4 sm:hidden">
                                        <div class="mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:p-0 lg:h-full">
                                            <div class="rounded-xl  overflow-hidden  aspect-none ">
                                                <img class="object-cover lg:h-full lg:w-full"
                                                     src="{{$character->img_url}}" alt="">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="sm:col-span-2 ">
                                        <div class="grid ml-4 sm:ml-0 gap-x-4 grid-cols-2 gap-y-6">
                                            <div class="col-span-1">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Name
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    {{$character->name}}
                                                </dd>
                                            </div>
                                            <div class="col-span-1">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Status
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    @if(str_replace(' ', '', $character->status)=='Alive')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                         bg-green-100 text-green-800">
                                          {{$character->status}}
                                        </span>
                                                    @elseif(str_replace(' ', '', $character->status)=='Unknown	')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                         bg-yello-100 text-yello-800">
                                          {{$character->status}}
                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                         bg-red-100 text-red-800">
                                          {{$character->status}}
                                        </span>
                                                    @endif
                                                </dd>
                                            </div>
                                            <div class="col-span-1">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Shows
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    @if(isset($character->shows))
                                                        @if(count($character->shows->pluck('name'))>1)
                                                            Breaking Bad & Better Call Saul
                                                        @elseif(count($character->shows->pluck('name'))==1)
                                                            {{$character->shows[0]->name}}
                                                        @endif
                                                    @endif
                                                </dd>
                                            </div>
                                            <div class="col-span-1">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    Occupation
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    {{$character->occupation}}
                                                </dd>
                                            </div>

                                            @if(count($character->quotes) > 0)
                                                <div class="col-span-2 mr-3">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Qoutes
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                        <ul class="list-disc ml-3">
                                                            @foreach($character->quotes as $quote)
                                                                <li class="mt-1 font-medium">{{$quote->quote}}</li>
                                                            @endforeach
                                                        </ul>

                                                    </dd>
                                                </div>
                                            @endif

                                            @if($deathInformation!='NA' && $deathInformation!=null)
                                                <div class="col-span-2">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                        Death Information
                                                    </h3>
                                                </div>

                                                <div class="col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Cause
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                        {{$deathInformation->cause}}
                                                    </dd>
                                                </div>

                                                <div class="col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Responsible
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                        {{$deathInformation->responsible}}
                                                    </dd>
                                                </div>

                                                <div class="col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Last words
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                        {{$deathInformation->last_words}}
                                                    </dd>
                                                </div>

                                                <div class="col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Died Season and Episode
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                        Season: {{$deathInformation->season}},
                                                        Episode: {{$deathInformation->episode}}
                                                    </dd>
                                                </div>





                                            @endif

                                            @if($deathsCaused!='NA' && $deathsCaused!=null)
                                                <div class="col-span-2">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                        Death's Caused
                                                    </h3>
                                                </div>

                                                <div class="col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Death's Caused Count
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                        {{$deathsCaused->deathCount}}
                                                    </dd>
                                                </div>


                                            @endif


                                        </div>

                                    </div>
                                    <div class="hidden sm:block sm:col-span-1 mt-4 sm:mt-0">
                                        <div class="mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:p-0 lg:h-full">
                                            <div class="rounded-xl overflow-hidden  aspect-none ">
                                                @if($character->img_url!=null&&$character->img_url!='')
                                                <img class="object-cover lg:h-full lg:w-full"
                                                     src="{{$character->img_url}}" alt="">
                                                    @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Delete Modal --}}
        <div class="fixed z-10 inset-0 overflow-y-auto" x-show="showDeleteModal" aria-labelledby="modal-title"
             role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div>
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <!-- Heroicon name: outline/trash -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>

                        </div>
                        <form action="{{ url("characters/$character->id") }}" method="post">
                            @method('DELETE')
                            @csrf
                            <div class="mt-3 text-center sm:mt-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Are you sure?
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Please confirm if you would like to delete the character
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                <button type="submit"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm">
                                    Delete the Character
                                </button>
                                <button type="button" @click="showDeleteModal=false"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                    Back
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>


    </div>


    <x-flash-message></x-flash-message>
</x-app-layout>

