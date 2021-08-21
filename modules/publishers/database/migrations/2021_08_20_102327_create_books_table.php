<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:22 PM
 */

use Base\Enums\StatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->bigIncrements('id')->unsigned();

            $table->bigInteger('author_id')->unsigned()->index();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');

            $table->string('slug')->nullable(false)->unique()->index();
            $table->string('image_url')->nullable();
            $table->string('title')->nullable()->index();
            $table->longText('description')->nullable();
            $table->float('price');

            $table->enum('status', [StatusEnum::ACTIVATED, StatusEnum::INACTIVATED, StatusEnum::DRAFTED, StatusEnum::ARCHIVED])->nullable()->default(StatusEnum::ACTIVATED)->index();
            $table->tinyInteger('priority')->nullable()->default(0);
            $table->bigInteger('created_by')->nullable()->unsigned();
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->bigInteger('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
