<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
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

            // 🔥 NEW: build chart config in one place
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

                this.rebuildChart(); // 🔥 reuse your existing method
            },
            initChart() {
                const ctx = document.getElementById('ticketChart');

                // create empty chart
                this.chart = new Chart(ctx, this.getChartConfig());

                // 🔥 WATCH FOR DARK MODE CHANGES
                const observer = new MutationObserver(() => {
                    this.rebuildChart();
                });

                observer.observe(document.documentElement, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            },

            // 🔥 NEW: fully rebuild chart on theme change
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
