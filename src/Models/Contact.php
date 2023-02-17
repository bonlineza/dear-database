<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\ContactFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $external_guid
 * @property string $email
 * @property boolean $default
 * @property int $user_id
 */
class Contact extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'ID' => 'external_guid',
            'Name' => 'name',
            'Phone' => 'phone',
            'Fax' => 'fax',
            'Email' => 'email',
            'Website' => 'website',
            'Comment' => 'comment',
            'Default' => 'default',
            'IncludeInEmail' => 'include_in_email',
        ];
    }

    protected static function newFactory()
    {
        return ContactFactory::new();
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.supplier'));
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.customer'));
    }
}
