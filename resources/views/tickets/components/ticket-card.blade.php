{{-- Main Container --}}
<div class="space-y-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @foreach($softwares as $software)
        {{-- Software Section --}}
        <div class="border-b border-gray-200 dark:border-gray-700 pb-8 transform transition-all duration-300 hover:border-blue-500">
            {{-- Software Header with Arrow --}}
            <div class="flex items-center justify-between mb-6 cursor-pointer group p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-300" 
                 onclick="toggleContent(this)" 
                 data-expanded="false">
                <div class="space-y-2">
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        {{ $software['name'] }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 hidden description transform transition-all duration-500 opacity-0">
                        {{ $software['description'] }}
                    </p>
                </div>
                <svg class="w-6 h-6 transform transition-all duration-300 rotate-[-90deg] text-blue-600 group-hover:scale-110" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>

            {{-- Tickets Grid --}}
            <div class="tickets-container grid-cols-1 md:grid-cols-2 gap-8 hidden opacity-0 transform translate-y-4 transition-all duration-500">
                @foreach($software['tickets'] as $key => $ticket)
                <div class="relative group {{ $key % 2 == 0 ? 'ml-0' : 'ml-12' }} mb-6">
                    <div class="absolute -inset-0.5  rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative p-6 bg-white dark:bg-gray-800 rounded-lg ring-1 ring-gray-900/5 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $ticket['priority'] === 'High' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                                   ($ticket['priority'] === 'Medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                                   'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200') }}">
                                {{ $ticket['priority'] }}
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $ticket['created_at'] }}</span>
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 transition-colors duration-200">
                            {{ $ticket['title'] }}
                        </h3>
                        
                        <p class="text-gray-500 dark:text-gray-400 mb-6 line-clamp-2">
                            {{ $ticket['description'] }}
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center group/avatar">
                                <img class="h-10 w-10 rounded-full ring-2 ring-blue-500 transform transition-transform duration-300 group-hover/avatar:scale-110" 
                                     src="{{ $ticket['assigned_to']['avatar'] }}" 
                                     alt="">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover/avatar:text-blue-600 transition-colors duration-200">
                                        {{ $ticket['assigned_to']['name'] }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Assigned to
                                    </p>
                                </div>
                            </div>
                            
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium transition-colors duration-200
                                {{ $ticket['status'] === 'Open' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' :
                                   ($ticket['status'] === 'In Progress' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' :
                                   'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200') }}">
                                {{ $ticket['status'] }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

{{-- Enhanced script with smooth animations --}}
<script>
    function toggleContent(element) {
        const ticketsContainer = element.parentElement.querySelector('.tickets-container');
        const description = element.querySelector('.description');
        const arrow = element.querySelector('svg');
        const isExpanded = element.dataset.expanded === 'true';
        
        if (isExpanded) {
            ticketsContainer.style.opacity = '0';
            ticketsContainer.style.transform = 'translateY(1rem)';
            description.style.opacity = '0';
            arrow.style.transform = 'rotate(-90deg)';
            
            setTimeout(() => {
                ticketsContainer.classList.add('hidden');
                ticketsContainer.classList.remove('grid');
                description.classList.add('hidden');
            }, 300);
        } else {
            ticketsContainer.classList.remove('hidden');
            ticketsContainer.classList.add('grid');
            description.classList.remove('hidden');
            
            // Trigger reflow
            ticketsContainer.offsetHeight;
            
            ticketsContainer.style.opacity = '1';
            ticketsContainer.style.transform = 'translateY(0)';
            description.style.opacity = '1';
            arrow.style.transform = 'rotate(0deg)';
        }
        
        element.dataset.expanded = !isExpanded;
    }
</script>