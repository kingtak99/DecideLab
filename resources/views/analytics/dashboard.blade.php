@extends('layouts.app')

@section('content')
<div class="analytics-container">
    <!-- Header -->
    <div class="analytics-header">
        <h1>📊 لوحة تحكم التحليلات</h1>
        <p>Analytics Dashboard - نظام تتبع الزوار والبوتس</p>
    </div>

    <div class="filter-note" style="margin:10px 0;padding:8px;border-left:4px solid #3b82f6;background:#f0f9ff;color:#0f172a;">
        <strong>ملاحظة:</strong>
        الأرقام تستثني الزيارات ذات <code>referrer</code> الفارغ، وتستبعد User-Agent التي تحتوي على <em>Scanner</em> أو <em>Measurement</em>، وروابط مثل <code>cypex.ai/scanning</code> و<code>InternetMeasurement/1.0</code> و<em>Let&#039;s Encrypt validation server</em>، وأي IP يبدأ بـ 52., 54., 35., 3., 100., 34. أو 141.95.
    </div>

    <!-- Stats Cards Row 1 - Humans Today -->
    <div class="stats-grid">
        <!-- اليوم - الزيارات -->
        <div class="stat-card human-card">
            <div class="card-icon">👤</div>
            <div class="card-content">
                <h3>الزيارات اليوم</h3>
                <p class="stat-number">{{ $humanToday['total_visits'] }}</p>
                <p class="stat-label">زوار حقيقيون (بعد تحليل السلوك)</p>
            </div>
            <div class="card-footer">
                <span class="badge success">✓ حقيقي</span>
            </div>
        </div>

        <!-- اليوم - Social (FB in-app) -->
        <div class="stat-card social-card">
            <div class="card-icon">🔗</div>
            <div class="card-content">
                <h3>Social اليوم</h3>
                <p class="stat-number">{{ $socialToday ?? 0 }}</p>
                <p class="stat-label">Facebook In-App</p>
            </div>
            <div class="card-footer">
                <span class="badge info">ترافيك اجتماعي</span>
            </div>
            </div>
            <div class="card-footer">
                <span class="badge success">✓ حقيقي</span>
            </div>
        </div>

        <!-- اليوم - الزوار الفريدين -->
        <div class="stat-card unique-card">
            <div class="card-icon">🌍</div>
            <div class="card-content">
                <h3>زوار فريدين اليوم</h3>
                <p class="stat-number">{{ $humanToday['unique_visitors'] }}</p>
                <p class="stat-label">IP addresses مختلفة</p>
            </div>
            <div class="card-footer">
                <span class="badge info">⚡ نشط</span>
            </div>
        </div>

        <!-- اليوم - مع حساب -->
        <div class="stat-card registered-card">
            <div class="card-icon">✅</div>
            <div class="card-content">
                <h3>مسجلين النظام</h3>
                <p class="stat-number">{{ $humanToday['with_account'] }}</p>
                <p class="stat-label">مع حساب فعال</p>
            </div>
            <div class="card-footer">
                <span class="badge primary">👤 حساب</span>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row 2 - This Month -->
    <div class="month-stats">
        <h2 class="section-title">📈 إحصائيات هذا الشهر</h2>
        <div class="stats-grid">
            <div class="stat-card month-card">
                <div class="card-icon">📅</div>
                <div class="card-content">
                    <h3>إجمالي الزيارات</h3>
                    <p class="stat-number">{{ $humanMonth['total_visits'] }}</p>
                </div>
            </div>
            <div class="stat-card month-card">
                <div class="card-icon">👥</div>
                <div class="card-content">
                    <h3>زوار فريدين</h3>
                    <p class="stat-number">{{ $humanMonth['unique_visitors'] }}</p>
                </div>
            </div>
            <div class="stat-card month-card">
                <div class="card-icon">📱</div>
                <div class="card-content">
                    <h3>مع حسابات</h3>
                    <p class="stat-number">{{ $humanMonth['with_account'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bots Stats -->
    <div class="bots-stats">
        <h2 class="section-title">🤖 تقرير البوتس</h2>
        <div class="stats-grid">
            <div class="stat-card bot-card">
                <div class="card-icon">⚠️</div>
                <div class="card-content">
                    <h3>محاولات اليوم</h3>
                    <p class="stat-number">{{ $botToday['total_scans'] }}</p>
                </div>
            </div>
            <div class="stat-card bot-card">
                <div class="card-icon">🔍</div>
                <div class="card-content">
                    <h3>أجهزة فريدة اليوم</h3>
                    <p class="stat-number">{{ $botToday['unique_bots'] }}</p>
                </div>
            </div>
            <div class="stat-card bot-card">
                <div class="card-icon">🔴</div>
                <div class="card-content">
                    <h3>ماسحات أمان</h3>
                    <p class="stat-number">{{ $botToday['security_scanners'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <h2 class="section-title">📊 التصور البياني</h2>
        
        <!-- Row 1: Top Pages & Unique Visitors -->
        <div class="charts-grid">
            <div class="chart-card">
                <h3>📄 أعلى الصفحات</h3>
                <canvas id="topPagesChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>🔄 الزوار الفريدين لكل صفحة</h3>
                <canvas id="visitorsPerPageChart"></canvas>
            </div>
        </div>

        <!-- Row 2: Countries -->
        @if($chartData['countries']['labels'] && count($chartData['countries']['labels']) > 0)
        <div class="charts-grid">
            <div class="chart-card full-width">
                <h3>🌍 توزيع الزوار حسب الدول</h3>
                <canvas id="countriesChart"></canvas>
            </div>
        </div>
        @else
        <div class="charts-grid">
            <div class="chart-card full-width" style="background: #f0f9ff; border-left: 4px solid #3b82f6; text-align: center; padding: 40px;">
                <h3>🌍 توزيع الزوار حسب الدول</h3>
                <p style="color: #1e40af; font-size: 1rem; margin: 20px 0;">
                    لا توجد بيانات دول بعد. سيتم تسجيل البيانات مع الزيارات الجديدة.
                </p>
                <p style="color: #64748b; font-size: 0.9rem;">
                    ℹ️ تم إضافة تتبع الدول حديثاً، البيانات ستظهر من الزيارات القادمة
                </p>
            </div>
        </div>
        @endif
    </div>

    <!-- Session Duration Stats -->
    @if($sessionStats && $sessionStats->avg_duration > 0)
    <div class="session-stats">
        <h2 class="section-title">⏱️ إحصائيات جلسات المستخدمين</h2>
        <div class="stats-grid">
            <div class="stat-card session-card">
                <div class="card-icon">⏱️</div>
                <div class="card-content">
                    <h3>متوسط المدة</h3>
                    <p class="stat-number">{{ gmdate('H:i:s', intval($sessionStats->avg_duration)) }}</p>
                    <p class="stat-label">{{ number_format($sessionStats->avg_duration, 0) }} ثانية</p>
                </div>
            </div>
            <div class="stat-card session-card">
                <div class="card-icon">🏃</div>
                <div class="card-content">
                    <h3>أطول جلسة</h3>
                    <p class="stat-number">{{ gmdate('H:i:s', intval($sessionStats->max_duration)) }}</p>
                    <p class="stat-label">{{ number_format($sessionStats->max_duration, 0) }} ثانية</p>
                </div>
            </div>
            <div class="stat-card session-card">
                <div class="card-icon">🐢</div>
                <div class="card-content">
                    <h3>أقصر جلسة</h3>
                    <p class="stat-number">{{ gmdate('H:i:s', intval($sessionStats->min_duration)) }}</p>
                    <p class="stat-label">{{ number_format($sessionStats->min_duration, 0) }} ثانية</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Countries Table -->
    @if($countryStats->count() > 0)
    <div class="countries-section">
        <h2 class="section-title">🌍 دول الزوار</h2>
        <div class="table-wrapper">
            <table class="countries-table">
                <thead>
                    <tr>
                        <th>الدولة</th>
                        <th>الكود</th>
                        <th>عدد الزوار الفريدين</th>
                        <th>النسبة المئوية</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalVisitors = $countryStats->sum('visitors'); @endphp
                    @foreach($countryStats as $country)
                    <tr>
                        <td><strong>{{ $country->country }}</strong></td>
                        <td><span class="country-badge">{{ $country->country_code }}</span></td>
                        <td>{{ $country->visitors }}</td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ ($country->visitors / $totalVisitors) * 100 }}%"></div>
                            </div>
                            <span class="percentage">{{ number_format(($country->visitors / $totalVisitors) * 100, 1) }}%</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="countries-section">
        <h2 class="section-title">🌍 دول الزوار</h2>
        <div style="background: #f0f9ff; border: 2px solid #93c5fd; border-radius: 12px; padding: 40px; text-align: center;">
            <p style="color: #1e40af; font-size: 1rem; margin: 0;">
                📍 لا توجد بيانات الدول بعد
            </p>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 10px;">
                سيتم تسجيل بيانات الدول مع الزيارات الجديدة من خلال نظام تتبع الدول
            </p>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('analytics.detected-bots', ['locale' => session('locale', 'ar')]) }}" class="btn btn-primary">
            🤖 عرض البوتس المكتشفة
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            ⚙️ لوحة التحكم الرئيسية
        </a>
    </div>
</div>

<style>
.analytics-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    direction: rtl;
    background: #f8fafc;
}

.analytics-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    color: white;
    box-shadow: 0 8px 16px rgba(102, 126, 234, 0.2);
}

.analytics-header h1 {
    margin: 0 0 10px;
    font-size: 2.5rem;
    font-weight: 800;
    letter-spacing: -1px;
}

.analytics-header p {
    margin: 0;
    opacity: 0.95;
    font-size: 1.1rem;
}

.section-title {
    font-size: 1.4rem;
    color: #1f2937;
    margin: 30px 0 20px;
    font-weight: 700;
    padding-bottom: 10px;
    border-bottom: 3px solid #667eea;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    border-left: 4px solid #667eea;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
}

.stat-card.human-card {
    border-left-color: #10b981;
}

.stat-card.unique-card {
    border-left-color: #3b82f6;
}

.stat-card.registered-card {
    border-left-color: #f59e0b;
}

.stat-card.month-card {
    border-left-color: #ec4899;
}

.stat-card.bot-card {
    border-left-color: #ef4444;
}

.stat-card.session-card {
    border-left-color: #8b5cf6;
}

.card-icon {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.card-content h3 {
    margin: 0 0 8px;
    color: #6b7280;
    font-size: 0.95rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-number {
    margin: 0;
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937;
}

.stat-label {
    margin: 8px 0 0;
    color: #9ca3af;
    font-size: 0.85rem;
}

.card-footer {
    display: flex;
    gap: 8px;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #e5e7eb;
}

.badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge.success {
    background-color: #dcfce7;
    color: #166534;
}

.badge.info {
    background-color: #dbeafe;
    color: #1e40af;
}

.badge.primary {
    background-color: #fef3c7;
    color: #b45309;
}

/* Charts Section */
.charts-section {
    margin-top: 40px;
}

.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.chart-card.full-width {
    grid-column: 1 / -1;
}

.chart-card h3 {
    margin: 0 0 20px;
    color: #1f2937;
    font-size: 1.1rem;
    font-weight: 700;
}

.chart-card canvas {
    max-height: 400px;
}

/* Session Stats */
.session-stats {
    margin-top: 40px;
}

/* Countries Section */
.countries-section {
    margin-top: 40px;
}

.table-wrapper {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.countries-table {
    width: 100%;
    border-collapse: collapse;
}

.countries-table thead {
    background-color: #f3f4f6;
    border-bottom: 2px solid #e5e7eb;
}

.countries-table th {
    padding: 15px;
    text-align: right;
    font-weight: 700;
    color: #1f2937;
    font-size: 0.9rem;
}

.countries-table td {
    padding: 15px;
    border-bottom: 1px solid #e5e7eb;
}

.countries-table tbody tr:hover {
    background-color: #f9fafb;
}

.country-badge {
    display: inline-block;
    background-color: #dbeafe;
    color: #1e40af;
    padding: 4px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-family: monospace;
    font-size: 0.85rem;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background-color: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 5px;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transition: width 0.3s ease;
}

.percentage {
    font-size: 0.85rem;
    color: #6b7280;
    font-weight: 600;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 40px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    display: inline-block;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.btn-secondary {
    background: #f3f4f6;
    color: #1f2937;
    border: 2px solid #d1d5db;
}

.btn-secondary:hover {
    background: #e5e7eb;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .analytics-container {
        padding: 15px;
    }

    .analytics-header h1 {
        font-size: 1.8rem;
    }

    .analytics-header p {
        font-size: 0.95rem;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .charts-grid {
        grid-template-columns: 1fr;
    }

    .chart-card canvas {
        max-height: 300px;
    }

    .section-title {
        font-size: 1.2rem;
    }

    .stat-number {
        font-size: 1.5rem;
    }
}
</style>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Colors
    const colors = [
        'rgba(102, 126, 234, 0.8)',
        'rgba(118, 75, 162, 0.8)',
        'rgba(16, 185, 129, 0.8)',
        'rgba(59, 130, 246, 0.8)',
        'rgba(245, 158, 11, 0.8)',
    ];

    // Top Pages Chart
    @if($chartData['pages']['labels'])
    new Chart(document.getElementById('topPagesChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['pages']['labels']) !!},
            datasets: [{
                label: 'عدد الزيارات',
                data: {!! json_encode($chartData['pages']['data']) !!},
                backgroundColor: colors[0],
                borderRadius: 6,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { beginAtZero: true }
            }
        }
    });
    @endif

    // Visitors Per Page Chart
    @if($chartData['visitors_by_page']['labels'])
    new Chart(document.getElementById('visitorsPerPageChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['visitors_by_page']['labels']) !!},
            datasets: [{
                label: 'زوار فريدين',
                data: {!! json_encode($chartData['visitors_by_page']['data']) !!},
                backgroundColor: colors[1],
                borderRadius: 6,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { beginAtZero: true }
            }
        }
    });
    @endif

    // Countries Chart
    @if($chartData['countries']['labels'])
    new Chart(document.getElementById('countriesChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($chartData['countries']['labels']) !!},
            datasets: [{
                data: {!! json_encode($chartData['countries']['data']) !!},
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(118, 75, 162, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(14, 165, 233, 0.8)',
                ],
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    rtl: true,
                }
            }
        }
    });
    @endif
});
</script>

@endsection
