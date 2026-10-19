<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // These are the placeholder values currently hard-coded in the topbar
        // and footer. Replace them in the admin panel before launch.
        $rows = [
            ['contact', 'phone',        'Phone',            'tel',      '+880 1700-000000'],
            ['contact', 'phone_raw',    'Phone (dial)',     'tel',      '+8801700000000'],
            ['contact', 'whatsapp',     'WhatsApp number',  'tel',      '8801700000000'],
            ['contact', 'email',        'Email',            'email',    'info@mlg.com.bd'],
            ['contact', 'address_line1','Address line 1',   'text',     'House 00, Road 00, Dhanmondi'],
            ['contact', 'address_line2','Address line 2',   'text',     'Dhaka 1205, Bangladesh'],
            ['contact', 'office_hours', 'Office hours',     'text',     'Sat–Thu · 10:00 AM – 8:00 PM'],
            ['contact', 'map_embed',    'Google Maps embed','textarea', ''],
            ['social',  'facebook',     'Facebook',         'url',      '#'],
            ['social',  'youtube',      'YouTube',          'url',      '#'],
            ['social',  'instagram',    'Instagram',        'url',      '#'],
            ['social',  'linkedin',     'LinkedIn',         'url',      '#'],
            ['general', 'site_name',    'Site name',        'text',     'Multi Languages Gateway'],
            ['general', 'google_review_url', 'Google review link', 'url',  ''],
            ['general', 'google_rating','Google rating',    'text',     '4.9'],
            ['general', 'google_reviews','Google review count','text',  '148'],
            ['general', 'students_taught','Students taught','text',     '1200'],
            ['general', 'visa_success', 'Visa success rate (%)','text', '96'],
        ];

        foreach ($rows as [$group, $key, $label, $type, $value]) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['group' => $group, 'label' => $label, 'type' => $type, 'value' => $value],
            );
        }
    }
}
