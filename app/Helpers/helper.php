<?php

use App\Models\Property;
use App\Settings\LocalizationSetting;
use App\Settings\MailSetting;
use App\Settings\SiteSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Qirolab\Theme\Theme;
use Illuminate\Support\Str;

if (!function_exists('installed')) {
    function installed()
    {
        return file_exists(storage_path('installed'));
    }
}

if (!function_exists('themes')) {
    function themes()
    {
        $directoryPath = base_path('themes');
        $themes = File::isDirectory($directoryPath) ? collect(File::directories($directoryPath))->mapWithKeys(function ($dir) {
            $path = str_replace(base_path('themes') . '/', '', $dir);
            return [strtolower($path) => $path];
        }) : [];

        return $themes;
    }
}

if (!function_exists('currency_price')) {
    function currency_price($value, $currency = 'USD', $locale = null)
    {
        return Number::currency($value, $currency, $locale);
    }
}

if (!function_exists('facility_value')) {
    function facility_value($property_id, $facility_id, $value = 'value')
    {
        if ($property_id) {
            $property = Property::findOrFail($property_id);
        } else {
            $property = new Property();
        }

        $facility = $property->facilities()->where('facility_id', $facility_id)->first();

        if ($facility) {
            return $facility->pivot->$value;
        }

        return '';
    }
}

if (!function_exists('outdoor_value')) {
    function outdoor_value($property_id, $outdoor_id, $value = 'distance')
    {
        if ($property_id) {
            $property = Property::findOrFail($property_id);
        } else {
            $property = new Property();
        }

        $outdoor = $property->outdoors()->where('outdoor_id', $outdoor_id)->first();

        if ($outdoor) {
            return $outdoor->pivot->$value;
        }

        return '';
    }
}

if (!function_exists('str_limit')) {
    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
}

if (!function_exists('is_new')) {
    function is_new($date)
    {
        return $date->diffInDays() < 7 ? true : false;
    }
}

if (!function_exists('time_read')) {
    function time_read($subject, $wordPerMinute = 200)
    {
        return Str::readingMinutes($subject, $wordPerMinute);
    }
}


if (!function_exists('site_date')) {
    function site_date($date)
    {
        $localization = new LocalizationSetting();

        if ($localization->localization_date_format == 'human') {
            return $date->diffForHumans();
        }

        $parsed = Carbon::parse($date);
        return $parsed->format($localization->localization_date_format . ' ' . $localization->localization_time_format);
    }
}

if (!function_exists('site_logo')) {
    function site_logo()
    {
        return setting('site_logo_light') ? Storage::url(setting('site_logo_light')) : asset_theme('img/logo-dark.svg');
    }
}


if (!function_exists('theme_path')) {
    function theme_path($path = 'views')
    {
        return Theme::path($path);
    }
}

if (!function_exists('asset_theme')) {
    function asset_theme($path = 'views')
    {
        return asset('themes/' . theme_active() . '/' . $path);
    }
}

if (!function_exists('theme_active')) {
    function theme_active()
    {
        return Theme::active();
    }
}

if (!function_exists('set_active')) {
    function set_active($routeName, $active = 'active', $end = '')
    {
        return request()->routeIs($routeName) ? $active : $end;
    }
}


if (!function_exists('site_currencies')) {
    function site_currencies()
    {
        $currencies = collect(currency()->getCurrencies())->mapWithKeys(function ($currency) {
            return [$currency['code'] => $currency['code'] . ' - ' . $currency['name']];
        });

        return $currencies;
    }
}


if (!function_exists('setting')) {
    function setting($value = null)
    {
        if (!installed()) {
            return [];
        }

        $settings = new SiteSetting();
        $localization = new LocalizationSetting();
        $mail = new MailSetting();

        $merged = array_merge(
            $settings->toArray(),
            $localization->toArray(),
            $mail->toArray()
        );

        if ($value) {
            return $merged[$value];
        }

        return $merged;
    }
}
