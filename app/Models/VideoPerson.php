<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoPerson extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['video_id', 'people_id'];

    protected $searchableFields = ['*'];

    protected $table = 'video_people';

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
