<x-slot name="header">
    <h2 class="text-2xl">Channels</h2>

    <div class="relative"
         style="margin-top: -5px; margin-bottom: -5px"
         x-data="{
            search: ''
         }"
         x-init="$watch('search', (value) => {
            const url = new URL(window.location.href);
            url.searchParams.set('search', value);
            history.pushState(null, document.title, url.toString());
         })"
    >
        <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <x-jet-input type="search" sty placeholder="search..." x-model="search" @keyup.enter="window.location.reload()"
                     x-text="search" class="pl-10"/>
    </div>
</x-slot>

@if($search)
    <div class="text-gray-700 text-base my-2">
        <span class="text-gray-500 italic">Showing results for:</span> "{{ $this->search }}"
    </div>
@endif

<div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-4 bg-white">
    @foreach($channels as $channel)
        <div class="border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 p-5">
            <div class="flex flex-col items-center">
                {{--                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ $channel['logo'] }}" alt="Bonnie image"/>--}}
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $channel['channel'] }}</h5>

                <div class="flex mt-4 space-x-5 md:mt-6">
                    <a href="{{ $channel['url'] }}" target="_blank"
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Website</a>
                    <a href="{{ $channel['url'] }}" target="_blank"
                       class="hover:text-black inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Watch</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if(!count($channels))
    <div class="w-full p-10 text-center text-gray-500">
        No Channel Found
    </div>
@endif
