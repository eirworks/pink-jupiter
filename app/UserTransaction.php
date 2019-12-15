<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    const TYPE_DEPOSIT = "deposit";
    const TYPE_FEE = "fee";

    public static function executeTransaction($user_id, $amount = 0, $info = "", $type = self::TYPE_DEPOSIT)
    {
        $transaction = new UserTransaction();

        $transaction->user_id = $user_id;
        $transaction->amount = $amount;
        $transaction->info = $info;
        $transaction->type = $type;
        $transaction->save();

        return $transaction;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
