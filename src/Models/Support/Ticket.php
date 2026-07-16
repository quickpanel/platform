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
        $relation = $this->belongsTo(User::class)->withDefault(function (User $user) {
            $label = __('platform::common.deleted_user');
            $user->name = $label;
            $user->email = $label;
            $user->mobile = $label;
        });

        if (in_array(SoftDeletes::class, class_uses_recursive(User::class), true)) {
            $relation->withTrashed();
        }

        return $relation;
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
