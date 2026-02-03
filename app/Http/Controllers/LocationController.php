<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    public function detectLocation(Request $request)
    {
        // Get user's IP address
        $ip = $request->ip();

        // For localhost/development, default to Jordan
        if ($ip === '127.0.0.1' || $ip === '::1') {
            $country = Country::where('code', 'JOR')->first();
        } else {
            // In production, you would use a geolocation service
            // For now, we'll use a simple IP-based detection
            $country = $this->getCountryFromIP($ip);
        }

        return response()->json([
            'country_id' => $country ? $country->id : null,
            'country' => $country,
            'flag_url' => $country ? "https://flagcdn.com/{$country->flag_code}.svg" : null
        ]);
    }

    public function changeLocation(Request $request, $countryId)
    {
        $country = Country::findOrFail($countryId);

        // Store in session for guests
        Session::put('user_country', $country->id);

        // Store in database for authenticated users
        if (Auth::check()) {
            Auth::user()->update(['country_id' => $country->id]);
        }

        return response()->json([
            'success' => true,
            'country' => $country,
            'flag_url' => "https://flagcdn.com/{$country->flag_code}.svg"
        ]);
    }

    public function getCountries(Request $request)
{
    $search = $request->get('search', '');
    $locale = app()->getLocale(); // 'ar' أو 'en'
    $nameColumn = $locale === 'ar' ? 'name_ar' : 'name_en';

    $query = Country::where('is_active', true);

    if ($search) {
        $query->where($nameColumn, 'LIKE', "%{$search}%");
    }

    // إحضار النتائج مع ترتيب حسب الاسم
    $countries = $query->orderBy($nameColumn)->get();

    // استخدم collect + unique() لمنع التكرارات حسب الاسم المحلي
    $countries = $countries->map(function ($country) use ($locale, $nameColumn) {
        return [
            'id' => $country->id,
            'name' => $locale === 'ar' ? $country->name_ar : $country->name_en,
            'flag_url' => "https://flagcdn.com/{$country->flag_code}.svg",
            'code' => $country->code
        ];
    })->unique('name') // إزالة التكرارات حسب الاسم
      ->values(); // إعادة ترتيب المفاتيح لتكون متسلسلة

    return response()->json($countries);
}


    public function getCurrentLocation()
    {
        $country = null;

        if (Auth::check() && Auth::user()->country) {
            $country = Auth::user()->country;
        } elseif (Session::has('user_country')) {
            $country = Country::find(Session::get('user_country'));
        }

        // If no country set, try to detect by IP and store it in session for subsequent visits
        if (!$country) {
            $detected = $this->getCountryFromIP(request()->ip());
            if ($detected) {
                $country = $detected;
                // Save detected country in session so it persists across page navigations
                Session::put('user_country', $country->id);
            } else {
                // Fallback to Jordan if detection fails
                $country = Country::where('code', 'JOR')->first();
            }
        }

        return response()->json([
            'country' => $country,
            'flag_url' => $country ? "https://flagcdn.com/{$country->flag_code}.svg" : null
        ]);
    }

    private function getCountryFromIP($ip)
    {
        // This is a simplified version. In production, you'd use a service like:
        // - ipapi.co
        // - ipstack.com
        // - maxmind.com

        // For now, return Jordan as default
        return Country::where('code', 'JOR')->first();
    }
}