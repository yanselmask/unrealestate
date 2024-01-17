<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.site_logo_light', '');
        $this->migrator->add('site.site_logo_dark', '');
        $this->migrator->add('site.site_name', config('app.name', 'CMent'));
        $this->migrator->add('site.site_url', config('app.url', ''));
        $this->migrator->add('site.site_description', 'Your Description');
        $this->migrator->add('site.site_admin_email', 'admin@cment.com');
        $this->migrator->add('site.site_admin_phone', '(687) 98 55 14');
        $this->migrator->add('site.site_privacy_url', '/pages/privacy');
        $this->migrator->add('site.site_terms_url', '/pages/terms');
        $this->migrator->add('site.site_cookies_url', '/pages/cookies');
        $this->migrator->add('site.site_theme_active', 'default');
        $this->migrator->add('site.site_front_css', '');
        $this->migrator->add('site.site_front_js', '');
        $this->migrator->add('site.site_post_editor', 'markdown');
        $this->migrator->add('site.site_page_editor', 'markdown');
        $this->migrator->add('site.site_footer_heading_download', 'Download Our App');
        $this->migrator->add('site.site_footer_text_download', 'Find everything you need for buying, selling & renting property in our new Finder App!');
        $this->migrator->add('site.site_footer_image_download', 'https://finder.createx.studio/img/real-estate/illustrations/mobile.svg');
        $this->migrator->add('site.site_footer_link_android', '#');
        $this->migrator->add('site.site_footer_link_ios', '#');
        $this->migrator->add('site.site_footer_copyright', '<div class="text-center fs-sm pt-4 mt-3 pb-2">© All rights reserved. Made by <a href="https://yanselmask.com" class="d-inline-block nav-link p-0" target="_blank" rel="noopener">Yanselmask,Inc.</a></div>');
        $this->migrator->add('site.site_maintenance_status', false);
        $this->migrator->add('site.site_maintenance_message', 'Maintenance Message');
        $this->migrator->add('site.site_homepage_page', 1);
        $this->migrator->add('site.site_social_media_links', json_decode('{"twitter": "#", "facebook": "#", "telegram": "#", "whatsapp": "#"}'));
    }
};
