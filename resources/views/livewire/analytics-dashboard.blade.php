<?php

use Livewire\Volt\Component;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\User;

new class extends Component {
    public $range = 'today';
    public $selectedQuery = 'ticketsPerSpecialist';

    public function mount(){
        $this->loadData();
    }

    public function updated($property){
        if (in_array($property, ['range', 'selectedQuery'])) {
            $this->loadData();
        }
    }

    public function loadData(){
        $query = Ticket::query();

        // Apply date filter
        switch ($this->range) {
            case 'today':
                $query->whereDate('tickets.created_at', Carbon::today());
                break;

            case '7':
                $query->where('tickets.created_at', '>=', now()->subDays(7));
                break;

            case '30':
                $query->where('tickets.created_at', '>=', now()->subDays(30));
                break;

            case 'all':
            default:
                break;
        }
        //Query Case Start
        switch ($this->selectedQuery) {
            case 'ticketsPerSpecialist':
                $data = $query
                    ->where('tickets.status', 'completed')
                    ->join('users', 'tickets.specialist_id', '=', 'users.id')
                    ->selectRaw('users.name as label, COUNT(*) as count')
                    ->groupBy('users.name')
                    ->pluck('count', 'label')
                    ->toArray();

                $label = 'Tickets Resolved';
                $title = 'Tickets Resolved per Specialist';
                break;

            case 'divisionAvg':
                $data = $query
                    ->join('divisions', 'tickets.division_id', '=', 'divisions.id')
                    ->selectRaw('divisions.name as division, COUNT(*) as count')
                    ->groupBy('division')
                    ->pluck('count', 'division')
                    ->toArray();

                $label = 'Tickets Submitted';
                $title = 'Tickets per Division';
                break;

            case 'ticketsPerISR':
                $data = $query
                    ->selectRaw('email as isr_name, COUNT(*) as count')
                    ->groupBy('isr_name')
                    ->pluck('count', 'isr_name')
                    ->toArray();

                $label = 'Tickets Submitted';
                $title = 'Tickets per ISR';
                break;

            case 'responseTime':
                $data = $query
                    ->where('tickets.status', 'completed') 
                    ->join('users', 'tickets.specialist_id', '=', 'users.id')
                    ->selectRaw('
                        users.name as label,
                        ROUND(AVG(TIMESTAMPDIFF(MINUTE, tickets.created_at, tickets.updated_at)), 2) as avg_time
                    ')
                    ->groupBy('users.name')
                    ->pluck('avg_time', 'label')
                    ->toArray();

                $label = 'Avg Response Time (minutes)';
                $title = 'Average Completion Time per Specialist';
                break;
        }
        //Query Case End

        $rangeText = match ($this->range) {
            'today' => ' (Today)',
            '7' => ' (Last 7 Days)',
            '30' => ' (Last 30 Days)',
            'all' => ' (All Time)',
            default => ''
        };

        $title .= $rangeText;
        $this->dispatch('chart-data-updated', data: $data);

        $this->dispatch('update-chart-meta',
            label: $label,
            title: $title
        );
        
    }

}; ?>

<div>
    <div class="flex flex-row">
        <div class="flex flex-col mr-4">
            <x-label for="range" value="{{ __('Select a Date Range') }}" />
            <select wire:model.live="range" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                <option value="today">Today</option>
                <option value="7">Last 7 Days</option>
                <option value="30">Last 30 Days</option>
                <option value="all">All Time</option>
                <option value="custom">Custom</option>
            </select>
        </div>
        <div class="flex flex-col ml-4">
            <x-label for="selectedQuery" value="{{ __('Select a Query') }}" />
            <select wire:model.live="selectedQuery" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                <option value="ticketsPerSpecialist">(Count) Tickets Resolved per Specialist</option>
                <option value="divisionAvg">(Count) Tickets Submitted per Division</option>
                <option value="ticketsPerISR">(Count) Tickets Submitted per ISR</option>
                <option value="responseTime">(Average) Response Time per Specialist</option>
            </select>
        </div>
    </div>


    <div class="relative">
        <div wire:loading.flex
            wire:target="range, selectedQuery"
            class="absolute inset-0 z-10 items-center justify-center bg-white/60 dark:bg-gray-900/60 backdrop-blur-sm">
            
            <div class="text-gray-900 dark:text-white justify-center items-center flex flex-col">
                Loading chart...
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
                    <circle cx="25" cy="25" r="20" stroke="#ddd" stroke-width="5" fill="none" />
                    <circle cx="25" cy="25" r="20" stroke="#2d7356" stroke-width="5" stroke-linecap="round" fill="none" stroke-dasharray="126" stroke-dashoffset="30">
                    <animate attributeName="stroke-dashoffset" from="126" to="0" dur="1.5s" repeatCount="indefinite" />
                    </circle>
                </svg>
            </div>
        </div>
    <!-- chart starts here -->
        <div wire:ignore
        x-data="chartComponent()"
        x-init="requestAnimationFrame(() => initChart())"
        x-on:chart-data-updated.window="updateChart($event.detail.data)"
        x-on:update-chart-meta.window="updateMeta($event.detail.label, $event.detail.title)"
        class="min-h-[400px] h-96">
            <canvas id="ticketChart" class="w-full h-full"></canvas>
        </div>
    </div>
</div>
<!-- load chart.js via cdn and chart js logic here -->
@push('scripts')
    @once
        <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    @endonce

    <script>
    function chartComponent() {
        return {
            chart: null,
            chartLabel: 'Tickets',
            chartTitle: 'Tickets Resolved',
            getChartColors() {
                const isDark = document.documentElement.classList.contains('dark');

                return {
                    text: isDark ? '#f9fafb' : '#1f2937',
                    grid: isDark ? '#374151' : '#e5e7eb',
                    legend: isDark ? '#f9fafb' : '#1f2937',
                    title: isDark ? '#f9fafb' : '#111827',
                    tooltipBG: isDark ? '#374151' : '#f9fafb',
                };
            },

            getChartConfig(data = { labels: [], values: [] }) {
                const colors = this.getChartColors();

                return {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: this.chartLabel,
                            data: data.values,
                            backgroundColor: '#158e87ff',
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                labels: { color: colors.legend }
                            },
                            title: {
                                display: true,
                                text: this.chartTitle,
                                color: colors.title
                            },
                            tooltip: {
                                backgroundColor: colors.tooltipBG,
                                titleColor: colors.text,
                                bodyColor: colors.text
                            }
                        },
                        scales: {
                            x: {
                                ticks: { color: colors.text },
                                grid: { color: colors.grid }
                            },
                            y: {
                                ticks: { color: colors.text },
                                grid: { color: colors.grid }
                            }
                        }
                    }
                };
            },

            updateMeta(label, title) {
                this.chartLabel = label;
                this.chartTitle = title;

                this.rebuildChart();
            },
            initChart() {
                const ctx = document.getElementById('ticketChart');

                this.chart = new Chart(ctx, this.getChartConfig());

                const observer = new MutationObserver(() => {
                    this.rebuildChart();
                });

                observer.observe(document.documentElement, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            },

            rebuildChart() {
                if (!this.chart) return;

                const ctx = document.getElementById('ticketChart');

                const data = {
                    labels: this.chart.data.labels,
                    values: this.chart.data.datasets[0].data
                };

                this.chart.destroy();

                this.chart = new Chart(ctx, this.getChartConfig(data));
            },

            updateChart(data) {
                if (!this.chart) return;

                this.chart.data.labels = Object.keys(data);
                this.chart.data.datasets[0].data = Object.values(data);

                this.chart.update();
            }
        }
    }
    </script>
    @endpush
