<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts()
    {
        return [
            'items' => 'array',
        ];
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getRouteKeyName()
    {
        return 'invoice_number';
    }
}
