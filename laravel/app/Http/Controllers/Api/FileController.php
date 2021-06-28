<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FileStoreRequest;
use App\Http\Resources\File as FileResource;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return FileResource::collection(File::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FileStoreRequest  $request
     * @return FileResource
     */
    public function store(FileStoreRequest $request): FileResource
    {
        $file = $request->file('file');
        $path = $file->store('files');
        $model = File::create([
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'path' => $path,
        ]);

        return new FileResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  File  $file
     * @return FileResource
     */
    public function show(File $file): FileResource
    {
        return new FileResource($file);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FileStoreRequest  $request
     * @param  File  $file
     * @return FileResource
     */
    public function update(FileStoreRequest $request, File $file): FileResource
    {
        $filePathToBeDeleted = $file->path;

        $uploadFile = $request->file('file');
        $path = $uploadFile->store('files');
        $file->fill([
            'name' => $uploadFile->getClientOriginalName(),
            'size' => $uploadFile->getSize(),
            'path' => $path,
        ])->save();

        // 更新前のファイルを削除する
        Storage::delete($filePathToBeDeleted);

        return new FileResource($file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  File  $file
     * @return JsonResponse
     */
    public function destroy(File $file): JsonResponse
    {
        $filePathToBeDeleted = $file->path;

        $file->delete();

        // レコードに紐づいていたファイルを削除
        Storage::delete($filePathToBeDeleted);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
