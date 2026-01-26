<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLanguage(Request $request, $locale)
    {
        // Validate the locale
        if (!in_array($locale, ['en', 'ar'])) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Invalid language'], 400);
            }
            abort(400, 'Invalid language');
        }

        // Store the locale in session
        Session::put('locale', $locale);

        // Set the application locale
        App::setLocale($locale);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'locale' => $locale]);
        }

        // Get the current path from referer
        $referer = $request->headers->get('referer');
        $currentPath = '/';

        if ($referer) {
            $parsedUrl = parse_url($referer);
            if (isset($parsedUrl['path'])) {
                $currentPath = $parsedUrl['path'];
                // Remove existing locale prefix if present
                $currentPath = preg_replace('/^\/(en|ar)/', '', $currentPath);
                // Ensure it starts with /
                $currentPath = '/' . ltrim($currentPath, '/');
            }
        }

        // Construct new URL with locale prefix
        $newUrl = '/' . $locale . $currentPath;

        // Handle query parameters from referer
        if ($referer && isset($parsedUrl['query'])) {
            $newUrl .= '?' . $parsedUrl['query'];
        }

        return redirect($newUrl);
    }
}