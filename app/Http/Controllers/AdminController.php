<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Check if user is admin
        $adminEmails = ['hasantak99@gmail.com', 'admin99@decidelab.com'];
        if (!in_array(auth()->user()->email, $adminEmails)) {
            abort(403, 'Unauthorized');
        }

        // Get visitor stats
        $totalVisitors = Visitor::distinct('ip_address')->count('ip_address');
        $todayVisitors = Visitor::whereDate('visited_at', today())->count();
        $monthVisitors = Visitor::whereYear('visited_at', now()->year)
            ->whereMonth('visited_at', now()->month)
            ->count();

        // Daily visitors for last 30 days
        $dailyVisitors = Visitor::select(
            DB::raw('DATE(visited_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('visited_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->pluck('count', 'date')
        ->toArray();

        // Monthly visitors for last 12 months
        $monthlyVisitors = Visitor::select(
            DB::raw('YEAR(visited_at) as year'),
            DB::raw('MONTH(visited_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where('visited_at', '>=', now()->subMonths(12))
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get()
        ->mapWithKeys(function ($item) {
            return [sprintf('%04d-%02d', $item->year, $item->month) => $item->count];
        })
        ->toArray();

        return view('admin.dashboard', compact(
            'totalVisitors',
            'todayVisitors',
            'monthVisitors',
            'dailyVisitors',
            'monthlyVisitors'
        ));
    }
}
