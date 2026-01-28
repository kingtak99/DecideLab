@extends('layouts.app')

@section('content')
<div class="bots-container">
    <!-- Header -->
    <div class="bots-header">
        <h1>🤖 البوتس والـ Crawlers المكتشفة</h1>
        <p>Detected Bots and Security Scanners</p>
    </div>

    <!-- Info Box -->
    <div class="info-alert">
        <div class="alert-icon">ℹ️</div>
        <div class="alert-content">
            <h3>معلومات مهمة</h3>
            <p>
                هذه القائمة تحتوي على جميع عمليات المراقبة والتفحص الأمني والـ crawlers
                التي حاولت الوصول لموقعك. <strong>هذه ليست زيارات حقيقية من مستخدمين.</strong>
            </p>
        </div>
    </div>

    @if($bots->count() > 0)
    <div class="bots-content">
        <div class="bots-stats">
            <div class="stat-badge">
                <span class="badge-label">إجمالي محاولات</span>
                <span class="badge-value">{{ $bots->sum('scan_count') }}</span>
            </div>
            <div class="stat-badge">
                <span class="badge-label">بوتس فريدة</span>
                <span class="badge-value">{{ $bots->count() }}</span>
            </div>
        </div>

        <div class="table-wrapper">
            <table class="bots-table">
                <thead>
                    <tr>
                        <th>User-Agent</th>
                        <th>IP Address</th>
                        <th>المحاولات</th>
                        <th>النوع</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bots as $bot)
                    <tr class="bot-row">
                        <td class="user-agent">
                            <span class="agent-badge">
                                {{ Str::limit($bot->user_agent, 50) }}
                            </span>
                        </td>
                        <td class="ip-address">
                            <code>{{ $bot->ip_address }}</code>
                        </td>
                        <td class="attempts">
                            <span class="attempt-badge">{{ $bot->scan_count }}</span>
                        </td>
                        <td class="type">
                            @if(str_contains(strtolower($bot->user_agent), 'censys') || 
                                str_contains(strtolower($bot->user_agent), 'palo alto') ||
                                str_contains(strtolower($bot->user_agent), 'zgrab'))
                                <span class="type-badge security">
                                    🔴 Security Scanner
                                </span>
                            @elseif(str_contains(strtolower($bot->user_agent), 'googlebot') || 
                                    str_contains(strtolower($bot->user_agent), 'bingbot'))
                                <span class="type-badge search">
                                    🔵 Search Engine
                                </span>
                            @else
                                <span class="type-badge crawler">
                                    🟡 Crawler/Bot
                                </span>
                            @endif
                        </td>
                        <td class="status">
                            <span class="status-badge">✓ مكتشف</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $bots->links() }}
        </div>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon">✅</div>
        <p>لا توجد بوتس مكتشفة في هذا الشهر!</p>
    </div>
    @endif

    <!-- Security Tips -->
    <div class="security-tips">
        <h3>💡 نصائح الأمان</h3>
        <div class="tips-grid">
            <div class="tip-card">
                <div class="tip-icon">🔐</div>
                <h4>Palo Alto Networks</h4>
                <p>عمليات تفحص أمان من خدمة الأمان السحابية</p>
            </div>
            <div class="tip-card">
                <div class="tip-icon">🔍</div>
                <h4>Censys</h4>
                <p>محرك بحث لخوادم الإنترنت والخدمات</p>
            </div>
            <div class="tip-card">
                <div class="tip-icon">🕸️</div>
                <h4>ZGrab</h4>
                <p>أداة مسح الشبكات من مشروع Censys</p>
            </div>
            <div class="tip-card">
                <div class="tip-icon">🌐</div>
                <h4>Search Engines</h4>
                <p>زحافات Google و Bing (طبيعية وآمنة)</p>
            </div>
            <div class="tip-card">
                <div class="tip-icon">⚙️</div>
                <h4>Tools & Libraries</h4>
                <p>أدوات أتمتة: Python-requests, Curl, etc</p>
            </div>
            <div class="tip-card">
                <div class="tip-icon">🚨</div>
                <h4>Attack Attempts</h4>
                <p>محاولات اختراق محتملة (نادرة)</p>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="back-section">
        <a href="{{ route('analytics.dashboard', ['locale' => session('locale', 'ar')]) }}" class="btn-back">
            ← العودة لوحة التحكم
        </a>
    </div>
</div>

<style>
.bots-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    direction: rtl;
}

.bots-header {
    text-align: center;
    margin-bottom: 30px;
    padding: 30px;
    background: linear-gradient(135deg, #f87171 0%, #dc2626 100%);
    border-radius: 12px;
    color: white;
}

.bots-header h1 {
    margin: 0;
    font-size: 2.2rem;
    font-weight: 700;
}

.bots-header p {
    margin: 10px 0 0;
    opacity: 0.95;
    font-size: 1rem;
}

.info-alert {
    display: flex;
    gap: 15px;
    background-color: #fef3c7;
    border-left: 4px solid #f59e0b;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.alert-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
}

.alert-content h3 {
    margin: 0 0 8px;
    color: #b45309;
    font-weight: 600;
}

.alert-content p {
    margin: 0;
    color: #92400e;
    font-size: 0.95rem;
    line-height: 1.5;
}

.bots-content {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.bots-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.stat-badge {
    display: flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 15px 25px;
    border-radius: 8px;
    flex: 1;
    min-width: 200px;
}

.badge-label {
    font-size: 0.9rem;
    opacity: 0.9;
    font-weight: 500;
}

.badge-value {
    font-size: 1.8rem;
    font-weight: 800;
}

.table-wrapper {
    overflow-x: auto;
    margin-bottom: 20px;
}

.bots-table {
    width: 100%;
    border-collapse: collapse;
}

.bots-table thead {
    background-color: #f3f4f6;
    border-bottom: 2px solid #e5e7eb;
}

.bots-table th {
    padding: 15px;
    text-align: right;
    font-weight: 600;
    color: #1f2937;
    font-size: 0.9rem;
}

.bots-table td {
    padding: 15px;
    border-bottom: 1px solid #e5e7eb;
}

.bot-row:hover {
    background-color: #f9fafb;
}

.user-agent {
    min-width: 250px;
}

.agent-badge {
    display: inline-block;
    background-color: #fee2e2;
    color: #991b1b;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-family: 'Courier New', monospace;
    word-break: break-all;
}

.ip-address code {
    background-color: #f3f4f6;
    padding: 6px 12px;
    border-radius: 6px;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    color: #1f2937;
}

.attempts {
    text-align: center;
}

.attempt-badge {
    display: inline-block;
    background-color: #fecaca;
    color: #7f1d1d;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
    min-width: 40px;
    text-align: center;
}

.type-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
}

.type-badge.security {
    background-color: #fee2e2;
    color: #991b1b;
}

.type-badge.search {
    background-color: #dbeafe;
    color: #1e40af;
}

.type-badge.crawler {
    background-color: #fed7aa;
    color: #92400e;
}

.status {
    text-align: center;
}

.status-badge {
    display: inline-block;
    background-color: #dcfce7;
    color: #166534;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
}

.pagination-wrapper {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background-color: #f0fdf4;
    border: 2px solid #dcfce7;
    border-radius: 12px;
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 15px;
}

.empty-state p {
    color: #166534;
    font-size: 1.1rem;
    font-weight: 500;
}

.security-tips {
    margin-top: 40px;
    padding: 30px;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    border-radius: 12px;
    border: 2px solid #93c5fd;
}

.security-tips h3 {
    margin: 0 0 25px;
    color: #1e40af;
    font-size: 1.3rem;
    font-weight: 700;
}

.tips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.tip-card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #3b82f6;
    text-align: center;
}

.tip-icon {
    font-size: 2rem;
    margin-bottom: 10px;
}

.tip-card h4 {
    margin: 10px 0 8px;
    color: #1e40af;
    font-size: 1rem;
    font-weight: 600;
}

.tip-card p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
}

.back-section {
    margin-top: 40px;
    text-align: center;
}

.btn-back {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

@media (max-width: 768px) {
    .bots-container {
        padding: 15px;
    }

    .bots-header h1 {
        font-size: 1.6rem;
    }

    .bots-stats {
        flex-direction: column;
    }

    .stat-badge {
        flex: none;
    }

    .bots-table {
        font-size: 0.85rem;
    }

    .bots-table th,
    .bots-table td {
        padding: 10px;
    }

    .tips-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
