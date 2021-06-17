<?php

namespace Tests\Unit\Models;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Talent;
use App\Models\Project;
use App\Models\ActivityReport;
use App\Models\ActivityReportImage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityReportTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->activityReport = Company::factory()->create()
                ->talents()->saveMany(Talent::factory(1)->make())->first()
                ->projects()->saveMany(Project::factory(1)->make())->first()
                ->activityReports()->saveMany(ActivityReport::factory(1)->state([
                    'title' => "test",
                    'content' => "test"
                ])->make())->first();

        $this->activityReportImage = $this->activityReport->activityReportImages()
                                            ->saveMany(ActivityReportImage::factory(1)->state([
                                                'image_url' => 'public/sampleImage/now_printing.png'
                                            ])->make());
    }

    public function testSoftDeleteIsSuccess()
    {
        $this->actingAs($this->admin);

        $activity_report_id = $this->activityReport->id;

        $this->activityReport->delete();

        $activityReports = ActivityReport::onlyTrashed()->where('id', $activity_report_id)->get();

        $deletedActivityReportImage = ActivityReportImage::onlyTrashed()->where('activity_report_id', $activityReports->first()->id)->get();

        $this->assertCount(1, $activityReports);
        $this->assertCount(1, $deletedActivityReportImage);
    }
}
