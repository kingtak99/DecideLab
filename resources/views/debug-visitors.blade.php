@php
$visitors = \App\Models\Visitor::latest()->limit(10)->get();
dd($visitors->map(fn($v) => [
    'ip' => $v->ip_address,
    'country' => $v->country,
    'code' => $v->country_code,
    'visited_at' => $v->visited_at
])->toArray());
@endphp
