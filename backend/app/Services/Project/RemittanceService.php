<?php

namespace App\Services\Project;

use App\Models\Deposit;
use App\Models\Project;
use App\Traits\UniqueToken;
use Exception;
use Illuminate\Support\Facades\DB;
use Log;
use App\Actions\CardPayment\CardPaymentInterface;
use App\Services\Date\DateFormatFacade;

class RemittanceService
{
    public function __construct(CardPaymentInterface $card_payment_interface)
    {
        $this->card_payment = $card_payment_interface;
    }

    public function createDepositsAndGmoRemittance(Project $project, $amount)
    {
        $deposit_id = UniqueToken::getToken();
        DB::beginTransaction();
        try {
            $response = $this->card_payment->remittance($deposit_id, $project->user->identification->bank_id, $amount, 1);
            $project->deposits()->save(Deposit::make(['deposit_id' => $response['Deposit_ID']]));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->card_payment->remittance($deposit_id, $project->user->identification->bank_id, $amount, 2);
            Log::alert($e);
            return redirect()->route('admin.project.index', ['project' => $project->id])->withErrors('インフルエンサーへの送金に失敗しました。時間をおいてもう一度お試しください。');
        }
    }

    public function checkRequiredConditions(Project $project)
    {
        if (is_null($project->user->identification->bank_id)) {
            return [
                'status' => false,
                'message' => 'インフルエンサーの銀行口座が登録されておりません。',
            ];
        } else if (DateFormatFacade::checkDateIsFuture($project->end_date)) {
            return [
                'status' => false,
                'message' => 'プロジェクトの終了時刻が過ぎていないため実行できません。',
            ];
        }
        return [
            'status' => true,
        ];
    }
}
