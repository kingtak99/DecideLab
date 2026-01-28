@extends('layouts.app')

@section('content')
<div class="analytics-container">
    <!-- Header -->
    <div class="analytics-header">
        <h1>📊 لوحة تحكم التحليلات</h1>
        <p>Analytics Dashboard - نظام تتبع الزوار والبوتس</p>
    </div>

    <!-- Stats Cards Row 1 - Humans -->
    <div class="stats-grid">
        <!-- اليوم - الزيارات -->
        <div class="stat-card human-card">
            <div class="card-icon">👤</div>
            <div class="card-content">
                <h3>الزيارات اليوم</h3>
                <p class="stat-number">{{ $humanToday['total_visits'] }}</p>
                <p class="stat-label">زائر فقط (بدون بوتس)</p>
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
    <div class="stats-section">
        <h2>📈 هذا الشهر</h2>
        <div class="stats-grid">
            <div class="stat-card month-card">
                <div class="card-icon">📊</div>
                <div class="card-content">
                    <h3>الزيارات الكلية</h3>
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
                <div class="card-icon">🔐</div>
                <div class="card-content">
                    <h3>مع حساب</h3>
                    <p class="stat-number">{{ $humanMonth['with_account'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bots Section -->
    <div class="stats-section">
        <h2>🤖 البوتس والـ Scanners</h2>
        <div class="stats-grid">
            <!-- بوتس اليوم -->
            <div class="stat-card bot-card">
                <div class="card-header warning">
                    <span>🤖 البوتس اليوم</span>
                </div>
                <div class="card-body">
                    <div class="stat-item">
                        <span>عمليات Scanning:</span>
                        <strong>{{ $botToday['total_scans'] }}</strong>
                    </div>
                    <div class="stat-item">
                        <span>بوتس فريدة:</span>
                        <strong>{{ $botToday['unique_bots'] }}</strong>
                    </div>
                    <div class="stat-item">
                        <span>Security Scanners:</span>
                        <strong class="danger">{{ $botToday['security_scanners'] }}</strong>
                    </div>
                </div>
            </div>

            <!-- بوتس الشهر -->
            <div class="stat-card bot-card">
                <div class="card-header warning">
                    <span>📊 البوتس هذا الشهر</span>
                </div>
                <div class="card-body">
                    <div class="stat-item">
                        <span>عمليات Scanning:</span>
                        <strong>{{ $botMonth['total_scans'] }}</strong>
                    </div>
                    <div class="stat-item">
                        <span>بوتس فريدة:</span>
                        <strong>{{ $botMonth['unique_bots'] }}</strong>
                    </div>
                    <div class="stat-item info-text">
                        ⚠️ ليست زيارات حقيقية بل عمليات مراقبة
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <h4>ℹ️ معلومات مهمة</h4>
                <ul>
                    <li>✅ الأرقام الخضراء = زوار حقيقيين</li>
                    <li>🔴 الأرقام الحمراء = بوتس وعمليات مسح</li>
                    <li>📡 Security Scanners = أدوات أمان معروفة</li>
                    <li>🎯 الأرقام محدثة في الوقت الفعلي</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Top Pages -->
    @if($topPages->count() > 0)
    <div class="stats-section">
        <h2>📍 أعلى الصفحات المزارة</h2>
        <div class="table-container">
            <table class="analytics-table">
                <thead>
                    <tr>
                        <th>الصفحة</th>
                        <th>الزيارات</th>
                        <th>النسبة</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPageVisits = $topPages->sum('visits');
                    @endphp
                    @foreach($topPages as $page)
                    <tr>
                        <td>
                            <a href="{{ $page->url }}" target="_blank" class="page-link">
                                {{ Str::limit($page->url, 60) }}
                            </a>
                        </td>
                        <td class="visits">{{ $page->visits }}</td>
                        <td>
                            <div class="progress-bar">
                                <div class="progress" style="width: {{ ($page->visits / $totalPageVisits) * 100 }}%"></div>
                                <span>{{ round(($page->visits / $totalPageVisits) * 100) }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="action-section">
        <h2>🔗 أدوات إضافية</h2>
        <div class="button-group">
            <a href="{{ route('analytics.detected-bots') }}" class="btn btn-primary">
                📋 عرض قائمة البوتس المكتشفة
            </a>
            <a href="{{ route('api.stats') }}" class="btn btn-secondary">
                📊 الإحصائيات JSON API
            </a>
            <a href="javascript:location.reload()" class="btn btn-outline">
                🔄 تحديث البيانات
            </a>
        </div>
    </div>
</div>

<style>
.analytics-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    direction: rtl;
}

.analytics-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    color: white;
}

.analytics-header h1 {
    margin: 0;
    font-size: 2.5rem;
    font-weight: 700;
}

.analytics-header p {
    margin: 10px 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-top: 4px solid #667eea;
    display: flex;
    flex-direction: column;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.stat-card.human-card {
    border-top-color: #10b981;
}

.stat-card.unique-card {
    border-top-color: #3b82f6;
}

.stat-card.registered-card {
    border-top-color: #8b5cf6;
}

.stat-card.month-card {
    border-top-color: #f59e0b;
}

.stat-card.bot-card {
    border-top-color: #ef4444;
}

.card-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.card-content h3 {
    margin: 0 0 10px;
    font-size: 0.95rem;
    color: #666;
    font-weight: 600;
}

.stat-number {
    margin: 0;
    font-size: 2.2rem;
    font-weight: 800;
    color: #1f2937;
    line-height: 1;
}

.stat-label {
    margin: 5px 0 0;
    font-size: 0.85rem;
    color: #999;
}

.card-footer {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #e5e7eb;
}

.badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge.success {
    background-color: #d1fae5;
    color: #065f46;
}

.badge.info {
    background-color: #dbeafe;
    color: #1e40af;
}

.badge.primary {
    background-color: #e9d5ff;
    color: #5b21b6;
}

.card-header {
    padding: 12px 15px;
    background-color: #fef3c7;
    border-radius: 8px 8px 0 0;
    font-weight: 600;
    color: #92400e;
}

.card-body {
    padding: 15px;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
    font-size: 0.9rem;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-item strong {
    color: #1f2937;
    font-weight: 700;
}

.stat-item.info-text {
    background-color: #fef08a;
    padding: 10px 12px;
    border-radius: 6px;
    border: none;
    margin-top: 10px;
}

.danger {
    color: #dc2626 !important;
}

.info-box {
    background-color: #eff6ff;
    border-left: 4px solid #3b82f6;
    padding: 20px;
    border-radius: 8px;
}

.info-box h4 {
    margin: 0 0 10px;
    color: #1e40af;
    font-size: 1rem;
}

.info-box ul {
    margin: 0;
    padding-left: 20px;
}

.info-box li {
    margin: 5px 0;
    color: #1e40af;
    font-size: 0.9rem;
}

.stats-section {
    margin-bottom: 40px;
}

.stats-section h2 {
    margin: 0 0 20px;
    color: #1f2937;
    font-size: 1.5rem;
    font-weight: 700;
}

.table-container {
    overflow-x: auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.analytics-table {
    width: 100%;
    border-collapse: collapse;
}

.analytics-table thead {
    background-color: #f3f4f6;
    border-bottom: 2px solid #e5e7eb;
}

.analytics-table th {
    padding: 15px;
    text-align: right;
    font-weight: 600;
    color: #1f2937;
    font-size: 0.9rem;
}

.analytics-table td {
    padding: 15px;
    border-bottom: 1px solid #e5e7eb;
}

.analytics-table tbody tr:hover {
    background-color: #f9fafb;
}

.page-link {
    color: #667eea;
    text-decoration: none;
    word-break: break-all;
}

.page-link:hover {
    text-decoration: underline;
}

.visits {
    font-weight: 600;
    color: #1f2937;
}

.progress-bar {
    display: flex;
    align-items: center;
    gap: 10px;
}

.progress {
    flex: 1;
    height: 8px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 4px;
    min-width: 100px;
}

.action-section {
    margin-bottom: 40px;
}

.action-section h2 {
    margin: 0 0 20px;
    color: #1f2937;
    font-size: 1.5rem;
    font-weight: 700;
}

.button-group {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
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
    background-color: #10b981;
    color: white;
}

.btn-secondary:hover {
    background-color: #059669;
    transform: translateY(-2px);
}

.btn-outline {
    border: 2px solid #667eea;
    color: #667eea;
    background: transparent;
}

.btn-outline:hover {
    background-color: #667eea;
    color: white;
}

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

    .stat-number {
        font-size: 1.8rem;
    }

    .button-group {
        flex-direction: column;
    }

    .btn {
        width: 100%;
        text-align: center;
    }
}
</style>
@endsection
