<?php

namespace QuickPanel\Platform\Models\Support;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TicketFile extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function replay()
    {
        return $this->belongsTo(TicketReplay::class);
    }

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute(): Attribute
    {
        return Attribute::get(function () {
            if (empty($this->file)) {
                return null;
            }

            $disk = Storage::disk('s3');

            try {
                return $disk->temporaryUrl($this->file, now()->addMinutes(60));
            } catch (\Throwable $e) {
                // Fallback to a public URL if the disk/driver doesn't support temporary URLs (e.g., local driver in dev)
                return $disk->url($this->file);
            }
        });
    }
}
