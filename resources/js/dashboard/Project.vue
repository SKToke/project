<template>
    <div class="position-relative">
        <div class="card-header">
            <i class="fa fa-list"></i>
            Project List
            <div class="card-header-actions p-0 m-0">
                <button @click="addNewProject()" class="btn btn-brand btn-sm btn-github" type="button"
                        v-if="!formView">
                    <span>Add New</span>
                </button>
                <button @click="viewAllProject()" class="btn btn-brand btn-sm btn-github" type="button" v-else>
                    <span>View All</span>
                </button>
            </div>
        </div>
        <div class="card-body" v-show="!formView">
            <table class="table table-responsive-sm table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="cursor: pointer;">Name</th>
                    <th style="cursor: pointer;">Description</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 145px">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in projectList" v-if="projectList.length > 0">
                    <td>{{ sl + index }}</td>
                    <td>{{ item.name }}</td>
                    <td v-html="item.description"></td>
                    <td class="text-capitalize">
                        <span class="badge badge-success" v-if="item.status == 'active'">{{ item.status }}</span>
                        <span class="badge badge-warning" v-else-if="item.status == 'inactive'">{{ item.status }}</span>
                        <span class="badge badge-danger" v-else>{{ item.status }}</span>
                    </td>
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
                <div class="col-lg-5 col-md-6 col-sm-8 col-xs-12">
                    <form class="form-horizontal" v-on:submit.prevent="onSubmit">
                        <div class="form-group row justify-content-center">
                            <h6 class="text-left col-sm-12">
                                <strong v-if="createView">Add New</strong>
                                <strong v-else>Update</strong>
                            </h6>
                        </div>
                        <div class="form-group">
                            <label class="c-label">Name
                                <small class="text-danger">*</small>
                            </label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-file-signature"></i>
                                    </span>
                                </div>
                                <input :class="[(errors.hasOwnProperty('name') ? 'is-invalid' : '')]"
                                       class="form-control form-control-sm rounded-0"
                                       placeholder="Enter Project Name" type="text" v-model="formData.name">
                                <div class="invalid-feedback" v-if="errors.hasOwnProperty('name')">
                                    {{ errors.name[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="c-label">Description</label>
                            <textarea :class="[(errors.hasOwnProperty('description') ? 'is-invalid' : '')]"
                                      class="form-control form-control-sm rounded-0"
                                      placeholder="Enter Description" cols="4"
                                      v-model="formData.description"></textarea>
                            <div class="invalid-feedback" v-if="errors.hasOwnProperty('description')">
                                {{ errors.description[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="c-label">Status<span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-arrow-circle-down"></i>
                                    </span>
                                </div>
                                <select
                                    v-model="formData.status"
                                    :class="[(errors.hasOwnProperty('status') ? 'is-invalid' : '')]"
                                    class="form-control form-control-sm rounded-0">
                                    <option value="">Select One</option>
                                    <option v-for="item in commonStatus" :value="item">
                                        {{ item | textCapitalize }}
                                    </option>
                                </select>
                                <div class="invalid-feedback" v-if="errors.hasOwnProperty('status')">
                                    {{ errors.status[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button v-if="createView" class="btn btn-sm btn-primary pull-right rounded-0" type="submit">
                                <i class="far fa-circle"></i>
                                Submit
                            </button>
                            <button v-else class="btn btn-sm btn-primary pull-right rounded-0" type="submit">
                                <i class="fas fa-save"></i>
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal-->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalTitle"
             aria-hidden="true">
            <div class=" modal modal-dialog modal-dialog-centered" role="document">
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
                                <tr v-if="chunk.name">
                                    <td style="width: 100px;">Name</td>
                                    <td style="width: 5px;">:</td>
                                    <td>{{ chunk.name }}</td>
                                </tr>
                                <tr v-if="chunk.description">
                                    <td>Description</td>
                                    <td>:</td>
                                    <td v-html="chunk.description"></td>
                                </tr>
                                <tr v-if="chunk.status">
                                    <td>Status</td>
                                    <td>:</td>
                                    <td class="text-capitalize">
                                        <span class="badge badge-success"
                                              v-if="chunk.status == 'active'">{{ chunk.status }}</span>
                                        <span class="badge badge-warning"
                                              v-else-if="chunk.status == 'inactive'">{{ chunk.status }}</span>
                                        <span class="badge badge-danger" v-else>{{ chunk.status }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-brand btn-sm rounded-0" data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Project.vue",
    data() {
        return {
            formView: false,
            createView: true,
            loading: false,
            allSelected: false,
            sl: 1,
            projectList: [],
            commonStatus: [],
            formData: {
                id: "",
                name: "",
                description: "",
            },
            chunk: {},
            errors: {},
            routes: window.appHelper.routes,
        }
    },
    methods: {
        onSubmit() {
            let _this = this;
            if (_this.createView) {
                _this.onAddProject();
            } else {
                _this.onUpdateProject();
            }
        },
        viewAllProject() {
            let _this = this;
            _this.formView = false;
            _this.createView = true;
            _this.getAll();
        },
        addNewProject() {
            let _this = this;
            _this.formData.name = "";
            _this.formData.description = "";
            _this.formData.status = "";
            _this.formView = true;
        },
        onAddProject() {
            let _this = this;
            _this.loading = true;
            _this.errors = {};
            axios.post(_this.routes.project, _this.formData)
                .then((res) => {
                    if (res.data.success) {
                        _this.getAll();
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
        onUpdateProject() {
            let _this = this;
            _this.loading = true;
            _this.errors = {};
            axios.put(_this.routes.project + "/" + _this.formData.id, _this.formData)
                .then((res) => {
                    if (res.data.success) {
                        _this.getAll();
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
        getAll() {
            let _this = this;
            _this.formView = false;
            _this.createView = true;
            _this.loading = true;
            _this.errors = {};
            axios.post(_this.routes.projectList)
                .then((res) => {
                    if (res.data) {
                        _this.projectList = res.data.list;
                        _this.commonStatus = res.data.commonStatus;
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
            axios.patch(_this.routes.project + "/" + id)
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
            axios.patch(_this.routes.project + "/" + id)
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
            axios.delete(_this.routes.project + "/" + id)
                .then((res) => {
                    if (res.data.success) {
                        Swal.fire(
                            'Deleted!',
                            res.data.success,
                            'success'
                        )
                        _this.getAll();
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
        this.getAll();
    },
    filters: {
        textCapitalize(value) {
            if (!value) return '';
            value = value.toString();
            return value.charAt(0).toUpperCase() + value.slice(1)
        }
    }
}
</script>

<style scoped>

</style>
