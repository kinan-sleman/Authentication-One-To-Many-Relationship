<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // يجب التذكير أنه يمكنني أن أضع أي شيءاختياري nullable
            $table->increments('id');
            // من خلاله يمكن أن نعرف الـ user الذي قام بنشر هذا الـ post
            $table->integer('user_id');
            $table->string('title');
            $table->longText('content');
            $table->string('photo');
            // من دون الـ slug فإنه عند التعامل مع أي post لا بد من الإشارة له بـ id ضمن الرابط وهذا ما يسمح للـ Hackers من اختراق حساباتنا والتعامل معها
            // ولكن من خلال الـ slug يتم توليد custom Address يتم من خلاله تحديد الـ post الذي نريده
            // على سبيل المثال بدلاً من أن نضع : https://localhost/posts/3
            // يتم وضع على سبيل المثال : https://localhost/posts/c*$%^&^%$SFX
            $table->string('slug');
            // يمكن أن نقوم بتعريف الـ softDelete من أجل استخدام الـ forceDelete أو الـ softDelete من دون الحاجة إلى تعريف شيء ضمن الـ Model
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
