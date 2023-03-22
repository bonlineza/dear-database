<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\AttachmentLineFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AttachmentLine extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            "ID" => "external_guid",
            "ContentType" => "content_type",
            "FileName" => "file_name",
            "DownloadUrl" => "download_url",
        ];
    }

    protected static function newFactory()
    {
        return AttachmentLineFactory::new();
    }

    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase'));
    }
}
