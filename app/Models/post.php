<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// طالما أنني قمت باستخدام الـ softDelete لا بد من استخدام استدعاء المكتبة على الشكل التالي :
use Illuminate\Database\Eloquent\ِsoftDeletes;
class Post extends Model
{
    use HasFactory;
    // بعد استدعاء الـ SoftDeletes لابد من استخدامه على الشكل التالي :
    use SoftDeletes;
    // كذلك لا بد من أن أخبره أي يتم أستخدام الـ SoftDeletes على أساس الـ dates حيث أن الـ dates عبارة عن Attribute معرف ضمن الـ laravel
    protected $dates = ['deleted_at'];
    // بمعنى أنه يمكن أن يعلم أن الـ data تم حذفها عن طريق الـ deleted_at

    // حيث أن الـ fillable عبارة عن attribute معرف ضمن الـ laravel نحدد من خلاله عدد الحقول التي نريد من المستخدم أن يقوم بإملائها
    // يمكن أن نمسح ضمنها الـ attributes التي لا نريد للمستخدم أن يقوم بإضافتها
    // لا نضيف ضمنها الأشياء التي يتم إضافتها ضمن بشكل automatically
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'photo',
        'slug'
    ];
    // الآن لا بد من إنشاء علاقة ما بين الـ post  والـ user عن طريق الـ function التالية :
    public function user(){
        return $this->belongsTo('App\Models\User' , 'user_id');
        // بمعنى أن هذا الـ Model عائد إلى الـ UserModel عن طريق الـ user_id
        // طبعاً بالطرف الثاني لانحتاج إلى أن نزود شيء على الـ user
    }
}
