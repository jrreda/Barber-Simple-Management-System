<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'price', 'discount_type', 'discount_value'];

    /**
     * Calculate the final price after applying discount
     *
     * @return float
     */
    public function getFinalPriceAttribute(): float
    {
        if (!$this->discount_type || !$this->discount_value) {
            return (float) $this->price;
        }

        if ($this->discount_type === 'fixed') {
            return max(0, (float) $this->price - (float) $this->discount_value);
        }

        if ($this->discount_type === 'percentage') {
            $discountAmount = ((float) $this->price * (float) $this->discount_value) / 100;
            return max(0, (float) $this->price - $discountAmount);
        }

        return (float) $this->price;
    }

    /**
     * Calculate the discount amount
     *
     * @return float
     */
    public function getDiscountAmountAttribute(): float
    {
        if (!$this->discount_type || !$this->discount_value) {
            return 0;
        }

        if ($this->discount_type === 'fixed') {
            return (float) $this->discount_value;
        }

        if ($this->discount_type === 'percentage') {
            return ((float) $this->price * (float) $this->discount_value) / 100;
        }

        return 0;
    }
}
