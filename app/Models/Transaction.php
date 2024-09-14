<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch(Builder $query, $search)
    {
        return $query->whereHas('customer', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
    }
    public function getRouteKeyName()
    {
        return 'invoice_number';
    }
}