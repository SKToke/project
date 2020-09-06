<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectDetailsController extends Controller
{
    public function index()
    {
        return view('project-details');
    }

    public function calculateById(Request $request)
    {
        $search = $request->post('projectId');

        $ids = (array)$search;
        if ($search == 'all') {
            $ids = Project::select('id', 'status')->where('status', '=', 'active')->pluck('id');
        }

        $sql = "SUM(gro_fund_transfer) as gro_fund_transfer,SUM(fund_position_automatic) as fund_position_automatic,
            SUM(outstanding_amount) as outstanding_amount,SUM(amount_in_gro_bank) as amount_in_gro_bank,
            SUM(cash_in_hand) as cash_in_hand,SUM(number_of_districts) as districts,SUM(number_of_upazilas) as upazilas,
            SUM(number_of_unions) as unions,SUM(number_of_villages) as villages,SUM(number_of_households) as households,
            SUM(number_of_populations) as populations,SUM(amount_group_saving+amount_group_risk) as savings,
            ((SUM(amount_group_profit)+SUM(bank_profit)+SUM(other_income))-(SUM(other_income)+SUM(gro_and_other_cost))) as profit";

        $details = ProjectDetails::select(DB::raw($sql))->whereIn('project_id', $ids)->first();

        return response()->json($details);

        /*$search = $request->post('projectId');

        if ($search == 'all') {
            $ids = Project::select('id', 'status')->where('status', '=', 'active')->pluck('id');
        } else {
            $ids = (array)$search;
        }

        $sql = "SUM(gro_fund_transfer) as gro_fund_transfer,SUM(fund_position_automatic) as fund_position_automatic,
            SUM(outstanding_amount) as outstanding_amount,SUM(amount_in_gro_bank) as amount_in_gro_bank,
            SUM(cash_in_hand) as cash_in_hand,SUM(number_of_districts) as districts,SUM(number_of_upazilas) as upazilas,
            SUM(number_of_unions) as unions,SUM(number_of_villages) as villages,SUM(number_of_households) as households,
            SUM(number_of_populations) as populations,SUM(amount_group_saving+amount_group_risk) as savings,
            ((SUM(amount_group_profit)+SUM(bank_profit)+SUM(other_income))-(SUM(other_income)+SUM(gro_and_other_cost))) as profit";

        $details = ProjectDetails::select(DB::raw($sql))->whereIn('project_id', $ids)->first();

        return response()->json($details);*/

        /*if ($search == 'all') {
            $ids = Project::select('id', 'status')->where('status', '=', 'active')->pluck('id');
        } else {
            $ids = (array)$search;
        }

        $sql = "SUM(gro_fund_transfer) as gro_fund_transfer,SUM(fund_position_automatic) as fund_position_automatic,
            SUM(outstanding_amount) as outstanding_amount,SUM(amount_in_gro_bank) as amount_in_gro_bank,
            SUM(cash_in_hand) as cash_in_hand,SUM(number_of_districts) as districts,SUM(number_of_upazilas) as upazilas,
            SUM(number_of_unions) as unions,SUM(number_of_villages) as villages,SUM(number_of_households) as households,
            SUM(number_of_populations) as populations,SUM(amount_group_saving+amount_group_risk) as savings,
            ((SUM(amount_group_profit)+SUM(bank_profit)+SUM(other_income))-(SUM(other_income)+SUM(gro_and_other_cost))) as profit";
        $details = ProjectDetails::select(DB::raw($sql))->whereIn('project_id', $ids)->first();

        $data['gro_fund_transfer'] = $details->gro_fund_transfer;
        $data['fund_position_automatic'] = $details->fund_position_automatic;
        $data['outstanding_amount'] = $details->outstanding_amount;
        $data['amount_in_gro_bank'] = $details->amount_in_gro_bank;
        $data['savings'] = $details->savings;
        $data['profit'] = $details->profit;
        $data['cash_in_hand'] = $details->cash_in_hand;
        $data['districts'] = $details->number_of_districts;
        $data['upazilas'] = $details->number_of_upazilas;
        $data['unions'] = $details->number_of_unions;
        $data['villages'] = $details->number_of_villages;
        $data['households'] = $details->number_of_households;
        $data['populations'] = $details->number_of_populations;

        return response()->json($data);*/

        /*if ($search == 'all') {

            $sql = "SUM(gro_fund_transfer) as gro_fund_transfer,SUM(fund_position_automatic) as fund_position_automatic,
            SUM(outstanding_amount) as outstanding_amount,SUM(amount_in_gro_bank) as amount_in_gro_bank,
            SUM(cash_in_hand) as cash_in_hand,SUM(number_of_districts) as districts,SUM(number_of_upazilas) as upazilas,
            SUM(number_of_unions) as unions,SUM(number_of_villages) as villages,SUM(number_of_households) as households,
            SUM(number_of_populations) as populations,SUM(amount_group_saving+amount_group_risk) as savings,
            ((SUM(amount_group_profit)+SUM(bank_profit)+SUM(other_income))-(SUM(other_income)+SUM(gro_and_other_cost))) as profit";

            $ids = Project::select('id', 'status')->where('status', '=', 'active')->pluck('id');
            $details = ProjectDetails::select(DB::raw($sql))->whereIn('project_id', $ids)->first();
            $data['savings'] = $details->savings;
            $data['profit'] = $details->profit;
        } else {

            $details = ProjectDetails::where('project_id', '=', $search)->first();
            $data['savings'] = $details->amount_group_saving + $details->amount_group_risk;
            $data['profit'] = ($details->amount_group_profit + $details->bank_profit + $details->other_income) - ($details->bank_charge + $details->gro_and_other_cost);
        }
        $data['gro_fund_transfer'] = $details->gro_fund_transfer;
        $data['fund_position_automatic'] = $details->fund_position_automatic;
        $data['outstanding_amount'] = $details->outstanding_amount;
        $data['amount_in_gro_bank'] = $details->amount_in_gro_bank;
        $data['cash_in_hand'] = $details->cash_in_hand;
        $data['districts'] = $details->number_of_districts;
        $data['upazilas'] = $details->number_of_upazilas;
        $data['unions'] = $details->number_of_unions;
        $data['villages'] = $details->number_of_villages;
        $data['households'] = $details->number_of_households;
        $data['populations'] = $details->number_of_populations;

        return response()->json($data);*/
    }

    public function getList()
    {
        $projects = Project::select('id', 'name', 'status')
            ->where('status', '=', 'active')
            ->get();
        $list = ProjectDetails::with([
            'project' => function ($sql) {
                $sql->select('id', 'name');
            }
        ])
            ->select('*')
            ->get();

        return response()->json([
            'list' => $list,
            'projects' => $projects
        ]);
    }

    public function getProjectDetailsById($id)
    {
        $data = ProjectDetails::with('project')->findOrfail($id);
        return response()->json($data);
    }

    public function createProjectDetails(Request $request)
    {
        $request->validate([
            "project_id" => 'required|numeric|exists:projects,id',
            'gro_fund_transfer' => 'required|numeric|between:0,9999999999.99',
            'amount_group_saving' => 'required|numeric|between:0,9999999999.99',
            'amount_group_risk' => 'required|numeric|between:0,9999999999.99',
            'amount_group_profit' => 'required|numeric|between:0,9999999999.99',
            'bank_profit' => 'required|numeric|between:0,9999999999.99',
            'bank_charge' => 'required|numeric|between:0,9999999999.99',
            'other_income' => 'required|numeric|between:0,9999999999.99',
            'gro_and_other_cost' => 'required|numeric|between:0,9999999999.99',
            'fund_position_automatic' => 'required|numeric|between:0,9999999999.99',
            'outstanding_amount' => 'required|numeric|between:0,9999999999.99',
            'amount_in_gro_bank' => 'required|numeric|between:0,9999999999.99',
            'cash_in_hand' => 'required|numeric|between:0,9999999999.99',
            'number_of_districts' => 'required|numeric|between:0,9999999999.99',
            'number_of_upazilas' => 'required|numeric|between:0,9999999999.99',
            'number_of_unions' => 'required|numeric|between:0,9999999999.99',
            'number_of_villages' => 'required|numeric|between:0,9999999999.99',
            'number_of_households' => 'required|numeric|between:0,9999999999.99',
            'number_of_populations' => 'required|numeric|between:0,999999999999999.99',
        ]);

        ProjectDetails::create([
            'project_id' => $request->post('project_id'),
            'gro_fund_transfer' => $request->post('gro_fund_transfer'),
            'amount_group_saving' => $request->post('amount_group_saving'),
            'amount_group_risk' => $request->post('amount_group_risk'),
            'amount_group_profit' => $request->post('amount_group_profit'),
            'bank_profit' => $request->post('bank_profit'),
            'bank_charge' => $request->post('bank_charge'),
            'other_income' => $request->post('other_income'),
            'gro_and_other_cost' => $request->post('gro_and_other_cost'),
            'fund_position_automatic' => $request->post('fund_position_automatic'),
            'outstanding_amount' => $request->post('outstanding_amount'),
            'amount_in_gro_bank' => $request->post('amount_in_gro_bank'),
            'cash_in_hand' => $request->post('cash_in_hand'),
            'number_of_districts' => $request->post('number_of_districts'),
            'number_of_upazilas' => $request->post('number_of_upazilas'),
            'number_of_unions' => $request->post('number_of_unions'),
            'number_of_villages' => $request->post('number_of_villages'),
            'number_of_households' => $request->post('number_of_households'),
            'number_of_populations' => $request->post('number_of_populations'),
        ]);

        return response()->json([
            "success" => "Project Details has been successfully created."
        ]);
    }

    public function updateProjectDetails(Request $request, $id)
    {
        $request->validate([
            "project_id" => 'required|numeric|exists:projects,id',
            'gro_fund_transfer' => 'required|numeric|between:0,9999999999.99',
            'amount_group_saving' => 'required|numeric|between:0,9999999999.99',
            'amount_group_risk' => 'required|numeric|between:0,9999999999.99',
            'amount_group_profit' => 'required|numeric|between:0,9999999999.99',
            'bank_profit' => 'required|numeric|between:0,9999999999.99',
            'bank_charge' => 'required|numeric|between:0,9999999999.99',
            'other_income' => 'required|numeric|between:0,9999999999.99',
            'gro_and_other_cost' => 'required|numeric|between:0,9999999999.99',
            'fund_position_automatic' => 'required|numeric|between:0,9999999999.99',
            'outstanding_amount' => 'required|numeric|between:0,9999999999.99',
            'amount_in_gro_bank' => 'required|numeric|between:0,9999999999.99',
            'cash_in_hand' => 'required|numeric|between:0,9999999999.99',
            'number_of_districts' => 'required|numeric|between:0,9999999999.99',
            'number_of_upazilas' => 'required|numeric|between:0,9999999999.99',
            'number_of_unions' => 'required|numeric|between:0,9999999999.99',
            'number_of_villages' => 'required|numeric|between:0,9999999999.99',
            'number_of_households' => 'required|numeric|between:0,9999999999.99',
            'number_of_populations' => 'required|numeric|between:0,999999999999999.99',
        ]);

        $data = ProjectDetails::findOrfail($id);
        $data->project_id = $request->get("project_id");
        $data->gro_fund_transfer = $request->get("gro_fund_transfer");
        $data->amount_group_saving = $request->get("amount_group_saving");
        $data->amount_group_risk = $request->get("amount_group_risk");
        $data->amount_group_profit = $request->get("amount_group_profit");
        $data->bank_profit = $request->get("bank_profit");
        $data->bank_charge = $request->get("bank_charge");
        $data->other_income = $request->get("other_income");
        $data->gro_and_other_cost = $request->get("gro_and_other_cost");
        $data->fund_position_automatic = $request->get("fund_position_automatic");
        $data->outstanding_amount = $request->get("outstanding_amount");
        $data->amount_in_gro_bank = $request->get("amount_in_gro_bank");
        $data->cash_in_hand = $request->get("cash_in_hand");
        $data->number_of_districts = $request->get("number_of_districts");
        $data->number_of_upazilas = $request->get("number_of_upazilas");
        $data->number_of_unions = $request->get("number_of_unions");
        $data->number_of_villages = $request->get("number_of_villages");
        $data->number_of_households = $request->get("number_of_households");
        $data->number_of_populations = $request->get("number_of_populations");
        $data->save();

        return response()->json([
            "success" => "Project Details has been successfully Updated."
        ]);

    }

    public function deleteProjectDetails($id)
    {
        $data = ProjectDetails::findOrfail($id);
        $data->delete();

        return response()->json([
            "success" => "Project Details has been successfully Deleted."
        ]);
    }
}
