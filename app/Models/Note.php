<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        // 'uuid',
        'user_id',
        'title',
        'body',
        'send_date',
        'recipient',
        'is_published',
        'heart_count'
    ];

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'send_date' => 'date',
        'is_published' => 'boolean',
        'heart_count' => 'integer'
    ];

    // Relacionamento com User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Boot do modelo para gerar UUID automaticamente
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        });
    }

    // public function publishedNotes(User $user)
    // {
    //     return $this->where('user_id', $user->id)
    //         ->where('is_published', true)
    //         ->get();
    // }
}
