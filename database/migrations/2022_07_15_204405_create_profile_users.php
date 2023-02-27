<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province'); // للدلالة على المحافظة
            // هذا  السطر من الكورس ولكنه لم يعمل :
            // $table->integer('id')->unsigned();
            // بينما كان حل هذه المشكلة من stackOverFlow من خلال السطر التالي :
            $table->unsignedBigInteger('user_id'); // بمعنى أنه كل id من هذا الجدول يجب أن يمتلك user_id تابع للـ table الخاص بالـ users وحتى يقبل الربط مع الـ table الذي يدعى users يجب أي يكون unsigned
            $table->string('gender'); // للدلالة على الجنس
            $table->longText('bio'); // للدلالة على السيرة الذاتية
            $table->longText('facebook'); //للدلالة على رابط الـ facebook
            $table->timestamps();
            // من خلال هذا السطر يتم التوضيح على أن الـ user_id عبارة عن id غريب ضمن هذا الـ table وهو تابع لـ column يدعى id موجود ضمن الـ users table
            // في بعض الأحيان عندما نقوم بحذف الـ user من الـ users table فإن الـ MySQL سيقوم بمنعنا بحيث يتم في البداية حذفه من الـ profile_user ومن ثم حذفه من الـ users
            // هذه الطريقة ليست profesional وبالتالي يكون الحل هنا هو استخدام الـ onDelete()
            // من خلال الـ onDelete('cascade') فإنه عند حذف الـ User من الـ users table يتم من خلف الكواليس حذف الـ profile الخاص به من خلال عملية واحدة فقط
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_users');
    }
}
