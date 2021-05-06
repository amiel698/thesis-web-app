<?php

use Illuminate\Database\Seeder;
use App\Word;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            Word::create([
                'name' => 'Lake',
                'length' => 4,
                'image_location' =>'https://cdn.britannica.com/s:400x225,c:crop/97/158797-050-ABECB32F/North-Cascades-National-Park-Lake-Ann-park.jpg',
            ]);

            Word::create([
                'name' => 'Bird',
                'length' => 4,
                'image_location' =>'https://www.thespruce.com/thmb/rk3DGZLrlgEOprRfSwKqKopUzk4=/2121x1193/smart/filters:no_upscale()/Bird-GettyImages-582446599-58ec5c4d5f9b58ef7e24e7f4.jpg',
            ]);

            Word::create([
                'name' => 'Dog',
                'length' => 3,
                'image_location' =>'https://i.ytimg.com/vi/MPV2METPeJU/maxresdefault.jpg',
            ]);

            Word::create([
                'name' => 'Tiger',
                'length' => 5,
                'image_location' =>'https://cdn.mos.cms.futurecdn.net/YB6aQqKZBVjtt3PuDSkJKe.jpg',
            ]);

            Word::create([
                'name' => 'Airplane',
                'length' => 8,
                'image_location' =>'https://th.bing.com/th/id/OIP.DGq5ydli2ZlvWsNe8hUFSQHaEK?pid=ImgDet&rs=1',
            ]);

            Word::create([
                'name' => 'Cat',
                'length' => 3,
                'image_location' =>'https://img.webmd.com/dtmcms/live/webmd/consumer_assets/site_images/article_thumbnails/other/cat_relaxing_on_patio_other/1800x1200_cat_relaxing_on_patio_other.jpg',
            ]);

            Word::create([
                'name' => 'Computer',
                'length' => 8,
                'image_location' =>'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Desktop_computer_clipart_-_Yellow_theme.svg/1200px-Desktop_computer_clipart_-_Yellow_theme.svg.png',
            ]);

            Word::create([
                'name' => 'Ink',
                'length' => 3,
                'image_location' =>'https://cf.shopee.ph/file/489717b52050a8cda5a147f8ff4a0db0',
            ]);

            Word::create([
                'name' => 'Television',
                'length' => 10,
                'image_location' =>'https://previews.123rf.com/images/scanrail/scanrail1404/scanrail140400013/27472342-creative-abstract-communication-media-and-television-business-concept-old-retro-color-wooden-home-tv.jpg',
            ]);

            Word::create([
                'name' => 'Camera',
                'length' => 6,
                'image_location' =>'https://www.sony.com.ph/image/dec28ab731dad845e5e299340ac98cd4?fmt=pjpeg&bgcolor=FFFFFF&bgc=FFFFFF&wid=2515&hei=1320',
            ]);

            Word::create([
                'name' => 'Cake',
                'length' => 4,
                'image_location' =>'https://preppykitchen.com/wp-content/uploads/2019/06/Chocolate-cake-recipe-1200a.jpg',
            ]);

            Word::create([
                'name' => 'Book',
                'length' => 4,
                'image_location' =>'https://www.incimages.com/uploaded_files/image/1920x1080/getty_883231284_200013331818843182490_335833.jpg',
            ]);

            Word::create([
                'name' => 'Telephone',
                'length' => 9,
                'image_location' =>'https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/AT%26T_push_button_telephone_western_electric_model_2500_dmg_black.jpg/220px-AT%26T_push_button_telephone_western_electric_model_2500_dmg_black.jpg',
            ]);

            Word::create([
                'name' => 'Keyboard',
                'length' => 8,
                'image_location' =>'https://i.itworldcanada.com/wp-content/uploads/2019/02/keyboard-cleaning-guide-feautre.jpg',
            ]);



        
    }
}
