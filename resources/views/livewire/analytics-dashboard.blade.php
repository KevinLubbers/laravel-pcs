<?php

use Livewire\Volt\Component;

new class extends Component {
    public $range;
    public $selectedQuery;

}; ?>

<div>
    <div class="flex flex-row">
        <div class="flex flex-col mr-4">
            <x-label for="range" value="{{ __('Select a Date Range') }}" />
            <select wire:model="range" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                <option value="today">Today</option>
                <option value="7">Last 7 Days</option>
                <option value="30">Last 30 Days</option>
                <option value="all">All Time</option>
                <option value="custom">Custom</option>
            </select>
        </div>
        <div class="flex flex-col ml-4">
            <x-label for="selectedQuery" value="{{ __('Select a Query') }}" />
            <select wire:model="selectedQuery" class="mt-1 block mb-2 rounded-md text-gray-600 border-gray-300   dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                <option value="ticketsPerSpecialist">(Count) Tickets Resolved per Specialist</option>
                <option value="divisionAvg">(Count) Tickets Submitted per Division</option>
                <option value="ticketsPerISR">(Count) Tickets Submitted per ISR</option>
                <option value="responseTime">(Average) Response Time per Specialist</option>
            </select>
        </div>
    </div>

    <!-- chart starts here -->
    <div wire:ignore
     x-data="chartComponent()"
     x-init="requestAnimationFrame(() => initChart())"
     x-on:chart-data-updated.window="updateChart($event.detail.data)">
        <canvas id="ticketChart"></canvas>
    </div>
</div>
<!-- load chart.js via cdn and chart js logic here -->
@push('scripts')
    @once
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
