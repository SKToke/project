<template>
    <div class="position-relative">
        <div class="card-header">
            <i class="fa fa-list"></i>
            Project Details List
            <div class="card-header-actions p-0 m-0">
                <button @click="addNewProjectDetails()" class="btn btn-brand btn-sm btn-github" type="button"
                        v-if="!formView">
                    <span>Add New</span>
                </button>
                <button @click="viewAllProjectDetails()" class="btn btn-brand btn-sm btn-github" type="button" v-else>
                    <span>View All</span>
                </button>
            </div>
        </div>
        <div class="card-body" v-show="!formView">
            <table class="table table-responsive-sm table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Project</th>
                    <th>GRO Fund Transfer</th>
                    <th>Fund Position(automatic)</th>
                    <th>Outstanding</th>
                    <th>GRO Bank</th>
                    <th>Cash in Hand</th>
                    <th class="text-center" style="width: 145px">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in projectDetailList" v-if="projectDetailList.length > 0">
                    <td>{{ 1 + index }}</td>
                    <td>{{ item.project.name | textCapitalize }}</td>
                    <td>{{ item.gro_fund_transfer }}</td>
                    <td>{{ item.fund_position_automatic }}</td>
                    <td>{{ item.outstanding_amount }}</td>
                    <td>{{ item.amount_in_gro_bank }}</td>
                    <td>{{ item.cash_in_hand }}</td>
                    <td>
                        <button @click="onClickView(item.id)" class="btn btn-xs btn-dark rounded-0">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button @click="onClickEdit(item.id)" class="btn btn-xs btn-info rounded-0">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button @click="onClickDelete(item, item.id)" class="btn btn-xs btn-danger rounded-0">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body" v-show="formView">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <form class="form-horizontal" v-on:submit.prevent="onSubmit">
                        <div class="form-group row justify-content-center">
                            <h6 class="text-left col-sm-12">
                                <strong v-if="createView">Add New</strong>
                                <strong v-else>Update</strong>
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Project<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-arrow-circle-down"></i>
                                    </span>
                                        </div>
                                        <select
                                            v-model="formData.project_id"
                                            data-vv-name="project_id"
                                            data-vv-as="project_id"
                                            :class="[(errors.hasOwnProperty('project_id') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0">
                                            <option value="">Select One</option>
                                            <option v-for="item in projects" :value="item.id">
                                                {{ item.name | textCapitalize }}
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('project_id')">
                                            {{ errors.project_id[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">GRO Fund Transfer<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('gro_fund_transfer') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="gro fund transfer" type="text"
                                            v-model="formData.gro_fund_transfer">
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('gro_fund_transfer')">
                                            {{ errors.gro_fund_transfer[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Number of District Overed<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('number_of_districts') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="number of district" type="text"
                                            v-model="formData.number_of_districts">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('number_of_districts')">
                                            {{ errors.number_of_districts[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Amount Group Savings<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('amount_group_saving') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="amount group savings" type="text"
                                            v-model="formData.amount_group_saving">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('amount_group_saving')">
                                            {{ errors.amount_group_saving[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Amount Group Risk<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('amount_group_risk') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="amount group risk" type="text"
                                            v-model="formData.amount_group_risk">
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('amount_group_risk')">
                                            {{ errors.amount_group_risk[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Number of Upazila Overed<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('number_of_upazilas') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="number of upazila" type="text"
                                            v-model="formData.number_of_upazilas">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('number_of_upazilas')">
                                            {{ errors.number_of_upazilas[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Amount Group Profit<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('amount_group_profit') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="amount group profit" type="text"
                                            v-model="formData.amount_group_profit">
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('amount_group_risk')">
                                            {{ errors.amount_group_profit[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Bank Profit<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input :class="[(errors.hasOwnProperty('bank_profit') ? 'is-invalid' : '')]"
                                               class="form-control form-control-sm rounded-0"
                                               placeholder="bank profit" type="text" v-model="formData.bank_profit">
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('bank_profit')">
                                            {{ errors.bank_profit[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Number of Union Overed<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('number_of_unions') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="number of union" type="text"
                                            v-model="formData.number_of_unions">
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('number_of_unions')">
                                            {{ errors.number_of_unions[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Bank Charge<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input :class="[(errors.hasOwnProperty('bank_charge') ? 'is-invalid' : '')]"
                                               class="form-control form-control-sm rounded-0"
                                               placeholder="bank charge" type="text" v-model="formData.bank_charge">
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('bank_charge')">
                                            {{ errors.bank_charge[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Other Income<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input :class="[(errors.hasOwnProperty('other_income') ? 'is-invalid' : '')]"
                                               class="form-control form-control-sm rounded-0"
                                               placeholder="other income" type="text" v-model="formData.other_income">
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('other_income')">
                                            {{ errors.other_income[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Number of Village Overed<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('number_of_villages') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="number of village" type="text"
                                            v-model="formData.number_of_villages">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('number_of_villages')">
                                            {{ errors.number_of_villages[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">GRO & Other Cost<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('gro_and_other_cost') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="gro management and other cost" type="text"
                                            v-model="formData.gro_and_other_cost">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('gro_and_other_cost')">
                                            {{ errors.gro_and_other_cost[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Fund Position (automatic)<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('fund_position_automatic') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="fund position automatic" type="text"
                                            v-model="formData.fund_position_automatic">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('fund_position_automatic')">
                                            {{ errors.fund_position_automatic[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Number of Households Overed<small
                                        class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('number_of_households') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="number of households" type="text"
                                            v-model="formData.number_of_households">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('number_of_households')">
                                            {{ errors.number_of_households[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Outstanding Amount<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('outstanding_amount') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="outstanding amount" type="text"
                                            v-model="formData.outstanding_amount">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('outstanding_amount')">
                                            {{ errors.outstanding_amount[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Amount in GRO Bank<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('amount_in_gro_bank') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="amount in gro bank" type="text"
                                            v-model="formData.amount_in_gro_bank">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('amount_in_gro_bank')">
                                            {{ errors.amount_in_gro_bank[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="c-label">Number of Population Overed<small
                                        class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input
                                            :class="[(errors.hasOwnProperty('number_of_populations') ? 'is-invalid' : '')]"
                                            class="form-control form-control-sm rounded-0"
                                            placeholder="number of population" type="text"
                                            v-model="formData.number_of_populations">
                                        <div class="invalid-feedback"
                                             v-if="errors.hasOwnProperty('number_of_populations')">
                                            {{ errors.number_of_populations[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-10 col-sm-8">
                                <div class="form-group">
                                    <label class="c-label">Cash in Hand<small class="text-danger">*</small>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                        </div>
                                        <input :class="[(errors.hasOwnProperty('cash_in_hand') ? 'is-invalid' : '')]"
                                               class="form-control form-control-sm rounded-0"
                                               placeholder="amount" type="text" v-model="formData.cash_in_hand">
                                        <div class="invalid-feedback" v-if="errors.hasOwnProperty('cash_in_hand')">
                                            {{ errors.cash_in_hand[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-2 col-sm-4">
                                <div class="form-group mt-4 fa-pull-right">
                                    <button v-if="createView" class="btn btn-sm btn-primary pull-right rounded-0"
                                            type="submit">
                                        <i class="fas fa-save"></i>
                                        Submit
                                    </button>
                                    <button v-else class="btn btn-sm btn-primary pull-right rounded-0" type="submit">
                                        <i class="fa fa-circle"></i>
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal-->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div v-if="chunk" class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalCenterTitle">Project Details</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <tr v-if="chunk.project_id">
                                    <td style="width: 100px;">Project Name</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.project.name | textCapitalize }}</td>
                                </tr>
                                <tr v-if="chunk.gro_fund_transfer">
                                    <td style="width: 130px;">GRO Fund Transfer</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.gro_fund_transfer }}</td>
                                </tr>
                                <tr v-if="chunk.amount_group_saving">
                                    <td style="width: 155px;">Amount Group Savings</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.amount_group_saving }}</td>
                                </tr>
                                <tr v-if="chunk.amount_group_risk">
                                    <td style="width: 100px;">Amount Group Risk</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.amount_group_risk }}</td>
                                </tr>
                                <tr v-if="chunk.amount_group_profit">
                                    <td style="width: 100px;">Amount Group Profit</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.amount_group_profit }}</td>
                                </tr>
                                <tr v-if="chunk.bank_profit">
                                    <td style="width: 100px;">Bank Profit</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.bank_profit }}</td>
                                </tr>
                                <tr v-if="chunk.bank_charge">
                                    <td style="width: 100px;">Bank Charge</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.bank_charge }}</td>
                                </tr>
                                <tr v-if="chunk.other_income">
                                    <td style="width: 100px;">Other Income</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.other_income }}</td>
                                </tr>
                                <tr v-if="chunk.gro_and_other_cost">
                                    <td style="width: 100px;">GRO & Others Cost</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.gro_and_other_cost }}</td>
                                </tr>
                                <tr v-if="chunk.fund_position_automatic">
                                    <td style="width: 170px;">Fund Position (automatic)</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.fund_position_automatic }}</td>
                                </tr>
                                <tr v-if="chunk.outstanding_amount">
                                    <td style="width: 100px;">Outstanding Amount</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.outstanding_amount }}</td>
                                </tr>
                                <tr v-if="chunk.amount_in_gro_bank">
                                    <td style="width: 100px;">Amount in GRO Bank</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.amount_in_gro_bank }}</td>
                                </tr>
                                <tr v-if="chunk.cash_in_hand">
                                    <td style="width: 100px;">Cash in Hand</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.cash_in_hand }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-brand btn-sm rounded-0" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "ProjectDetails.vue",
    data() {
        return {
            formView: false,
            createView: true,
            formData: {
                id: "",
                project_id: "",
                gro_fund_transfer: "",
                amount_group_saving: "",
                amount_group_risk: "",
                amount_group_profit: "",
                bank_profit: "",
                bank_charge: "",
                other_income: "",
                gro_and_other_cost: "",
                fund_position_automatic: "",
                outstanding_amount: "",
                amount_in_gro_bank: "",
                cash_in_hand: "",
                number_of_districts: "",
                number_of_upazilas: "",
                number_of_unions: "",
                number_of_villages: "",
                number_of_households: "",
                number_of_populations: "",
            },
            chunk: {},
            projectDetailList: [],
            projects: [],
            errors: {},
            routes: window.appHelper.routes,
        }
    },
    methods: {
        onSubmit() {
            let _this = this;
            if (_this.createView) {
                _this.onAddProjectDetails();
            } else {
                _this.onUpdateProjectDetails();
            }
        },
        viewAllProjectDetails() {
            let _this = this;
            _this.formView = false;
            _this.createView = true;
            _this.projectDetailsInitialData();
        },
        addNewProjectDetails() {
            let _this = this;
            _this.formData.project_id = "";
            _this.formData.gro_fund_transfer = "";
            _this.formData.amount_group_saving = "";
            _this.formData.amount_group_risk = "";
            _this.formData.amount_group_profit = "";
            _this.formData.bank_profit = "";
            _this.formData.bank_charge = "";
            _this.formData.other_income = "";
            _this.formData.gro_and_other_cost = "";
            _this.formData.fund_position_automatic = "";
            _this.formData.outstanding_amount = "";
            _this.formData.amount_in_gro_bank = "";
            _this.formData.cash_in_hand = "";
            _this.formData.number_of_districts = "";
            _this.formData.number_of_upazilas = "";
            _this.formData.number_of_unions = "";
            _this.formData.number_of_villages = "";
            _this.formData.number_of_households = "";
            _this.formData.number_of_populations = "";
            _this.formView = true;
        },
        onAddProjectDetails() {
            let _this = this;
            _this.loading = true;
            _this.errors = {};
            axios.post(_this.routes.projectDetails, _this.formData)
                .then((res) => {
                    if (res.data.success) {
                        _this.formView = false;
                        _this.projectDetailsInitialData();
                        toastr.success(res.data.success, "Success");
                    } else {
                        _this.loading = false;
                        toastr.error(res.data.message, "Warning");
                    }
                }).catch((err) => {
                toastr.error(err.response.data.message, "Error");
                if (err.response && err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                }
                _this.loading = false;
            });
        },
        projectDetailsInitialData() {
            let _this = this;
            _this.loading = true;
            _this.errors = {};
            axios.post(_this.routes.projectDetailsList)
                .then((res) => {
                    if (res.data) {
                        _this.projectDetailList = res.data.list;
                        _this.projects = res.data.projects;
                    } else {
                        toastr.error(res.data.message, "Warning");
                    }
                    _this.loading = false;
                }).catch((err) => {
                toastr.error(err.response.data.message, "Error");
                if (err.response && err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                }
                _this.loading = false;
            });
        },
        onClickView(id) {
            let _this = this;
            _this.loading = true;
            _this.errors = {};
            axios.patch(_this.routes.projectDetails + "/" + id)
                .then((res) => {
                    if (res.data) {
                        _this.chunk = res.data;
                        $("#viewModal").modal({
                            show: true,
                            backdrop: "static"
                        });
                    } else {
                        toastr.error(res.data.message, "Warning");
                    }
                    _this.loading = false;
                }).catch((err) => {
                toastr.error(err.response.data.message, "Error");
                if (err.response && err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                }
                _this.loading = false;
            });
        },
        onClickEdit(id) {
            let _this = this;
            _this.formView = false;
            _this.loading = true;
            _this.errors = {};
            axios.patch(_this.routes.projectDetails + "/" + id)
                .then((res) => {
                    _this.loading = false;
                    if (res.data) {
                        _this.formData = res.data;
                        _this.formView = true;
                        _this.createView = false;
                    } else {
                        toastr.error(res.data.message, "Warning");
                    }
                }).catch((err) => {
                toastr.error(err.response.data.message, "Error");
                if (err.response && err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                }
                _this.loading = false;
            });
        },
        onUpdateProjectDetails() {
            let _this = this;
            _this.loading = true;
            _this.errors = {};
            axios.put(_this.routes.projectDetails + "/" + _this.formData.id, _this.formData)
                .then((res) => {
                    if (res.data.success) {
                        _this.formView = false;
                        _this.projectDetailsInitialData();
                        toastr.success(res.data.success, "Success");
                    } else {
                        _this.loading = false;
                        toastr.error(res.data.message, "Warning");
                    }
                }).catch((err) => {
                toastr.error(err.response.data.message, "Error");
                if (err.response && err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                }
                _this.loading = false;
            });
        },
        onClickDelete(item, id) {
            let _this = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    _this.onDeleteRequest(id);
                }
            })
        },
        onDeleteRequest(id) {
            let _this = this;
            _this.loading = true;
            _this.errors = {};
            axios.delete(_this.routes.projectDetails + "/" + id)
                .then((res) => {
                    if (res.data.success) {
                        Swal.fire(
                            'Deleted!',
                            res.data.success,
                            'success'
                        )
                        _this.projectDetailsInitialData();
                    } else {
                        toastr.error(res.data.message, "Warning");
                        _this.loading = false;
                    }
                }).catch((err) => {
                toastr.error(err.response.data.message, "Error");
                if (err.response && err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                }
                _this.loading = false;
            });
        }
    },
    created() {
        let _this = this;
        _this.projectDetailsInitialData();
    },
    filters: {
        textCapitalize(value) {
            if (!value) return '';
            value = value.toString();
            return value.charAt(0).toUpperCase() + value.slice(1)
        },
    }
}
</script>

<style scoped>

</style>
