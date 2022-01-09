<?php

namespace App\Console\Commands;

use App\Constants\AppConstants;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Lang;

class MakeLangJsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:lang-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $langFolder = public_path('frontend/js/locale');
        if (!file_exists($langFolder)) {
            mkdir($langFolder, 0755, true);
        }
        foreach (AppConstants::PUBLIC_LANGUAGES as $lang) {
            $langs = Lang::get('public', [], $lang);
            $jsonFile = $langFolder . '/' . $lang . '.js';
            file_put_contents($jsonFile, 'window.i18n = ' . json_encode($langs));
            $this->info('Create file ' . $jsonFile . ' success');
        }
    }
}
