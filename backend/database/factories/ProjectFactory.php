<?php

namespace Database\Factories;

use App\Models\Project;
use Carbon\Carbon;
use App\Enums\ProjectReleaseStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'title' => Arr::random([
                '〇〇さんに対する長年にわたるハラスメント行為や違法労働等への訴訟',
                '「元〇〇」さんの発信者情報開示請求の費用',
                'ネットでの誹謗中傷により自殺した「〇〇」さんの遺族訴訟費用',
                '〇〇さんへの暴力行為への訴訟費用を集めよう',
            ]),
            'content' =>
                '【なぜ資金が必要か】本件訴訟の原告代理人は、日本エンターテイナーライツ協会（ERA）の共同代表である弁護士5名が担当します。日本エンターテイナーライツ協会（ERA）は、平成29年5月に発足し、芸能人の活動や私生活を守るために、社会や法律（権利）に関する芸能人の知識向上を支援しています。また、芸能人の地位向上に役立つ情報や提言を社会に広く発信するとともに、芸能事務所と芸能人の「架け橋」となって、芸能界を健全に発展させることを目指しています。日本エンターテイナーライツ協会は、平成30年6月に「地下アイドル権利擁護プロジェクト」を発足しました。地下アイドルは、芸能人の中でも特に権利侵害が生じる危険が高く権利擁護の必要性が高い社会問題のひとつです。また、地下アイドルの問題については、契約内容の適正化だけで解決することが難しく、法律面だけでなく医療や福祉、教育にもまたがった横断的かつ広範な取組が必要です。日本エンターテイナーライツ協会（ERA）は、この訴訟について、地下アイドル業界におけるハラスメントや違法労働の実態を世の中に明らかにし、地下アイドルたちの権利を守り、地下アイドル業界の健全化するために重要な活動であると考え、すべての費用を手弁当で負担しています。代理人らは東京と福岡を拠点としているため、松山までの交通費が必要です。提訴までも複数の弁護士が何度も松山に入り、ご遺族と打合せを重ねて来ました。提訴までに支出した費用は100万円を超えていますが、裁判が継続するであろう期間を考えると、最低でも総額300万円を超えるものと予想しております。皆さまからの支援金は、訴訟活動の経費として、大切に使わせていただきます。また、訴訟の経過については、このプロジェクト内において随時ご報告いたします。ぜひ、日本中のアイドルたちが笑顔で活動できるように、この裁判をご支援ください。',
            'release_status' => Arr::random(
                ProjectReleaseStatus::getValues()
            ),
            'start_date' => Carbon::now(),
            'end_date' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+3 month'),
            'target_amount' => $this->faker->randomDigit * 100000,
        ];
    }
}
