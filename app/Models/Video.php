<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'attributes',
        'original_language',
        'classification',
        'series_id',
    ];

    protected $searchableFields = ['*'];

    public function videoPeople()
    {
        return $this->hasMany(VideoPerson::class);
    }

    public function allRentals()
    {
        return $this->hasMany(Rentals::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function allCollections()
    {
        return $this->belongsToMany(Collections::class);
    }
}
