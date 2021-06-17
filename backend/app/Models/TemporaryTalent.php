<?php

namespace App\Models;

use App\Casts\ImageCast;
use App\Casts\HashMake;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TemporaryTalent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "temporary_talents";

    protected $fillable = [
        'name',
        'email',
        'password',
        'office_address',
        'phone_number',
        'recognition_of_service',
        'image_url',
        'certificate_file_1',
        'certificate_file_2',
        'certificate_file_3',
        'bank_name',
        'bank_branch_name',
        'bank_account_number',
        'bank_account_holder',
    ];

    protected $casts = [
        'image_url' => ImageCast::class,
        'certificate_file_1' => ImageCast::class,
        'certificate_file_2' => ImageCast::class,
        'certificate_file_3' => ImageCast::class,
        'password' => HashMake::class,
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function scopeGetTemporaryTalents()
    {
        return $this->orderBy('created_at', 'desc')->paginate(10);
    }

    public function scopeGetTemporaryTalentsForCompany(Builder $builder, int $company_id)
    {
        return $builder->where('company_id', $company_id)->orderBy('created_at', 'desc')->paginate(10);
    }

    public function storeAction($request, $email_verification) :void
    {
        // FIXME configなどでフリータレント用のcompany_id用意する必要がありそう...？
        $this->company_id = 1;
        $this->email = $email_verification->email;
        $this->email_verified_at = $email_verification->updated_at;
        $this->certificate_file_1 = isset($request->certificate_files[0]) ? $request->certificate_files[0] : "";
        $this->certificate_file_2 = isset($request->certificate_files[1]) ? $request->certificate_files[1] : "";
        $this->certificate_file_3 = isset($request->certificate_files[2]) ? $request->certificate_files[2] : "";
        $this->fill($request->all())->save();
    }
}
