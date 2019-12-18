<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    const SETTING_CONTACT_FEE = "contact_fee";
    const SETTING_MIN_DEPOSIT = "minimum_deposit";
    const SETTING_LISTING_SEO = "seo_listing";
    const SETTING_PROFILE_SEO = "seo_profile";
    const SETTING_DEPOSIT_ACCOUNT = "deposit_account";
    const SETTING_DEPOSIT_ACCOUNT_NAME = "deposit_account_name";
    const SETTING_DEPOSIT_ACCOUNT_BANK = "deposit_account_bank";

    public function index(Request $request)
    {
        return view('admin.settings.index', [
            'settings' => $this->compileSettings(),
        ]);
    }

    public function update(Request $request)
    {
        $defaults = self::defaultSettings();

        $items = [];

        foreach($defaults as $default)
        {
            $items[$default['key']] = $request->input('settings.'.$default['key']);
        }

        setting($items)->save();

        return redirect()->route('admin.settings.edit')
            ->with('success', "Pengaturan telah disimpan");
    }

    private function compileSettings()
    {
        $settings = [];

        $defaultSettings = static::defaultSettings();

        foreach($defaultSettings as $defaultSetting)
        {
            $settings[] = [
                'name' => $defaultSetting['name'],
                'key' => $defaultSetting['key'],
                'type' => $defaultSetting['type'],
                'value' => setting($defaultSetting['key'], $defaultSetting['default']),
            ];
        }

        return $settings;
    }

    public static function defaultSettings()
    {
        return [
            [
                'name' => 'Fee per kontak',
                'key' => self::SETTING_CONTACT_FEE,
                'type' => 'number',
                'default' => 0,
            ],
            [
                'name' => 'Minimum Top Up',
                'key' => self::SETTING_MIN_DEPOSIT,
                'type' => 'number',
                'default' => 0,
            ],
            [
                'name' => 'Tag SEO untuk halaman listing',
                'key' => self::SETTING_LISTING_SEO,
                'type' => 'text',
                'default' => "",
            ],
            [
                'name' => 'Tag SEO untuk halaman profil',
                'key' => self::SETTING_PROFILE_SEO,
                'type' => 'text',
                'default' => "",
            ],
            [
                'name' => 'Rekening Top Up',
                'key' => self::SETTING_DEPOSIT_ACCOUNT,
                'type' => 'string',
                'default' => "",
            ],
            [
                'name' => 'Nama Pemilik Rekening Top Up',
                'key' => self::SETTING_DEPOSIT_ACCOUNT_NAME,
                'type' => 'string',
                'default' => "",
            ],
            [
                'name' => 'Nama Bank Rekening Top Up',
                'key' => self::SETTING_DEPOSIT_ACCOUNT_BANK,
                'type' => 'string',
                'default' => "",
            ],
            [
                'name' => 'Judul Homepage',
                'key' => 'homepage_title',
                'type' => 'string',
                'default' => env('APP_NAME'),
            ],
            [
                'name' => 'Sub-Judul Homepage',
                'key' => 'homepage_subtitle',
                'type' => 'string',
                'default' => "",
            ],
            [
                'name' => 'Sub-Judul Homepage',
                'key' => 'homepage_subtitle',
                'type' => 'string',
                'default' => "",
            ],
        ];
    }
}
