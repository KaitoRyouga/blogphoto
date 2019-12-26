<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $data_services = [
        	'image_name' => '1.jpg',
        	'urlservices' => 'bao-gia-chup-anh-ky-yeu',
        	'title' => 'CHỤP ẢNH KỶ YẾU',
        	'content' => 'Chụp ảnh kỷ yếu tại Đà Nẵng và các tỉnh miền trung, cho thuê đầy đủ trang phục chụp ảnh kỷ yếu. Các concept mới lạ và vô cùng hấp dẫn đang chờ..'
        ];

        $data_test = [
            'test3' => 'default',
        ];

        // DB::table('services')->insert($data_services);
        DB::table('test3')->insert($data_test);
    }
}
