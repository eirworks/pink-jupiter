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
            'settings' => $this->compileSettings($request->input('id', 'site')),
            'settingGroups' => $this->settingGroups(),
            'id' => $request->input('id', 'site'),
        ]);
    }

    public function update(Request $request)
    {
        $defaults = $this->compileSettings($request->input('id'));

        $items = [];

        foreach($defaults as $default)
        {
            $items[$default['key']] = $request->input('settings.'.$default['key']);
        }

        setting($items)->save();

        return redirect()->route('admin.settings.edit', ['id' => $request->input('id')])
            ->with('success', "Pengaturan telah disimpan");
    }

    private function compileSettings($id = "site")
    {
        $settings = [];
        $defaultSettings = [];

        $settingGroups = static::defaultSettings();

        foreach($settingGroups as $settingGroup)
        {
            if ($settingGroup['id'] == $id)
            {
                $defaultSettings =  $settingGroup['settings'];
                break;
            }
        }

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

    private function settingGroups()
    {
        $settingGroups = [];

        $defaults = self::defaultSettings();

        foreach($defaults as $default)
        {
            $settingGroups[$default['id']] = $default['name'];
        }

        return $settingGroups;
    }

    public static function defaultSettings()
    {
        return [
            [
                'name' => "Situs",
                'id' => 'site',
                'settings' => [
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
                ],
            ],

//            [
//                'name' => "Halaman Depan",
//                'id' => 'frontend',
//                'settings' => [
//                    [
//                        'name' => 'Aktifkan Testimoni',
//                        'key' => 'fp_enable_testimony',
//                        'type' => 'boolean',
//                        'default' => true,
//                    ],
//                    [
//                        'name' => 'Judul testimoni',
//                        'key' => 'fp_testimony_title',
//                        'type' => 'string',
//                        'default' => "Testimoni Customer Kami",
//                    ],
//                    [
//                        'name' => 'Testimoni 1',
//                        'key' => 'fp_testimony_1',
//                        'type' => 'text',
//                        'default' => "",
//                    ],
//                    [
//                        'name' => 'Nama Testimoni 1',
//                        'key' => 'fp_testimony_1_name',
//                        'type' => 'string',
//                        'default' => "",
//                    ],
//                    [
//                        'name' => 'Testimoni 2',
//                        'key' => 'fp_testimony_2',
//                        'type' => 'text',
//                        'default' => "",
//                    ],
//                    [
//                        'name' => 'Nama Testimoni 2',
//                        'key' => 'fp_testimony_2_name',
//                        'type' => 'string',
//                        'default' => "",
//                    ],
//                    [
//                        'name' => 'Testimoni 3',
//                        'key' => 'fp_testimony_3',
//                        'type' => 'text',
//                        'default' => "",
//                    ],
//                    [
//                        'name' => 'Nama Testimoni 3',
//                        'key' => 'fp_testimony_3_name',
//                        'type' => 'string',
//                        'default' => "",
//                    ],
//                    [
//                        'name' => 'Judul untuk Ajakan Mitra',
//                        'key' => 'fp_partner_invitation_title',
//                        'type' => 'string',
//                        'default' => "Bergabung dengan %s",
//                    ],
//                    [
//                        'name' => 'Sub Judul untuk Ajakan Mitra',
//                        'key' => 'fp_partner_invitation_subtitle',
//                        'type' => 'string',
//                        'default' => "Segera bergabung dengan kami",
//                    ],
//                    [
//                        'name' => 'Teks Tombol Ajakan Mitra',
//                        'key' => 'fp_partner_invitation_button',
//                        'type' => 'string',
//                        'default' => "Gabung Sekarang",
//                    ],
//                ],
//            ],
        ];
    }
}
