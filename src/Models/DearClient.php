<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Models\Contact;
use Bonlineza\DearDatabase\Models\Customer;
use Bonlineza\DearDatabase\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

abstract class DearClient extends Model
{
    abstract public function contacts(): BelongsToMany;

    public static function syncClientToUser(Supplier|Customer $client): Supplier|Customer
    {
        /** @var ?Contact $default_contact */
        $default_contact = $client->contacts()->where('default', true)->whereNotNull('email')->first();

        if (!$default_contact) {
            throw new \Exception(
                sprintf("%s with guid %s has no contact which is marked as default and has email set", self::class, $client->external_guid)
            );
        }

        $user_model = app()->make(config('dear-database.models.user'));
        $user = $default_contact->user ??
            $user_model::lowercaseEmail($default_contact->email)->first();

        if (!$user) {
            throw new \Exception(
                sprintf("User with email %s not found", $default_contact->email)
            );
        }

        $default_contact->user_id = $user->id;
        $default_contact->save();

        return $client;
    }
}
