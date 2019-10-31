[33mcommit 44d7f4b8dd1286d3e23b212f105833674ab1e49e[m
Author: jose <jmmf@outlok.com>
Date:   Sat Oct 12 20:50:36 2019 -0500

    cuas

[1mdiff --git a/app/Pastel.php b/app/Pastel.php[m
[1mnew file mode 100644[m
[1mindex 0000000..f8e2259[m
[1m--- /dev/null[m
[1m+++ b/app/Pastel.php[m
[36m@@ -0,0 +1,11 @@[m
[32m+[m[32m<?php[m
[32m+[m
[32m+[m[32mnamespace App;[m
[32m+[m
[32m+[m[32muse Illuminate\Database\Eloquent\Model;[m
[32m+[m
[32m+[m[32mclass Pastel extends Model[m
[32m+[m[32m{[m
[32m+[m[32m    protected $table = 'pasteles';[m
[32m+[m[41m    [m
[32m+[m[32m}[m
[1mdiff --git a/database/migrations/2019_10_13_013144_crear_tabla_pasteles.php b/database/migrations/2019_10_13_013144_crear_tabla_pasteles.php[m
[1mnew file mode 100644[m
[1mindex 0000000..1df7d42[m
[1m--- /dev/null[m
[1m+++ b/database/migrations/2019_10_13_013144_crear_tabla_pasteles.php[m
[36m@@ -0,0 +1,31 @@[m
[32m+[m[32ms<?php[m
[32m+[m
[32m+[m[32muse Illuminate\Database\Migrations\Migration;[m
[32m+[m[32muse Illuminate\Database\Schema\Blueprint;[m
[32m+[m[32muse Illuminate\Support\Facades\Schema;[m
[32m+[m
[32m+[m[32mclass CrearTablaPasteles extends Migration[m
[32m+[m[32m{[m
[32m+[m[32m    /**[m
[32m+[m[32m     * Run the migrations.[m
[32m+[m[32m     *[m
[32m+[m[32m     * @return void[m
[32m+[m[32m     */[m
[32m+[m[32m    public function up()[m
[32m+[m[32m    {[m
[32m+[m[32m        Schema::create('pasteles', function (Blueprint $table) {[m
[32m+[m[32m            $table->bigIncrements('id');[m
[32m+[m[32m            $table->timestamps();[m
[32m+[m[32m        });[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    /**[m
[32m+[m[32m     * Reverse the migrations.[m
[32m+[m[32m     *[m
[32m+[m[32m     * @return void[m
[32m+[m[32m     */[m
[32m+[m[32m    public function down()[m
[32m+[m[32m    {[m
[32m+[m[32m        Schema::dropIfExists('pasteles');[m
[32m+[m[32m    }[m
[32m+[m[32m}[m
