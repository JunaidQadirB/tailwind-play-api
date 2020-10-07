<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BackfillHashColumnOnPlaygroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $playgrounds = DB::table('playgrounds')->whereNull('hash')->get();

        foreach ($playgrounds as $playground) {
            $playground->hash = md5(implode('.', [
                $playground->html,
                $playground->css,
                $playground->config,
            ]));

            DB::table('playgrounds')->where('id', $playground->id)->update((array) $playground);
        }
    }
}
