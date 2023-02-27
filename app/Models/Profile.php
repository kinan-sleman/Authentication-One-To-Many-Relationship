<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    // في حالة التي نقوم بها بإنشاء Model بشكل مستقل يجب أن أذكر ضمنه اسم الـ table الذي أتحكم به من خلال الـ Model
    protected $table = 'profile_users';
    // هذه البيانات التي يسمح للمستخدم أن يضيفها فقط
    protected $fillable =  [
        'province',
        'user_id',
        'gender',
        'bio',
        'facebook'
    ];
    public function user(){
        // هذه الـ function لربط الـ Profile Model مع الـ User Model
        // أي بمعنى قم بتصدية من هذا الجدول الـ user_id الذي هو بالأصل foreign key إلى الـ Model الذي يدعى User والذي يكون فيه عبارة عن Primary id
        return $this->belongsTo('App\Models\User','user_id');
    }
}
