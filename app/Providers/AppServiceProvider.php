<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $language = Setting::getValue('app_language','en');
        App::setLocale($language);

        $mailer = Setting::getValue('mail_mailer');
        $host = Setting::getValue('mail_host');
        $port = Setting::getValue('mail_port');
        $encryption = Setting::getValue('mail_encryption');
        $username = Setting::getValue('mail_username');
        $password = Setting::getValue('mail_password');
        $fromAddress = Setting::getValue('mail_from_address');
        $fromName = Setting::getValue('mail_from_name');

        if ($mailer) {
            Config::set('mail.default',$mailer);
        }

        $mailers = Config::get('mail.mailers');
        if (isset($mailers['smtp'])) {
            if ($host) {
                $mailers['smtp']['host'] = $host;
            }
            if ($port) {
                $mailers['smtp']['port'] = $port;
            }
            if ($encryption) {
                $mailers['smtp']['encryption'] = $encryption;
            }
            if ($username) {
                $mailers['smtp']['username'] = $username;
            }
            if ($password) {
                $mailers['smtp']['password'] = $password;
            }
            Config::set('mail.mailers',$mailers);
        }

        if ($fromAddress || $fromName) {
            $from = Config::get('mail.from');
            if ($fromAddress) {
                $from['address'] = $fromAddress;
            }
            if ($fromName) {
                $from['name'] = $fromName;
            }
            Config::set('mail.from',$from);
        }
    }
}
