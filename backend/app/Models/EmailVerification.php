<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    const SEND_MAIL = 0; // 仮会員登録のメール送信
    const MAIL_VERIFY = 1; //メールアドレス認証
    const REGISTER = 2; // 本会員登録完了

    protected $fillable = [
        'email',
        'token',
        'status',
        'expiration_datetime',
        'email_verified_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function build($email, $hours = 1)
    {
        $emailVerification = new self([
            'email' => $email,
            'token' => uniqid('', true),
            'status' => self::SEND_MAIL,
            'expiration_datetime' => Carbon::now()->addHours($hours),
        ]);
        return $emailVerification;
    }

    public static function findByToken($token)
    {
        return self::where('token', '=', $token);
    }

    public function scopeTokenIsVerified($query)
    {
        return $query->where('expiration_datetime', '>=', Carbon::now());
    }

    public function mailVerify()
    {
        $this->status = self::MAIL_VERIFY;
    }

    public function isRegister()
    {
        return $this->status === self::REGISTER;
    }

    public function register()
    {
        $this->status = self::REGISTER;
    }
}
