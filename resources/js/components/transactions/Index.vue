<template>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-11">
                                PROPERTY TYPES
                            </div>
                            <div class="col-md-1">
                                <a href="#" @click.prevent="showItem"><i class="fa fa-plus"></i></a>
                            </div>                                                     
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Type</th>
                                    <th>Properties</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in property_types.data" :key="d.property_type_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateItem(d)" >{{d.property_type_name}}</a> </td>
                                    <td>{{d.all_units}}</td>
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="property_types" @pagination-change-page="getResults"></pagination>
                    </div>                   
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-11">
                                UTILITIES / SERVICE CHARGES
                            </div>
                            <div class="col-md-1">
                                <a href="#" @click.prevent="showUtility"><i class="fa fa-plus"></i></a>
                            </div>                                                     
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Utility</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in utilities.data" :key="d.utility_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateModal(d)" >{{d.utility_name}}</a> </td>
                                    <td>{{d.billable}}</td>
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="property_types" @pagination-change-page="getResults"></pagination>
                    </div>                   
                </div>
            </div>
        </div>    
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-type" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="this.edit_mode == false">CREATE</h4>
                            <h4 class="modal-title" v-if="this.edit_mode == true">EDIT</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="this.edit_mode ? updatePropertyType() : createPropertyType()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Property Type Information</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Type Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.property_type_name" name="property_type_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('property_type_name') }">
                                            <has-error :form="form" field="property_type_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.type_notes" name="type_notes" id="type_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('type_notes') }"></textarea>
                                            <has-error :form="form" field="type_notes"></has-error>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" @click.prevent="edit_mode ? updatePropertyType() : createPropertyType()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
                                <a href="#" class="btn btn-sm btn-flat btn-warning" v-show="this.form.completed == 1">TRIP COMPLETED</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
         <!-- end of modal-->

          <!-- modal window for creating utilities --> 
           <div class="modal fade show" id="modal-utility" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="this.edit_mode == false">CREATE</h4>
                            <h4 class="modal-title" v-if="this.edit_mode == true">EDIT</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="edit_mode ? updateUtility() : createUtility()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Utility Information</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.utility_name" name="utility_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('utility_name') }">
                                            <has-error :form="form" field="utility_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Billable:</label>
                                        <div class="col-md-9">
                                        <input type="checkbox" v-model="form.billable" name="billable" id="billable" true-value="1" false-value="0" :class="{ 'is-invalid': form.errors.has('billable') }" />
                                            <has-error :form="form" field="billable"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.utility_notes" name="utility_notes" id="utility_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('utility_notes') }"></textarea>
                                            <has-error :form="form" field="utility_notes"></has-error>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" :disabled="form.busy" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
         <!-- end of modal-->
    </div>    
</template>
<script>
export default {
    components:{
        datetime,
    },
    data() {
        return {
            property_types: {},
            utilities: {},
            edit_mode: false,        
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            form: new Form({
                property_type_id: '',
                property_type_name: '',
                type_notes: '',
                utility_id: '',
                utility_name: '',
                utility_notes: '',
                billable: ''
            })
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/property_types?page=' + page)
				.then(response => {
					this.property_types = response.data;
				});
		},
        getPropertyTypes(){

            axios.get('api/property_types').then(({ data})=>(this.property_types = data));
        },
          getUtilities(){
            
            axios.get('api/utilities').then(({ data})=>(this.utilities = data));
        },
        showItem(){
            this.edit_mode = false;
            this.form.reset();
            $('#modal-type').modal('show');
        },
        showUtility(){
            this.edit_mode = false;
            this.form.reset();
            $('#modal-utility').modal('show');
        },
        updateItem(d){
            this.edit_mode = true;
            this.form.reset();
            $('#modal-type').modal('show');            
            this.form.fill(d);
        },
        updateModal(d){
            this.edit_mode = true;
            this.form.reset();
            $('#modal-utility').modal('show');            
            this.form.fill(d);
        },
        createPropertyType(){
            this.$Progress.start();
            this.form.post('api/property_types')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property type details saved successfully.'
                })
                $('#modal-type').modal('hide');
                this.getPropertyTypes();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Property type details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
         createUtility(){
            this.$Progress.start();
            this.form.post('api/utilities')
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Utility details saved successfully.'
                })
                $('#modal-utility').modal('hide');
                this.getUtilities();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Utility details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        updatePropertyType(){
            this.$Progress.start();
            this.form.put('api/property_types/'+this.form.property_type_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Property type details saved successfully.'
                })
                $('#modal-type').modal('hide');
                this.getPropertyTypes();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Property type details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        updateUtility(){
            this.$Progress.start();
            this.form.put('api/utilities/'+this.form.utility_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Utility details updated successfully.'
                })
                $('#modal-utility').modal('hide');
                this.getUtilities();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Utility details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        
      
    },
    created(){
        this.$Progress.start();
        this.getPropertyTypes();
        this.getUtilities();
        this.$Progress.finish();

    }
}
</script>
<style scoped>
thead{
    color: #fff;
    background-color: #2a8ee0;
    font-size: 14px;
    padding: 0px;
    border: 1px solid #2a8ee0;
}

.table th, .table td {
    padding: 0.4rem 1.3rem;
}

.table td {
    font-size: 12px;
}

.table-fixed{
  width: 100%;
  background-color: #f3f3f3;
}
</style>
