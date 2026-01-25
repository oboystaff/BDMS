<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class Book extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $routine) {
            $routine->book_id =  $routine->generateBookId();
        });
    }

    public function generateBookId()
    {
        $book_id = rand(10000000, 99999999);

        while (self::where('book_id', $book_id)->exists()) {
            $this->generateBookId();
        }

        return $book_id;
    }
}
