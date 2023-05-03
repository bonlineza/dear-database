<?php

namespace Bonlineza\DearDatabase\Database\Factories;

use Bonlineza\DearDatabase\Enums\SaleOrderStatus;
use Bonlineza\DearDatabase\Models\SaleAdditionalCharge;
use Bonlineza\DearDatabase\Models\SaleOrder;
use Bonlineza\DearDatabase\Models\SaleOrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SaleOrder::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'sale_order_number' => $this->faker->unique()->numerify('SO-#####'),
            'status' => SaleOrderStatus::NotAvailable,
            'memo' => $this->faker->text,
            'total_before_tax' => 1,
            'tax' => 1,
            'total' => 1,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): self
    {
        return $this->afterCreating(function ($sale_order) {
            /** @var SaleOrder $sale_order */
            $sale_order->saleOrderLines()->sync([
                SaleOrderLine::factory()->create()->id,
                SaleOrderLine::factory()->create()->id,
            ]);
            $sale_order->saleAdditionalCharges()->sync([
                SaleAdditionalCharge::factory()->create()->id,
                SaleAdditionalCharge::factory()->create()->id,
            ]);
        });
    }
}
