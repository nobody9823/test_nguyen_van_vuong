<?php

namespace App\Models;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Identification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'identifications';

    protected $fillable = [
        'bank_code',
        'branch_code',
        'account_type',
        'account_number',
        'account_name',
        'identify_image_1',
        'identify_image_2',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'identify_image_1' => ImageCast::class,
        'identify_image_2' => ImageCast::class,
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function initialize()
    {
        return self::make([
            'bank_code' => '',
            'branch_code' => '',
            'account_type' => '普通',
            'account_number' => '',
            'account_name' => '',
            'identify_image_1' => 'public/sampleImage/now_printing.png',
            'identify_image_2' => 'public/sampleImage/now_printing.png',
        ]);
    }
}
