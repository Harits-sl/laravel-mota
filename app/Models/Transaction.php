<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * image
     *
     * @return Attribute
     */
    protected function transferReceipt(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('/storage/images/' . $image),
        );
    }

    // public function getOrdersByRangeDate($firstDate, $secondDate)
    // {
    //     return $this->where("order_date BETWEEN '{$firstDate}' AND '{$secondDate}'")->findAll();
    // }
}
