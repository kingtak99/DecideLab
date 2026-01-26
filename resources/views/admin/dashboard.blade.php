@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">
    <!-- Glow Effects -->
    <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-3xl"></div>
    <div class="absolute top-40 -left-40 w-[400px] h-[400px] bg-emerald-600/20 rounded-full blur-3xl"></div>

    <div class="relative px-6 py-12">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-white mb-4">
                    {{ __('messages.admin_dashboard') ?? 'Admin Dashboard' }}
                </h1>
                <p class="text-slate-400 text-lg">
                    {{ __('messages.site_analytics') ?? 'Site Analytics & Visitor Statistics' }}
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Total Visitors -->
                <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-6 border border-white/10 shadow-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">{{ __('messages.total_visitors') ?? 'Total Visitors' }}</p>
                            <p class="text-3xl font-bold text-white">{{ number_format($totalVisitors) }}</p>
                        </div>
                        <div class="p-3 bg-indigo-600/20 rounded-xl">
                            <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Today's Visitors -->
                <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-6 border border-white/10 shadow-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">{{ __('messages.today_visitors') ?? 'Today\'s Visitors' }}</p>
                            <p class="text-3xl font-bold text-white">{{ number_format($todayVisitors) }}</p>
                        </div>
                        <div class="p-3 bg-emerald-600/20 rounded-xl">
                            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- This Month's Visitors -->
                <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-6 border border-white/10 shadow-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-sm font-medium">{{ __('messages.month_visitors') ?? 'This Month\'s Visitors' }}</p>
                            <p class="text-3xl font-bold text-white">{{ number_format($monthVisitors) }}</p>
                        </div>
                        <div class="p-3 bg-blue-600/20 rounded-xl">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Daily Visitors Chart -->
                <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-6 border border-white/10 shadow-2xl">
                    <h3 class="text-xl font-bold text-white mb-6">{{ __('messages.daily_visitors_chart') ?? 'Daily Visitors (Last 30 Days)' }}</h3>
                    <canvas id="dailyVisitorsChart" width="400" height="200"></canvas>
                </div>

                <!-- Monthly Visitors Chart -->
                <div class="bg-slate-900/50 backdrop-blur-sm rounded-3xl p-6 border border-white/10 shadow-2xl">
                    <h3 class="text-xl font-bold text-white mb-6">{{ __('messages.monthly_visitors_chart') ?? 'Monthly Visitors (Last 12 Months)' }}</h3>
                    <canvas id="monthlyVisitorsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Daily Visitors Chart
    const dailyCtx = document.getElementById('dailyVisitorsChart').getContext('2d');
    const dailyLabels = @json(array_keys($dailyVisitors));
    const dailyData = @json(array_values($dailyVisitors));

    new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: '{{ __("messages.visitors") ?? "Visitors" }}',
                data: dailyData,
                borderColor: 'rgb(16, 185, 129)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: 'rgb(148, 163, 184)'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'rgb(148, 163, 184)'
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: 'rgb(148, 163, 184)'
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    }
                }
            }
        }
    });

    // Monthly Visitors Chart
    const monthlyCtx = document.getElementById('monthlyVisitorsChart').getContext('2d');
    const monthlyLabels = @json(array_keys($monthlyVisitors));
    const monthlyData = @json(array_values($monthlyVisitors));

    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: '{{ __("messages.visitors") ?? "Visitors" }}',
                data: monthlyData,
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderColor: 'rgb(59, 130, 246)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: 'rgb(148, 163, 184)'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'rgb(148, 163, 184)'
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: 'rgb(148, 163, 184)'
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    }
                }
            }
        }
    });
});
</script>
@endsection