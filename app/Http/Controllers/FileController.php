<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ThumbCreatorService;
use Domain\File\Commands\DeleteFileCommand;
use Domain\File\Commands\UploadFileCommand;
use Domain\File\Queries\GetFileByIdQuery;
use Domain\File\Queries\GetFileByTaskUuidAndFileIdQuery;
use Domain\File\Requests\UploadFilesRequest;
use Domain\Task\Queries\GetTaskByUuidQuery;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class FileController
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    /**
     * @var ThumbCreatorService
     */
    private $thumbCreator;

    public function __construct(ThumbCreatorService $thumbCreator)
    {
        $this->thumbCreator = $thumbCreator;
    }

    /**
     * @param string $uuid
     * @param int $id
     * @return StreamedResponse
     */
    public function download(string $uuid, int $id): StreamedResponse
    {
        $file = $this->dispatch(new GetFileByTaskUuidAndFileIdQuery($uuid, $id));

        return Storage::download($file->path, $file->name);
    }

    /**
     * @param UploadFilesRequest $request
     * @param string $uuid
     * @return RedirectResponse|Redirector
     */
    public function upload(UploadFilesRequest $request, string $uuid)
    {
        try {
            $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

            $this->dispatch(new UploadFileCommand($request->file('files'), $task, $this->thumbCreator));
        } catch (Exception $exception) {
            return redirect(route('tasks.index'))->with('message', $exception->getMessage());
        }

        return redirect(route('tasks.show', $task));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $file = $this->dispatch(new GetFileByIdQuery($id));

            $this->authorize('delete', $file);

            $this->dispatch(new DeleteFileCommand($this->thumbCreator->getImageNameChanger(), $file));
        } catch (Exception $exception) {
            return response()->json([
                'status' => $exception->getMessage()
            ]);
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
