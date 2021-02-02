<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class TestTelegramCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:tg-test';

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
        try {
            new Telegram(env('TG_API_TOKEN'), env('TG_BOT_NAME'));

            $data = [];
            $data['chat_id'] = 187050562;
            $data['parse_mode'] = 'Html';
            $data['text'] = "\x23\xE2\x83\xA3" . "<b>Задача № test task</b>" . "\n";

            Log::info(Request::sendMessage($data));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return 0;
    }
}
