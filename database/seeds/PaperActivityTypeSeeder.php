<?php
// use DB ;
use Illuminate\Database\Seeder;
use App\ActivityType ; 

class PaperActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      ActivityType::truncate();

      DB::table('paper_activity_types')->insert([
            ['activity_type' => 'Recommendation'],
            ['activity_type' => 'Collaboration'],
            ['activity_type' => 'Like'],
            ['activity_type' => 'Follow'],
            ['activity_type' => 'Publish Paper']
      ]);


    }
}
