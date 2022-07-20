<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTrashed();
    }

    public function rates()
    {
        return $this->hasMany(Rate::class, 'event_id');
    }

    public function rating()
    {
        // Barresi shavad
        $rates = $this->rates;
        $count = count($rates);
        $sum = 0;
        foreach ($rates as $rate) {
            $sum += $rate->rate;
        }
        if ($count != 0) {
            return round($sum / $count, 2);
        } else {
            return "Not Rated Yet!";
        }
    }
    public static function rateTableColor($rate){
        if($rate == "Not Rated Yet!"){
            return "background: white; color: black;";
        }elseif($rate >= 8){
            return "background: green; color: black;";
        }elseif($rate >= 6){
            return "background: yellow; color: black;";
        }
        elseif($rate >= 4){
            return "background: #FFCCCB; color: black;";
        }else{
            return "background: red; color: black;";
        }

    }

    public function yourRate($user_id, $event_id)
    {
        $rates = Rate::all()->where('user_id', $user_id)->where('event_id', $event_id);
        $count = count($rates);
        $sum = 0;
        foreach ($rates as $rate) {
            $sum += $rate->rate;
        }
        if ($count != 0) {
            return round($sum / $count, 2);
        } else {
            return "Not Rated Yet!";
        }
    }

    public function carbon($date)
    {
        $c = new Carbon($date);
        $dt = new Verta($c);
       return $dt->format('%B %d، %Y');
    }

    public function userList($usernames)
    {
        return implode(" | ",  $usernames);
    }

    public function terminator($array)
    {
        unset($array);
    }
}
