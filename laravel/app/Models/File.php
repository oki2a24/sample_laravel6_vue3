<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'size',
        'path',
    ];

    /**
     * ネイティブなタイプへキャストする属性
     *
     * @var array
     */
    protected $casts = [
        'size' => 'integer',
    ];

    /**
     * URL を取得します。
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }
}
