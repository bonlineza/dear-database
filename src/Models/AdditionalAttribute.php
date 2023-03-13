<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\AdditionalAttributeFactory;
use Bonlineza\DearDatabase\Traits\DearModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalAttribute extends Model
{
    use HasFactory, DearModel, HasUuids;

    protected $guarded = [];

    public static function getDearMapping(): array
    {
        return [
            "AdditionalAttribute1" => "additional_attribute_1",
            "AdditionalAttribute2" => "additional_attribute_2",
            "AdditionalAttribute3" => "additional_attribute_3",
            "AdditionalAttribute4" => "additional_attribute_4",
            "AdditionalAttribute5" => "additional_attribute_5",
            "AdditionalAttribute6" => "additional_attribute_6",
            "AdditionalAttribute7" => "additional_attribute_7",
            "AdditionalAttribute8" => "additional_attribute_8",
            "AdditionalAttribute9" => "additional_attribute_9",
            "AdditionalAttribute10" => "additional_attribute_10",
        ];
    }

    protected static function newFactory()
    {
        return AdditionalAttributeFactory::new();
    }

    public function purchase()
    {
        return $this->hasOne(config('dear-database.models.purchase'));
    }
}
