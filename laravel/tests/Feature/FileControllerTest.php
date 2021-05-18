<?php

namespace Tests\Feature;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

        Storage::fake();
    }

    /**
     * テスト用フェイクファイルと紐づく DB レコードを生成します。
     *
     * @param string $fileName
     */
    private function createFile(string $fileName): File
    {
        $file = UploadedFile::fake()->image($fileName)->size(1000);
        $fileSize = $file->getSize();
        $path = $file->store('files');
        // テスト後に DB レコードに紐づくファイルは消えてしまうこと、DB カラムはすべてファイル由来であること、を考慮し、ファクトリは使用しなかった。
        $record = File::create([
            'name' => $fileName,
            'size' => $fileSize,
            'path'=> $path,
        ]);

        return $record;
    }

    /**
     * @test
     * @return void
     */
    public function 全てのファイルを取得できること(): void
    {
        $fileName1 = 'file1.jpg';
        $file1 = $this->createFile($fileName1);
        $fileName2 = 'file2.jpg';
        $file2 = $this->createFile($fileName2);

        $response = $this->get("/api/files");

        // 確認。レスポンス
        $response
            ->assertStatus(200)
            ->assertExactJson([
                [
                    'id' => $file1->id,
                    'name' => $fileName1,
                    'size' => $file1->size,
                    'url' => $file1->url,
                ],
                [
                    'id' => $file2->id,
                    'name' => $fileName2,
                    'size' => $file2->size,
                    'url' => $file2->url,
                ],
            ]);
    }

    /**
     * @test
     * @return void
     */
    public function ファイルを登録できること(): void
    {
        $fileName = 'file.jpg';
        $file = UploadedFile::fake()->image($fileName)->size(1000);

        $response = $this->post('/api/files', [
            'file' => $file,
        ]);

        // 確認。レスポンス
        $record = File::first();
        $response
            ->assertStatus(201)
            ->assertJson([
                'name' => $fileName,
                'size' => $file->getSize(),
                'url' => $record->url,
            ]);

        // 確認。データベース
        $this->assertDatabaseHas('files', [
            'name' => $fileName,
            'size' => $file->getSize(),
        ]);

        // 確認。ファイル保存
        Storage::assertExists('files/' . $file->hashName());
    }

    /**
     * @test
     * @return void
     */
    public function 指定ファイルを取得できること(): void
    {
        $fileName = 'file.jpg';
        $file = $this->createFile($fileName);
        $fileId = $file->id;

        $response = $this->get("/api/files/{$fileId}");

        // 確認。レスポンス
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'id' => $fileId,
                'name' => $fileName,
                'size' => $file->size,
                'url' => $file->url,
            ]);
    }

    /**
     * @test
     * @return void
     */
    public function 指定ファイルを更新できること(): void
    {
        // 更新される対象
        $targetFileName = 'targetFile.jpg';
        $targetFile = $this->createFile($targetFileName);
        $targetFileId = $targetFile->id;

        // アップロードするファイル
        $uploadFileName = 'uploadFile.jpg';
        $uploadFile = UploadedFile::fake()->image($uploadFileName)->size(2000);

        $response = $this->patch("/api/files/{$targetFileId}", [
            'file' => $uploadFile,
        ]);

        // 確認。レスポンス
        $uploadFileRecord = $targetFile->fresh();
        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $targetFileId,
                'name' => $uploadFileName,
                'size' => $uploadFileRecord->size,
                'url' => $uploadFileRecord->url,
            ]);

        // 確認。データベース
        $this->assertDatabaseHas('files', [
            'name' => $uploadFileName,
            'size' => $uploadFile->getSize(),
        ]);

        // 確認。ファイル保存
        Storage::assertExists('files/' . $uploadFile->hashName());
        Storage::assertMissing($targetFile->path);
    }

    /**
     * @test
     * @return void
     */
    public function 指定ファイルを削除できること(): void
    {
        // 削除される対象
        $targetFileName = 'targetFile.jpg';
        $targetFile = $this->createFile($targetFileName);
        $targetFileId = $targetFile->id;

        $response = $this->delete("/api/files/{$targetFileId}");

        // 確認。レスポンス
        $response
            ->assertStatus(204);

        // 確認。データベース
        $this->assertDatabaseMissing('files', [
            'name' => $targetFileName,
            'size' => $targetFile->size,
        ]);

        // 確認。ファイル保存
        Storage::assertMissing($targetFile->path);
    }
}
