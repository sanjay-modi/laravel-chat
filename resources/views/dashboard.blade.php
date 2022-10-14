<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- This is an example component -->
                    <div class="grid grid-cols-3 min-w-full border rounded" style="min-height: 80vh;">
                            <div class="col-span-1 bg-white border-r border-gray-300">
                                <div class="my-3 mx-3 ">
                                    <div class="relative text-gray-600 focus-within:text-gray-400">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-500"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </span>
                                        <input aria-placeholder="Serach member" placeholder="Serach member"
                                        class="py-2 pl-10 block w-full rounded bg-gray-100 outline-none focus:text-gray-700" type="search" name="search" required autocomplete="search" />
                                    </div>
                                </div>

                                <ul class="overflow-auto">
                                    <h2 class="ml-2 mb-2 text-gray-600 text-lg my-2">Chats</h2>
                                    <li>
                                    @foreach ($users as $key => $user) 

                                        <!-- bg-gray-100 -->
                                        <a class="hover:bg-gray-100 border-b border-gray-300 px-3 py-2 cursor-pointer flex items-center text-sm focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out user-item" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ url('img/user-icon.jpg')}}" alt="username" />
                                            <div class="w-full pb-4">
                                                <div class="flex justify-between">
                                                    <span class="block ml-2 font-semibold text-base text-gray-600">{{ $user->name }}</span>
                                                    <div id="message-count-{{ $user->id }}">
                                                    @if($user->messages_count != 0)
                                                    <span class="block ml-2 text-sm text-gray-600 message-count border rounded">{{ $user->messages_count }}</span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <!-- <span class="block ml-2 text-sm text-gray-600">I am fine</span> -->
                                            </div>
                                        </a>

                                    @endforeach

                                    </li>
                                </ul>
                            </div>
                            <div class="col-span-2 bg-white">
                                <div class="w-full">
                                    <div class="flex items-center border-b border-gray-300 pl-3 py-3" style="display: none;" id="receiver_user_details">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ url('img/user-icon.jpg' )}}" alt="username" />
                                        <span class="block ml-2 font-bold text-base text-gray-600" id="receiver_user_name"></span>
                                        <!-- <span class="connected text-green-500 ml-2" >
                                            <svg width="6" height="6">
                                                <circle cx="3" cy="3" r="3" fill="currentColor"></circle>
                                            </svg>
                                        </span> -->
                                    </div>
                                    <div id="chat" class="w-full overflow-y-auto p-10 relative" style="height: 700px;" ref="toolbarChat">
                                        <ul>
                                            <li id="chat-area" class="clearfix2">
                                            <div class="w-full flex msgBox"><div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;"><span class="block">Select user for chat</span><span class="block text-xs text-right"></span></div><span class="block text-xs text-right ml-2 mt-2 cursor-pointer delMsg" data-msgid=""></span></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <form id="messageForm" style="display: none;">
                                    <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">
                                        
                                        <input aria-placeholder="Enter the message" placeholder="Enter the message" class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700" type="text" name="message" id="message" required/>
                                        <input type="hidden" id="selected-user-id">
                                        <button class="outline-none focus:outline-none" type="submit" id="sendMessage">
                                            <svg class="text-gray-400 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                            </svg>
                                        </button>
                                        
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
