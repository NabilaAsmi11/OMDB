<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Switch application language
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch($locale)
    {
        $availableLocales = ['en', 'id'];

        if (in_array($locale, $availableLocales)) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }

        return redirect()->back();
    }

    /**
     * Get current language
     *
     * @return string
     */
    public function getCurrent()
    {
        return session('locale', config('app.locale'));
    }
}
