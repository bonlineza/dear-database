<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Models\Contact;
use Bonlineza\DearDatabase\Models\Supplier;
use Bonlineza\DearDatabase\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'external_guid' => $this->faker->unique()->uuid,
            'name' => $this->faker->unique()->safeEmail,
            'status' => 'Active',
            'discount' => 0,
            'comments' => '',
            'currency' => 'ZAR',
            'payment_term' => '60 Days',
            'account_payable' => 800,
            'tax_rule' => 'Standard Rate Purchases',
            'last_modified_on' => Carbon::now(),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function ($supplier) {
            /** @var Supplier $supplier */
            $contact = Contact::factory()->create([
                'email' => $supplier->name
            ]);
            $supplier->contacts()->save($contact);
            $user = User::factory()->create([
                'email' => $supplier->name
            ]);
            $contact->user_id = $user->id;
            $contact->default = true;
            $contact->save();
        });
    }
}
