<x-slot name="header">
    <h2 class="text-center">{{__('Manage Posts')}}</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                     role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="relative space-y-4">
                <div class="absolute left-0">
                    @if(Auth::user()->isAbleTo('create-post'))
                        <button wire:click="create()"
                                class="bg-indigo-500 text-white font-bold py-2 px-4 rounded my-3">{{__(("Create Post"))}}</button>
                    @endif
                </div>

                @if($isDialogOpen)
                    @include('livewire.modals.forms.posts')
                @endif

                <div class="absolute right-0 ">
                    <input type="text" wire:model="search" placeholder="{{__("Search Post")}}" class="rounded-lg" />
                </div>

                <br/>
                <br/>
                <br/>

            </div>





            <table class="table-fixed w-full rounded-xl">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">ID</th>
                    <th class="px-4 py-2">{{__("Title")}}</th>
                    <th class="px-4 py-2">{{__("State")}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->id }}</td>
                        <td class="border px-4 py-2">{{ $item->title }}</td>
                        <td class="border px-4 py-2">{{ $item->state}}</td>
                        <td class="border px-4 py-2">
                            @if(Auth::user()->isAbleTo('update-post') )
                                <button wire:click="edit({{ $item->id }})"
                                        class="bg-green-700 text-white font-bold py-2 px-4 rounded-md">{{__("Edit")}}</button>
                            @endif

                            @if(Auth::user()->isAbleTo('delete-post') )
                                <button wire:click="delete({{ $item->id }})"
                                        class="bg-red-700 text-white font-bold py-2 px-4 rounded-md">{{__("Delete")}}</button>
                            @endif

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <br/>
            {{ $items->links() }}
        </div>
    </div>
</div>
