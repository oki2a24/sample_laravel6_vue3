<?php

namespace Tests\Feature;

use App\Http\Requests\Api\FileStoreRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class FileStoreRequestTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function 必須エラーとなること()
    {
        // 準備
        $data = [
            'file' => null,
        ];

        // 実行
        $validator = Validator::make($data, (new FileStoreRequest())->rules());

        // 確認。成否
        $this->assertTrue($validator->fails());
        // 確認。失敗内容
        $this->assertEquals([
            'file' => ['Required' => [],],
        ], $validator->failed());
    }

    /**
     * @test
     * @return void
     */
    public function ファイルが画像ではない時にエラーとなること()
    {
        // 準備
        Storage::fake();
        $file = UploadedFile::fake()->create('document.pdf');
        $data = [
            'file' => $file,
        ];

        // 実行
        $validator = Validator::make($data, (new FileStoreRequest())->rules());

        // 確認。成否
        $this->assertTrue($validator->fails());
        // 確認。失敗内容
        $this->assertEquals([
            'file' => ['Image' => [],],
        ], $validator->failed());
    }

    /**
     * @test
     * @return void
     */
    public function 最大サイズエラーとなること()
    {
        // 準備
        Storage::fake();
        $file = UploadedFile::fake()->image('document.jpg')->size(2001);
        $data = [
            'file' => $file,
        ];

        // 実行
        $validator = Validator::make($data, (new FileStoreRequest())->rules());

        // 確認。成否
        $this->assertTrue($validator->fails());
        // 確認。失敗内容
        $this->assertEquals([
            'file' => ['Max' => [2000],],
        ], $validator->failed());
    }
}
