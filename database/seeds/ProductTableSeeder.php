<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Product;
use App\Rating;
use Illuminate\Support\Facades\File;


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//            $inventories = \DB::table('products')->pluck('id')->toArray();
//            $path = storage_path('app/public/'.image_storage_dir());
//
//            if(!File::isDirectory($path))
//                File::makeDirectory($path);
//
//            $directories = glob(public_path('images/demo/products/*') , GLOB_ONLYDIR);

            for ($i=2;$i<=31;$i++) {
//                $images = glob($directories[array_rand($directories)] . '/*.png');


                    $imges = 'public/images/product_images/image_pbtbwgfAljQqg4u.png';
                    $feature_image = 'public/images/product_images/image_NYO3imTSBbQptDU.png';

                    DB::table('products')->insert([
                        [
                            'name' => str_random(15),
                            'slug' => str_random(5),
                            'description' => str_random(25),
                            'price' => mt_rand(10,100),
                            'quantity' => rand(2,10),
                            'user_id' => 1,
                            'cat_id' => rand(10,17),
                            'unit_id' => 1,
                            'created_at' => Carbon::Now(),
                            'updated_at' => Carbon::Now(),
                        ]
                    ]);
//                DB::table('ratings')->insert([
//                        [
//                            'rating' => (0+lcg_value()*(abs(5-0))),
//                            'review' => str_random(4),
//                            'product_id' => $i,
//                            'rated_by' => 6,
//                            'created_at' => Carbon::Now(),
//                            'updated_at' => Carbon::Now(),
//                        ]
//                    ]);
//                $feature=1;
//                    for ($j=1;$j<=2;$j++)
//                    {
//
//                        DB::table('product_images')->insert([
//                            [
//                                'path'=> ($feature ==1)? $feature_image: $imges ,
//                                'is_feature   d' => ($feature ==1)? 1:0,
//                                'product_id' => $i,
//                                'created_at' => Carbon::Now(),
//                                'updated_at' => Carbon::Now(),
//                            ]
//                        ]);
//                        $feature=0;
//
//                    }


            }

    }
}
