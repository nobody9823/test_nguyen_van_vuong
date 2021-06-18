<?php

namespace Database\Seeders;

use App\Models\ActivityReport;
use App\Models\ActivityReportImage;
use App\Models\Option;
use App\Models\Plan;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectVideo;
use App\Models\RepliesToSupporterComment;
use App\Models\SupporterComment;
use App\Models\User;
use App\Models\UserPlanCheering;
use App\Models\UserSupporterCommentLiked;
use App\Models\UserProjectLiked;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();

        Project::factory(30)->create();

    }
}
