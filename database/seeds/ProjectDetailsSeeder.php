<?php

use App\Models\ProjectDetails;
use Illuminate\Database\Seeder;

class ProjectDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gro_fund_transfer = [10000000, 12000000, 10000000, 16200000, 5100000, 10200000, 6000000, 10200000, 5000000, 5000000];
        $amount_group_saving = [2722471, 2238534, 1766681, 4311952, 1551031, 2467012, 1577455, 2370120, 2073370, 2322850];
        $amount_group_profit = [1540180, 1789245, 0, 1156130, 411060, 896100, 194470, 0, 0, 0];
        $bank_profit = [493545, 591177, 197039, 575350, 133257, 314382, 279084, 212120, 150991, 85916];
        $bank_charge = [145402, 199117, 16801, 154570, 76781, 97562, 69012, 68958, 25980, 41138];
        $other_income = [0, 34894, 0, 238, 516, 0, 29164, 0, 18510, 15840];
        $gro_and_other_cost = [0, 178067, 41, 0, 8510, 50644, 29441, 35940, 15080, 0];
        $fund_position_automatic = [14610794, 16276666, 11946878, 22089100, 7115217, 13729288, 7881720, 12667342, 7201811, 7383468];
        $outstanding_amount = [7309550, 9716157, 5311275, 7954343, 4805090, 7599750, 4638800, 8198700, 5290500, 5475000];
        $amount_in_gro_bank = [7101244, 6554957, 6652412, 14083175, 2308477, 6129527, 3339410, 4383672, 1897021, 1907468];
        $cash_in_hand = [0, 0, 180, 25385, 1650, 11, 3510, 1200, 14290, 1000];
        $number_of_districts = [1, 1, 1, 1, 1, 1, 1, 1, 1, 0];
        $number_of_upazilas = [1, 1, 1, 1, 1, 1, 1, 2, 1, 1];
        $number_of_unions = [2, 1, 1, 1, 1, 1, 2, 2, 1, 1];
        $number_of_villages = [13, 6, 8, 6, 8, 5, 4, 8, 6, 14];
        $number_of_households = [500, 450, 600, 555, 3256, 145, 452, 365, 754, 485];
        $number_of_populations = [1900, 1850, 2405, 2563, 4201, 1250, 3542, 6587, 4562, 1355];

        for ($i = 0; $i < 10; $i++) {
            ProjectDetails::create([
                'project_id' => 1 + $i,
                'gro_fund_transfer' => $gro_fund_transfer[$i],
                'amount_group_saving' => $amount_group_saving[$i],
                'amount_group_risk' => 0,
                'amount_group_profit' => $amount_group_profit[$i],
                'bank_profit' => $bank_profit[$i],
                'bank_charge' => $bank_charge[$i],
                'other_income' => $other_income[$i],
                'gro_and_other_cost' => $gro_and_other_cost[$i],
                'fund_position_automatic' => $fund_position_automatic[$i],
                'outstanding_amount' => $outstanding_amount[$i],
                'amount_in_gro_bank' => $amount_in_gro_bank[$i],
                'cash_in_hand' => $cash_in_hand[$i],
                'number_of_districts' => $number_of_districts[$i],
                'number_of_upazilas' => $number_of_upazilas[$i],
                'number_of_unions' => $number_of_unions[$i],
                'number_of_villages' => $number_of_villages[$i],
                'number_of_households' => $number_of_households[$i],
                'number_of_populations' => $number_of_populations[$i],
            ]);
        }
    }
}
