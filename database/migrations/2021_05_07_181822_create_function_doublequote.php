<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionDoublequote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // /**
        //     DROP FUNCTION IF EXISTS `DOUBLEQUOTE`; 
        //     CREATE FUNCTION `DOUBLEQUOTE`(`val` TEXT) 
        //     RETURNS TEXT CHARSET latin1 NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
        //     RETURN CONCAT('"', REPLACE( REPLACE(val, '\\', '\\\\') , '"', '\\"'), '"')
        //  */

        // $query = <<<EOD
        // DROP FUNCTION IF EXISTS `DOUBLEQUOTE`; 
        // CREATE FUNCTION `DOUBLEQUOTE`(`val` TEXT) 
        // RETURNS TEXT CHARSET latin1 NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
        // RETURN CONCAT('"', REPLACE( REPLACE(val, '\\\\', '\\\\\\\\') , '"', '\\\\"'), '"')
        // EOD;

        // DB::unprepared($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::unprepared('DROP FUNCTION IF EXISTS DOUBLEQUOTE');
    }
}
