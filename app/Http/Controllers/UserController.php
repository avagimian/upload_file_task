<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Services\User\Actions\BroadcastUserAction;
use App\Services\User\Actions\UploadFileUserAction;
use App\Services\User\Dto\UploadFileUserDto;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @throws Exception
     */
    public function uploadFile(
        UploadFileRequest $request,
        UploadFileUserAction $uploadFileUserAction
    ): JsonResponse {
        $dto = UploadFileUserDto::fromRequest($request);

        $uploadFileUserAction->run($dto);

        return response()->json(['success' => true]);
    }

    public function startBroadcast(
        BroadcastUserAction $broadcastUserAction
    ): JsonResponse {
        $broadcastUserAction->run();

        return response()->json(['success' => true]);
    }
}

