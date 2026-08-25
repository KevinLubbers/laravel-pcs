<div
    x-data="{
        view: new URLSearchParams(window.location.search).get('view') || 'card',

        setView(value) {
            this.view = value;

            const url = new URL(window.location);
            url.searchParams.set('view', value);

            window.history.pushState({}, '', url);
        },

        init() {
            window.addEventListener('popstate', () => {
                this.view =
                    new URLSearchParams(window.location.search).get('view') || 'card';
            });
        }
    }"
>
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

        <h1 class="mt-2 text-2xl font-medium text-gray-900 dark:text-white">
            Ticket Dashboard
        </h1>

        <p class="mt-4 text-gray-500 dark:text-gray-400 leading-relaxed">
        This is where you manage your tickets and your team's tickets 
        </p>
        <div class="flex flex-row items-center gap-4 mt-8">
            <x-label x-bind:class="{'underline underline-offset-4': view === 'card'}" class="cursor-pointer" @click="setView('card')" value="Card View" />
            <x-label x-bind:class="{'underline underline-offset-4': view === 'list'}" class="cursor-pointer" @click="setView('list')" value="List View" />
        </div>
        <div>
            <livewire:ticket-modal />
        </div>
    </div>

    <div x-show="view === 'card'">
        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <livewire:ticket-self-dashboard />
            </div>
            <div>
                <livewire:ticket-dashboard />    
            </div>
        </div>
    </div>
    <div x-show="view === 'list'">
        <div  class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <livewire:ticket-dashboard-list />    
            </div>
        </div>
    </div>
</div>
