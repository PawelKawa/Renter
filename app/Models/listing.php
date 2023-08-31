<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'
    ];
    protected $sortable = [
        'price', 'created_at', 'area'
    ];
    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'by_user_id'
        );
    }

    public function scopeMostRecent($query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            ($filters['priceFrom'] ?? false),
            //when will not run if it is null, because null will be changed to false therefore not run this when.
            fn ($query, $value) => $query->where('price', '>=', $value)
        )->when(
            ($filters['priceTo'] ?? false),
            fn ($query, $value) => $query->where('price', '<=', $value)
        )->when(
            ($filters['minBeds'] ?? false),
            fn ($query, $value) => $query->where('beds', '>=', $value)
        )->when(
            ($filters['maxBeds'] ?? false),
            fn ($query, $value) => $query->where('beds', '<=', $value)
        )->when(
            ($filters['minBaths'] ?? false),
            fn ($query, $value) => $query->where('baths', '>=', $value)
        )->when(
            ($filters['maxBaths'] ?? false),
            fn ($query, $value) => $query->where('baths', '<=', $value)
        )->when(
            ($filters['areaFrom'] ?? false),
            fn ($query, $value) => $query->where('area', '>=', $value)
        )->when(
            ($filters['areaTo'] ?? false),
            fn ($query, $value) => $query->where('area', '<=', $value)
        )->when(
            $filters['deleted'] ?? false,
            fn ($query, $value) => $query->withTrashed()
        )->when(
            $filters['by'] ?? false,
            fn ($query, $value) =>
            !in_array($value, $this->sortable) ? $query :
                $query->orderBy($value, $filters['order'] ?? 'desc')
        );
    }
}
