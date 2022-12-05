<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'price',
        'category',
        'image',
        'description'
    ];



    public function cartDetail()
    {
        return $this->hasMany(CartDetail::class, 'item_id');
    }
    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class, 'item_id');
    }

    public function scopeFilter($query)
    {
        if (request('search')) {
            return
                $query->where('name', 'like', '%' . request('search') . '%');
        }
    }

    public static function generateItemId($length = 5)
    {
        $itemId = Str::random($length);
        $exists = DB::table('items')->where('id', '=', $itemId)->get(['id']);
        if (isset($exists[0]->id)) return self::generateItemId();

        return $itemId;
    }
}
