<template>
    <div>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-gradient-success">
                    <div class="card-body pb-0">
                        <div class="text-value-lg" v-if="outputRes.gro_fund_transfer">{{
                                outputRes.gro_fund_transfer | roundNumber
                            }}
                        </div>
                        <div class="text-value-lg" v-else>0</div>
                        <div>GRO Fund Transfer</div>
                        <div class="mt-3 mx-3" style="height:10px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="card text-white bg-gradient-danger">
                    <div class="card-body pb-0 py-1">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item py-1">Number of District covered:
                                        <span class="font-weight-bold"
                                              v-if="outputRes.districts">{{ outputRes.districts | roundNumber }}</span>
                                        <span class="font-weight-bold" v-else>0</span>
                                    </li>
                                    <li class="list-group-item py-1">Number of Upazila covered:
                                        <span class="font-weight-bold"
                                              v-if="outputRes.upazilas">{{ outputRes.upazilas | roundNumber }}</span>
                                        <span class="font-weight-bold" v-else>0</span>
                                    </li>
                                    <li class="list-group-item py-1">Number of Union covered:
                                        <span class="font-weight-bold"
                                              v-if="outputRes.unions">{{ outputRes.unions | roundNumber }}</span>
                                        <span class="font-weight-bold" v-else>0</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-md-6 col-sm-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item py-1">Number of Village covered:
                                        <span class="font-weight-bold"
                                              v-if="outputRes.villages">{{ outputRes.villages | roundNumber }}</span>
                                        <span class="font-weight-bold" v-else>0</span>
                                    </li>
                                    <li class="list-group-item py-1">Number of Households covered:
                                        <span class="font-weight-bold"
                                              v-if="outputRes.households">{{
                                                outputRes.households | roundNumber
                                            }}</span>
                                        <span class="font-weight-bold" v-else>0</span>
                                    </li>
                                    <li class="list-group-item py-1">Number of Population covered:
                                        <span class="font-weight-bold"
                                              v-if="outputRes.populations">{{
                                                outputRes.populations | roundNumber
                                            }}</span>
                                        <span class="font-weight-bold" v-else>0</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div style="height:3px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <select
                    v-model="formData.projectId"
                    @change="onSelectProject()"
                    class="form-control form-control-sm rounded-0">
                    <option value="">Select One</option>
                    <option value="all">All Projects</option>
                    <option v-for="item in projects"
                            :value="item.id">
                        {{ item.name | textCapitalize }}
                    </option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-gradient-info">
                    <div class="card-body pb-0">
                        <div class="text-value-lg" v-if="outputRes.savings">{{ outputRes.savings | roundNumber }}</div>
                        <div class="text-value-lg" v-else>0</div>
                        <div>Savings</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height:10px;">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-gradient-warning">
                    <div class="card-body pb-0">
                        <div class="text-value-lg" v-if="outputRes.profit">{{ outputRes.profit | roundNumber }}</div>
                        <div class="text-value-lg" v-else>0</div>
                        <div>Profit</div>
                    </div>
                    <div class="chart-wrapper mt-3" style="height:10px;">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-gradient-success">
                    <div class="card-body pb-0">
                        <div class="text-value-lg" v-if="outputRes.fund_position_automatic">
                            {{ outputRes.fund_position_automatic | roundNumber }}
                        </div>
                        <div class="text-value-lg" v-else>0</div>
                        <div>Fund Position</div>
                    </div>
                    <div class="chart-wrapper mt-3" style="height:10px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-gradient-warning">
                    <div class="card-body pb-0">
                        <div class="text-value-lg" v-if="outputRes.outstanding_amount">{{
                                outputRes.outstanding_amount | roundNumber
                            }}
                        </div>
                        <div class="text-value-lg" v-else>0</div>
                        <div>Investment Outstanding</div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:10px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-gradient-success">
                    <div class="card-body pb-0">
                        <div class="text-value-lg" v-if="outputRes.amount_in_gro_bank">{{
                                outputRes.amount_in_gro_bank | roundNumber
                            }}
                        </div>
                        <div class="text-value-lg" v-else>0</div>
                        <div>Bank Deposit</div>
                    </div>
                    <div class="chart-wrapper mt-3 mx-3" style="height:10px;">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-gradient-info">
                    <div class="card-body pb-0">
                        <div class="text-value-lg" v-if="outputRes.cash_in_hand">{{
                                outputRes.cash_in_hand | roundNumber
                            }}
                        </div>
                        <div class="text-value-lg" v-else>0</div>
                        <div>Cash In Hand</div>
                    </div>
                    <div class="chart-wrapper mt-3" style="height:10px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Dashboard.vue",
    data() {
        return {
            errors: {},
            outputRes: {},
            projects: [],
            formData: {
                projectId: '',
            },
            routes: window.appHelper.routes
        }
    },
    methods: {
        onSelectProject() {
            let _this = this;
            _this.errors = {};
            if (!_this.formData.projectId == '') {
                axios.post(_this.routes.project, _this.formData)
                    .then((res) => {
                        if (res.data) {
                            _this.outputRes = res.data;
                        } else {
                            toastr.error(res.data.message, "Warning");
                        }
                        _this.loading = false;
                    })
                    .catch((err) => {
                        toastr.error(err.response.data.message, "Error");
                        if (err.response && err.response.data.errors) {
                            _this.errors = err.response.data.errors;
                        }
                        _this.loading = false;
                    });
            } else {
                _this.outputRes = {};
            }
        },
        getInitialData() {
            let _this = this;
            _this.errors = {};
            axios.post(_this.routes.initial)
                .then((res) => {
                    if (res.data) {
                        _this.projects = res.data.projects;
                        _this.formData.projectId = '';
                    } else {
                        toastr.error(res.data.message, "Warning");
                    }
                    _this.loading = false;
                })
                .catch((err) => {
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
        _this.getInitialData();
    },
    filters: {
        roundNumber(value) {
            return +value;
        },
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
