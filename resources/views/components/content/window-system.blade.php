<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
        System Maintenance
    </h1>


    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
        Create, Edit, or Delete Manufacturers, Divisions, Models and Tasks
    </p>
</div>

<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-centertext-sm leading-relaxedml-3 text-xl font-semibold text-gray-900 dark:text-white">
            Manufacturer Overview List:
        </div>

        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
           <!--add @ livewire tags here to generate each form / action -->
           @livewire('specialist-container')
           
        </p>

        <p class="mt-4 text-sm">
           <!--footer / redirect--> 
        </p>
    </div>

    <div class="">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                Create New Manufacturer:
            </h2>
        </div>

        <p class="mt-4  text-sm leading-relaxed">
            @livewire('maintenance-man-create')
        </p>

        <div class="flex items-center mt-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                Create New Division:
            </h2>
        </div>

        <p class="mt-4  text-sm leading-relaxed">
            @livewire('maintenance-div-create')
        </p>
        <div class="flex items-center mt-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                Create New Model:
            </h2>
        </div>

        <p class="mt-4  text-sm leading-relaxed">
            @livewire('maintenance-model-create')
        </p>
    </div>

