<?php

namespace QuickPanel\Platform\Models\Support;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replays()
    {
        return $this->hasMany(TicketReplay::class, 'ticket_id', 'id')->orderBy('created_at', 'desc');
    }

    public function files()
    {
        return $this->hasMany(TicketFile::class, 'ticket_id', 'id');
    }

}
