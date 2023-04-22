<?php

namespace Bonlineza\DearDatabase\Models;

use Bonlineza\DearDatabase\Database\Factories\UserFactory;
use Bonlineza\DearDatabase\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $email
 */
class User extends Authenticatable
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * Scope lower cases the email search
     *
     * @param Builder $query
     * @param string $email
     *
     * @return Builder
     */
    public function scopeLowerCaseEmail(Builder $query, string $email): Builder
    {
        return $query->whereRaw('LOWER(email) = ?', [strtolower($email)]);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(config('dear-database.models.contact'));
    }

    public function defaultContact(): ?Contact
    {
        return $this->contacts()->where('default', true)->first() ?? $this->contacts()->first();
    }

    public function defaultSupplierContact(): ?Contact
    {
        return $this->contacts()->has('suppliers')->where('default', true)->first()
            ?? $this->contacts()->has('suppliers')->first();
    }

    public function getSupplier(): ?Supplier
    {
        $supplier_contact = optional($this->defaultSupplierContact());
        return optional($supplier_contact->suppliers)->first();
    }

    public function defaultCustomerContact(): ?Contact
    {
        return $this->contacts()->has('customers')->where('default', true)->first()
            ?? $this->contacts()->has('customers')->first();
    }

    public function getCustomer(): ?Customer
    {
        $customer_contact = optional($this->defaultCustomerContact());
        return optional($customer_contact->customers)->first();
    }
}
