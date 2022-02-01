{{--Character Table--}}
<div class="mt-4">

    {{-- Show Characters Table--}}
    <div class="pb-5 border-gray-200 sm:flex sm:items-center sm:justify-between">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Characters
        </h3>
        <div class="mt-3 flex sm:mt-0 sm:ml-4">
            <a href="{{url("characters/create")}}"
               class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Create
            </a>
        </div>
    </div>

    <div class="flex justify-end mb-4">


        <div class="mt-1 flex-1">
            {{--Datatable Search Box--}}
            <x-search-datatable placeholder="Search Characters"/>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Occupation
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500  tracking-wider">
                                SHOW(s)
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">View</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($characters as $character)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">

                                        <div class="">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{$character->name}}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{$character->nickname ?? 'NA'}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$character->occupation ?? 'NA'}}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if(isset($character->shows))
                                        @if(count($character->shows->pluck('name'))>1)
                                            Breaking Bad & Better Call Saul
                                        @elseif(count($character->shows->pluck('name'))==1)
                                            {{$character->shows[0]->name}}
                                        @endif
                                    @endif

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
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

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{url("characters/$character->id")}}"
                                       class="text-primary-600 hover:text-primary-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8">
        {{$characters->links()}}
    </div>


    <x-flash-message></x-flash-message>

</div>
