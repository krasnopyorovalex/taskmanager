<?php

declare(strict_types=1);

namespace Domain\Telegram\Jobs;

use App\Events\TaskStatusChanged;
use Domain\Task\Entities\AbstractTaskStatus;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;

/**
 * Class SendRequestByChangeTaskStatusJob
 * @package Domain\Telegram\Jobs
 */
class SendRequestByChangeTaskStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var TaskStatusChanged
     */
    private $event;
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * SendRequestByChangeTaskStatusJob constructor.
     * @param TaskStatusChanged $event
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(TaskStatusChanged $event, AbstractTaskStatus $taskStatus)
    {
        $this->event = $event;
        $this->taskStatus = $taskStatus;
    }

    public function handle(): void
    {
        try {
            new Telegram(env('TG_API_TOKEN'), env('TG_BOT_NAME'));

            $data = [];
            $data['chat_id'] = 187050562;
            $data['parse_mode'] = 'Markdown';
            $data['text'] = "\x23\xE2\x83\xA3" . " Задача № {$this->event->task->id}*" . "\n";
            $data['text'] .= "*Название:* {$this->event->task->name}" . "\n";
            $data['text'] .= "*Инициатор:* {$this->event->task->author->name}" . "\n";
            $data['text'] .= "*Изменён статус на:* {$this->taskStatus->getLabelStatus($this->event->task)}" . "\n";

            Request::sendMessage($data);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
