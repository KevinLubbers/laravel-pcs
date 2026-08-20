<div x-data="{ view: 'card' }" @set-view.window="view = $event.detail">
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

        <h1 class="mt-2 text-2xl font-medium text-gray-900 dark:text-white">
            Ticket Dashboard
        </h1>

        <p class="mt-4 text-gray-500 dark:text-gray-400 leading-relaxed">
        This is where you manage your tickets and your team's tickets 
        </p>
        <div class="flex flex-row items-center gap-4 mt-8">
            <x-label x-bind:class="{'underline underline-offset-4': view === 'card'}" class="cursor-pointer" @click="$dispatch('set-view', 'card')" value="Card View" />
            <x-label x-bind:class="{'underline underline-offset-4': view === 'list'}" class="cursor-pointer" @click="$dispatch('set-view', 'list')" value="ListView" />
        </div>
        <div>
            <livewire:ticket-modal />
        </div>
    </div>

    <template x-if="view === 'card'">
        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <livewire:ticket-self-dashboard />
            </div>
            <div>
                <livewire:ticket-dashboard />    
            </div>
        </div>
    </template>
    <template x-if="view === 'list'">
        <div  class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <livewire:ticket-dashboard-list />    
            </div>
        </div>
    </template>
</div>
