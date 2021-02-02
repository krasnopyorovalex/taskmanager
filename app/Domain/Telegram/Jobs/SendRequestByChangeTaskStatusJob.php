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
            $data['parse_mode'] = 'Html';
            $data['text'] = "\x23\xE2\x83\xA3" . " <b>Задача № {$this->event->task->id}</b>" . "\n";
            $data['text'] .= "<b>Название</b> {$this->event->task->name}" . "\n";
            $data['text'] .= "<b>Инициатор:</b> {$this->event->task->author->name}" . "\n";
            $data['text'] .= "<b>Изменён статус на:</b> {$this->taskStatus->getLabelStatus($this->event->task)}" . "\n";

            if ($this->event->task->author->telegram_id && $this->event->task->author_id !== auth()->user()->id) {
                $data['chat_id'] = $this->event->task->author->telegram_id;
                Request::sendMessage($data);
            }

            if ($this->event->task->performer->telegram_id && $this->event->task->performer_id !== auth()->user()->id) {
                $data['chat_id'] = $this->event->task->performer->telegram_id;
                Request::sendMessage($data);
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
