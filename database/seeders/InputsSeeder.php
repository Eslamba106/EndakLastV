<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InputsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Inputs::updateOrCreate(['id' => 7], ['title_ar' => 'ملاحظات عن العمل المطلوب', 'title_en' => 'Notes', 'name' => 'notes', 'type' => 'text']);
        \App\Models\Inputs::updateOrCreate(['id' => 6], ['title_ar' => 'الي الدور', 'title_en' => 'To House', 'name' => 'to_house', 'type' => 'text']);
        \App\Models\Inputs::updateOrCreate(['id' => 5], ['title_ar' => 'الي الحي', 'title_en' => 'To Neighborhood', 'name' => 'to_neighborhood', 'type' => 'text']);
        \App\Models\Inputs::updateOrCreate(['id' => 4], ['title_ar' => 'الي المدينة', 'title_en' => 'To City', 'name' => 'to_city', 'type' => 'text']);
        \App\Models\Inputs::updateOrCreate(['id' => 3], ['title_ar' => 'من الدور', 'title_en' => 'From House', 'name' => 'from_house', 'type' => 'text']);
        \App\Models\Inputs::updateOrCreate(['id' => 2], ['title_ar' => 'من الحي', 'title_en' => 'From Neighborhood', 'name' => 'from_neighborhood', 'type' => 'text']);
        \App\Models\Inputs::updateOrCreate(['id' => 1], ['title_ar' => 'من المدينة', 'title_en' => 'From City', 'name' => 'from_city', 'type' => 'text']);

        // \App\Models\Inputs::updateOrCreate(['id' => 2], ['title_ar' => 'السعر', 'title_en' => 'Price', 'name' => 'price', 'type' => 'number']);
        // \App\Models\Inputs::updateOrCreate(['id' => 3], ['title_ar' => 'العنوان', 'title_en' => 'Title', 'name' => 'title', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 4], ['title_ar' => 'الوصف', 'title_en' => 'Description', 'name' => 'description', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 5], ['title_ar' => 'عدد القطع', 'title_en' => 'Count of Items', 'name' => 'count', 'type' => 'number']);
        // \App\Models\Inputs::updateOrCreate(['id' => 8], ['title_ar' => 'مدينة', 'title_en' => 'City', 'name' => 'city', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 9], ['title_ar' => 'حي', 'title_en' => 'Neighborhood', 'name' => 'neighborhood', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 10], ['title_ar' => 'من الطابق', 'title_en' => 'From Floor', 'name' => 'from_floor', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 11], ['title_ar' => 'من المنزل', 'title_en' => 'From House', 'name' => 'from_house', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 14], ['title_ar' => 'الي طابق', 'title_en' => 'To Floor', 'name' => 'to_floor', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 43], ['title_ar' => 'الي المنزل', 'title_en' => 'To House', 'name' => 'to_house', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 16], ['title_ar' => 'ارفاق صور', 'title_en' => 'Image', 'name' => 'image', 'type' => 'file']);
        // \App\Models\Inputs::updateOrCreate(['id' => 17], ['title_ar' => 'ارفاق فيديو', 'title_en' => 'Video', 'name' => 'video', 'type' => 'file']);
        // \App\Models\Inputs::updateOrCreate(['id' => 18], ['title_ar' => 'شرح العطل', 'title_en' => 'Explain', 'name' => 'explain', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 19], ['title_ar' => 'الموديل او الماركة', 'title_en' => 'modal', 'name' => 'modal', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 20], ['title_ar' => 'عدد ايام الضمان', 'title_en' => 'Numbers Of Warranty Days', 'name' => 'days_count', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 21], ['title_ar' => 'الوزن', 'title_en' => 'Weight of Item', 'name' => 'weight', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 22], ['title_ar' => 'رقم الهيكل', 'title_en' => 'Item Code Number', 'name' => 'code_number', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 23], ['title_ar' => 'اسم القطعة', 'title_en' => 'Name', 'name' => 'name', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 24], ['title_ar' => 'سنه الصنع', 'title_en' => 'Manufacturing Year', 'name' => 'manufacturing_year', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 25], ['title_ar' => 'الفئة', 'title_en' => 'Section', 'name' => 'section', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 26], ['title_ar' => 'الشاحنة', 'title_en' => 'Cars', 'name' => 'cars', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 27], ['title_ar' => 'تنظيف', 'title_en' => 'Clean', 'name' => 'clean', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 28], ['title_ar' => 'تعبئة فريون', 'title_en' => 'Verion', 'name' => 'Verion', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 29], ['title_ar' => 'اصلاح عطل', 'title_en' => 'Fixed', 'name' => 'fixed', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 30], ['title_ar' => 'بصمة', 'title_en' => 'Fingerprint', 'name' => 'fingerprint', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 31], ['title_ar' => 'كاميرات مراقبة', 'title_en' => 'camera', 'name' => 'camera', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 32], ['title_ar' => 'النوع', 'title_en' => 'Type', 'name' => 'type', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 33], ['title_ar' => 'سمارت', 'title_en' => 'Smart', 'name' => 'smart', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 34], ['title_ar' => 'انظمة امنية', 'title_en' => 'System Security', 'name' => 'system_security', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 35], ['title_ar' => 'انظمة اطفاء الحرائق', 'title_en' => 'Fire System', 'name' => 'fire_system', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 36], ['title_ar' => 'شبكات', 'title_en' => 'Networks', 'name' => 'networks', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 37], ['title_ar' => 'الوقت', 'title_en' => 'Time', 'name' => 'time', 'type' => 'date']);
        // \App\Models\Inputs::updateOrCreate(['id' => 38], ['title_ar' => 'الجنس', 'title_en' => 'Gender', 'name' => 'gender', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 39], ['title_ar' => 'نوع الاكل', 'title_en' => 'Food', 'name' => 'food', 'type' => 'text']);
        // \App\Models\Inputs::updateOrCreate(['id' => 40], ['title_ar' => 'التاريخ', 'title_en' => 'Date', 'name' => 'date', 'type' => 'date']);
        // \App\Models\Inputs::updateOrCreate(['id' => 41], ['title_ar' => 'الحجم', 'title_en' => 'Size', 'name' => 'size', 'type' => 'text']);
        // // \App\Models\Inputs::updateOrCreate(['id' => 42], ['title_ar' => '', 'title_en' => '', 'name' => '', 'type' => 'text']);

    }
}
