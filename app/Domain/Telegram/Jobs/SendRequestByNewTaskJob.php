<?php

declare(strict_types=1);

namespace Domain\Telegram\Jobs;

use App\Domain\User\Queries\GetUsersToInfoOnCreatedTask;
use Domain\Task\Events\TaskCreated;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Log;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;

/**
 * Class SendRequestByNewTaskJob
 * @package Domain\Telegram\Jobs
 */
class SendRequestByNewTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var TaskCreated
     */
    private $event;

    /**
     * SendRequestByNewTaskJob constructor.
     * @param TaskCreated $event
     */
    public function __construct(TaskCreated $event)
    {
        $this->event = $event;
    }

    public function handle(): void
    {
        $usersToInfo = dispatch(new GetUsersToInfoOnCreatedTask());

        dd($usersToInfo);

        try {
            $usersToInfo = dispatch(new GetUsersToInfoOnCreatedTask());

            new Telegram(env('TG_API_TOKEN'), env('TG_BOT_NAME'));

            $description = Str::words(strip_tags($this->event->task->body), 10, '...');

            $data = [];
            $data['parse_mode'] = 'Html';
            $data['text'] = "\x23\xE2\x83\xA3" . " <b>Поставлена задача № {$this->event->task->id}</b>" . "\n";
            $data['text'] .= "<b>Название:</b> {$this->event->task->name}" . "\n";
            $data['text'] .= "<b>Инициатор:</b> {$this->event->task->author->name}" . "\n";
            $data['text'] .= "=============================\n";
            $data['text'] .= $description . "\n";

            foreach ($usersToInfo as $user) {
                $data['chat_id'] = $user->telegram_id;
                Request::sendMessage($data);
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
