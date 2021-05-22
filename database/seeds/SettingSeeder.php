<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    /**
     * @var array
     */
    protected $settings = [
        [
            'key'   =>  'app_name',
            'value' =>  'Super Freighters',
        ],
        [
            'key'   =>  'app_title',
            'value' =>  'Super Freighters',
        ],
        [
            'key'   =>  'default_email_address',
            'value' =>  'contact@superfreighters.com',
        ],
        [
            'key'   =>  'default_address',
            'value' =>  'Lagos State, Nigeria',
        ],
        [
            'key'   =>  'default_phone_number',
            'value' =>  '+234 8078 780 858',
        ],
        [
            'key'   =>  'currency_code',
            'value' =>  'NGN',
        ],
        [
            'key' =>  'currency_symbol',
            'value' =>  '₦',
        ],
        [
            'key' =>  'customs_tax',
            'value' =>  '10',
        ],
        [
            'key' =>  'paystack_env',
            'value' =>  'test',
        ],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach ($this->settings as $index => $setting) {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->settings). ' records');
    }
}
