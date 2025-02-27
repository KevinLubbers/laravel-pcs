<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
        Create, Edit, or Delete Specialists
    </h1>

    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
        Manage the Specialists in the Team and their assigned models, divisions, and tasks.
    </p>
</div>

<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">

    <div class="">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create New Specialist:
                </h2>
            </div>

            <p class="mt-4  text-sm leading-relaxed">
                @livewire('specialist-create')
            </p>

            <p class="mt-4 text-sm text-gray-900 dark:text-white leading-relaxed">
                Initial Password is set to: <b>password</b> for all new specialists
            </p>


            <div class="flex items-center mt-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create New Task:
                </h2>
            </div>

            <p class="mt-4  text-sm leading-relaxed">
                @livewire('maintenance-task-create')
            </p>
    </div>
    <livewire:combolist lazy />
</div>

