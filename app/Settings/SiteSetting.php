<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSetting extends Settings
{

    public ?String $site_logo_light;
    public ?String $site_logo_dark;
    public String $site_name;
    public String $site_url;
    public String $site_description;
    public ?String $site_admin_email;
    public ?String $site_admin_phone;
    public String $site_privacy_url;
    public String $site_terms_url;
    public String $site_cookies_url;
    public ?String $site_theme_active;
    public ?String $site_front_css;
    public ?String $site_front_js;
    public String $site_post_editor;
    public String $site_page_editor;
    public bool $site_maintenance_status;
    public String $site_maintenance_message;
    public ?String $site_footer_heading_download;
    public ?String $site_footer_text_download;
    public ?String $site_footer_image_download;
    public ?String $site_footer_link_android;
    public ?String $site_footer_link_ios;
    public ?String $site_footer_copyright;
    public array $site_social_media_links;
    public ?String $site_homepage_page;

    public static function group(): string
    {
        return 'site';
    }
}
