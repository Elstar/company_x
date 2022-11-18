<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('type_id', ['simple']);
            $table->string('sku');
            $table->string('opera_sku')->nullable();
            $table->string('old_sku')->nullable();
            $table->unsignedSmallInteger('override_opera');
            $table->string('name');
            $table->unsignedMediumInteger('inlet')->nullable();
            $table->unsignedMediumInteger('outlet')->nullable();
            $table->unsignedMediumInteger('hose_type')->nullable();
            $table->unsignedMediumInteger('angle_in_deg')->nullable();
            $table->unsignedMediumInteger('max_lpm')->nullable();
            $table->unsignedMediumInteger('voltage')->nullable();
            $table->unsignedMediumInteger('material')->nullable();
            $table->unsignedMediumInteger('bar')->nullable();
            $table->unsignedMediumInteger('o-ring_thickness')->nullable();
            $table->unsignedMediumInteger('diameter')->nullable();
            $table->unsignedMediumInteger('colour')->nullable();
            $table->unsignedMediumInteger('rpm')->nullable();
            $table->unsignedTinyInteger('status');
            $table->string('url_key')->unique();
            $table->unsignedTinyInteger('visibility');
            $table->unsignedTinyInteger('clearance')->nullable();
            $table->unsignedMediumInteger('max_temperature')->nullable();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->text('tech_spec_1')->nullable();
            $table->text('tech_spec_2')->nullable();
            $table->text('tech_spec_3')->nullable();
            $table->text('product_videos')->nullable();
            $table->unsignedMediumInteger('nozzle_value')->nullable();
            $table->unsignedSmallInteger('nozzle_size')->nullable();
            $table->unsignedTinyInteger('foam_value')->nullable();
            $table->unsignedTinyInteger('is_featured')->nullable();
            $table->unsignedTinyInteger('featured_position')->nullable();
            $table->string('hose_clamp_size')->nullable();
            $table->unsignedSmallInteger('orifice_size')->nullable();
            $table->string('shoe_size')->nullable();
            $table->string('thread')->nullable();
            $table->string('size_and_angle')->nullable();
            $table->string('inlet_outlet')->nullable();
            $table->string('clothing_size')->nullable();
            $table->string('wheel_style')->nullable();
            $table->string('flow_and_pressure')->nullable();
            $table->string('country_of_manufacture', 3)->nullable();
            $table->unsignedSmallInteger('select_nozzle_size')->nullable();
            $table->unsignedSmallInteger('dn_internal_diameter')->nullable();
            $table->unsignedSmallInteger('currency')->nullable();
            $table->string('pack_size')->nullable();
            $table->string('easyturn')->nullable();
            $table->unsignedTinyInteger('priority')->nullable();
            $table->string('manufacturer_number_1')->nullable();
            $table->string('manufacturer_number_2')->nullable();
            $table->string('manufacturer_number_3')->nullable();
            $table->string('manufacturer_number_4')->nullable();
            $table->string('manufacturer_number_5')->nullable();
            $table->string('manufacturer_number_6')->nullable();
            $table->string('manufacturer_number_7')->nullable();
            $table->string('manufacturer_number_8')->nullable();
            $table->string('manufacturer_number_9')->nullable();
            $table->string('manufacturer_number_10')->nullable();
            $table->unsignedSmallInteger('hose_application')->nullable();
            $table->unsignedSmallInteger('hose_inlet')->nullable();
            $table->unsignedSmallInteger('hose_outlet')->nullable();
            $table->unsignedSmallInteger('hose_length')->nullable();
            $table->unsignedSmallInteger('hose_colour')->nullable();
            $table->string('price')->nullable();
            $table->string('special_price')->nullable();
            $table->unsignedTinyInteger('poa')->nullable();
            $table->unsignedFloat('poa_price', 3)->nullable();
            $table->string('msrp')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('pdf_title_1')->nullable();
            $table->string('pdf_title_2')->nullable();
            $table->string('pdf_title_3')->nullable();
            $table->string('pdf_title_4')->nullable();
            $table->string('bullet_point_1')->nullable();
            $table->string('bullet_point_2')->nullable();
            $table->string('bullet_point_3')->nullable();
            $table->string('bullet_point_4')->nullable();
            $table->string('maintenance_videos')->nullable();
            $table->string('maintenance_video_title_1')->nullable();
            $table->string('maintenance_video_url_1')->nullable();
            $table->string('maintenance_video_title_2')->nullable();
            $table->string('maintenance_video_url_2')->nullable();
            $table->string('maintenance_video_title_3')->nullable();
            $table->string('maintenance_video_url_3')->nullable();
            $table->string('maintenance_video_title_4')->nullable();
            $table->string('maintenance_video_url_4')->nullable();
            $table->unsignedTinyInteger('stock_status');
            $table->json('related_products')->nullable();
            $table->foreignId('configurable_product_parent_id')->nullable()->constrained('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
