<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\PurchaseManualJournalFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseManualJournal extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            'Status' => 'status',
        ];
    }

    protected static function newFactory()
    {
        return PurchaseManualJournalFactory::new();
    }

    public static function getDearRelationships(): array
    {
        return [
            config('dear-database.models.purchase_manual_journal_line') => [
                'model' => config('dear-database.models.purchase_manual_journal_line'),
                'table' => 'purchase_manual_journal_lines',
                'relationship_type' => DearModel::$MANY_TO_MANY,
                'dear_key' => 'Lines',
            ],
        ];
    }

    public function purchaseManualJournalLines(): BelongsToMany
    {
        return $this->belongsToMany(config('dear-database.models.purchase_manual_journal_line'));
    }

    public function purchase(): HasOne
    {
        return $this->hasOne(config('dear-database.models.purchase'));
    }
}
