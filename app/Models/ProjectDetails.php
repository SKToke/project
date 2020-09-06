<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
    protected $fillable = [
        'id',
        'project_id',
        'gro_fund_transfer',
        'amount_group_saving',
        'amount_group_risk',
        'amount_group_profit',
        'bank_profit',
        'other_income',
        'other_income',
        'gro_and_other_cost',
        'fund_position_automatic',
        'outstanding_amount',
        'amount_in_gro_bank',
        'cash_in_hand',
        'number_of_districts',
        'number_of_upazilas',
        'number_of_unions',
        'number_of_villages',
        'number_of_households',
        'number_of_populations',
    ];

    public function getGroFundTransferAttribute($value)
    {
        return $value + 0;
    }

    public function getAmountGroupSavingAttribute($value)
    {
        return $value + 0;
    }

    public function getAmountGroupRiskAttribute($value)
    {
        return $value + 0;
    }

    public function getAmountGroupProfitAttribute($value)
    {
        return $value + 0;
    }

    public function getBankProfitAttribute($value)
    {
        return $value + 0;
    }

    public function getBankChargeAttribute($value)
    {
        return $value + 0;
    }

    public function getOtherIncomeAttribute($value)
    {
        return $value + 0;
    }

    public function getGroAndOtherCostAttribute($value)
    {
        return $value + 0;
    }

    public function getFundPositionAutomaticAttribute($value)
    {
        return $value + 0;
    }

    public function getOutstandingAmountAttribute($value)
    {
        return $value + 0;
    }

    public function getAmountInGroBankAttribute($value)
    {
        return $value + 0;
    }

    public function getCashInHandAttribute($value)
    {
        return $value + 0;
    }

    public function getNumberOfDistrictsAttribute($value)
    {
        return $value + 0;
    }

    public function getNumberOfUpazilasAttribute($value)
    {
        return $value + 0;
    }

    public function getNumberOfUnionsAttribute($value)
    {
        return $value + 0;
    }

    public function getNumberOfVillagesAttribute($value)
    {
        return $value + 0;
    }

    public function getNumberOfHouseholdsAttribute($value)
    {
        return $value + 0;
    }

    public function getNumberOfPopulationsAttribute($value)
    {
        return $value + 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }
}
