<?php

namespace App\Traits;

trait SortBySelected
{
    public function scopeSortBySelected($query, $sort_type)
    {
        //必要な分だけ追加記述
        switch ($sort_type) {
            case 'id_asc':
                return $query->orderBy('id', 'asc');
                break;
            case 'id_desc':
                return $query->orderBy('id', 'desc');
                break;
            case 'name_asc':
                return $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                return $query->orderBy('name', 'desc');
                break;
            case 'email_asc':
                return $query->orderBy('email', 'asc');
                break;
            case 'email_desc':
                return $query->orderBy('email', 'desc');
                break;
            case 'title_asc':
                return $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                return $query->orderBy('title', 'desc');
                break;
            case 'prefecture_asc':
                return $query->orderBy('prefecture', 'asc');
                break;
            case 'prefecture_desc':
                return $query->orderBy('prefecture', 'desc');
                break;
            case 'age_asc':
                return $query->orderBy('age', 'asc');
                break;
            case 'age_desc':
                return $query->orderBy('age', 'desc');
                break;
            case 'address_asc':
                return $query->orderBy('address', 'asc');
                break;
            case 'address_desc':
                return $query->orderBy('address', 'desc');
                break;
            case 'gender_asc':
                return $query->orderBy('gender', 'asc');
                break;
            case 'gender_desc':
                return $query->orderBy('gender', 'desc');
                break;
            case 'created_at_asc':
                return $query->orderBy('created_at', 'asc');
                break;
            case 'created_at_desc':
                return $query->orderBy('created_at', 'desc');
                break;
            case 'updated_at_asc':
                return $query->orderBy('updated_at', 'asc');
                break;
            case 'updated_at_desc':
                return $query->orderBy('updated_at', 'desc');
                break;
            case 'last_login_at_asc':
                return $query->orderBy('last_login_at', 'asc');
                break;
            case 'last_login_at_desc':
                return $query->orderBy('last_login_at', 'desc');
                break;


            case 'is_main_published_asc':
                return $query->orderBy('is_main_published', 'asc');
                break;
            case 'is_main_published_desc':
                return $query->orderBy('is_main_published', 'desc');
                break;
            case 'remarks_asc':
                return $query->orderBy('remarks', 'asc');
                break;
            case 'remarks_desc':
                return $query->orderBy('remarks', 'desc');
                break;

            //会社管理
            case 'contract_status_asc':
                return $query->orderBy('contract_status', 'asc');
                break;
            case 'contract_status_desc':
                return $query->orderBy('contract_status', 'desc');
                break;
            case 'contract_date_asc':
                return $query->orderBy('contract_date', 'asc');
                break;
            case 'contract_date_desc':
                return $query->orderBy('contract_date', 'desc');
                break;
            case 'cancellation_date_asc':
                return $query->orderBy('cancellation_date', 'asc');
                break;
            case 'cancellation_date_desc':
                return $query->orderBy('cancellation_date', 'desc');
                break;
            case 'is_released_asc':
                return $query->orderBy('is_released', 'asc');
                break;
            case 'is_released_desc':
                return $query->orderBy('is_released', 'desc');
                break;

            //タレント管理
            case 'recruitment_status_asc':
                return $query->orderBy('recruitment_status', 'asc');
                break;
            case 'recruitment_status_desc':
                return $query->orderBy('recruitment_status', 'desc');
                break;
            case 'employment_status_asc':
                return $query->orderBy('employment_status', 'asc');
                break;
            case 'employment_status_desc':
                return $query->orderBy('employment_status', 'desc');
                break;
            case 'evaluation_status_asc':
                return $query->orderBy('evaluation_status', 'asc');
                break;
            case 'evaluation_status_desc':
                return $query->orderBy('evaluation_status', 'desc');
                break;
            case 'hourly_wage_asc':
                return $query->orderBy('hourly_wage', 'asc');
                break;
            case 'hourly_wage_desc':
                return $query->orderBy('hourly_wage', 'desc');
                break;
            case 'resignation_status_asc':
                return $query->orderBy('resignation_status', 'asc');
                break;
            case 'resignation_status_desc':
                return $query->orderBy('resignation_status', 'desc');
                break;

            //プロジェクト管理
            case 'release_status_asc':
                return $query->orderBy('release_status', 'asc');
                break;
            case 'release_status_desc':
                return $query->orderBy('release_status', 'desc');
                break;

            //リターン管理
            case 'price_asc':
                return $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                return $query->orderBy('price', 'desc');
                break;
            case 'delivery_date_asc':
                return $query->orderBy('delivery_date', 'asc');
                break;
            case 'delivery_date_desc':
                return $query->orderBy('delivery_date', 'desc');
                break;

            //活動報告管理
            case 'content_asc':
                return $query->orderBy('content', 'asc');
                break;
            case 'content_desc':
                return $query->orderBy('content', 'desc');
                break;

            //活動報告管理
            case 'selected_option_asc':
                return $query->orderBy('selected_option', 'asc');
                break;
            case 'selected_option_desc':
                return $query->orderBy('selected_option', 'desc');
                break;

            default:
                return;
                break;
        }
    }
}
