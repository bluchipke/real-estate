<template>
    <div class="container">
      <div class="row">
            <div class="col-md-12">
                <div class="card">
                        <nav-bar></nav-bar>
                </div>
            </div>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="row"> 
                    <div class="col-md-10">
                        <h4 style="text-transform: uppercase;">PROPERTY: {{property.property_name}}</h4>
                    </div>                  
                    <div class="col-md-1">
                        <router-link :to="'/properties/'+property.property_id+'/edit'" class="btn btn-sm btn-flat btn-block btn-success"><i class="fa fa-edit"></i></router-link>
                    </div>
                     <div class="col-md-1">
                        <router-link :to="'/properties/'+property.property_id+'/edit'" class="btn btn-sm btn-flat btn-block btn-danger"><i class="fa fa-trash"></i></router-link>
                    </div>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                <span class="username">
                                <p>Details</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                          <div class="col-sm-4">
                              <h6><span><strong>Name: </strong>{{property.property_name}} </span></h6>
                              <h6><span><strong>Type #: </strong> {{property.property_type_name}} </span></h6>
                              <h6><span><strong># of Units: </strong> {{property.units_count}} </span></h6>
                              <h6><span><strong># Floors: </strong> {{property.no_floors}} </span></h6>
                          </div>
                          <div class="col-sm-4">
                              <h6><span><strong>Location: </strong> {{property.location_name}} </span></h6>
                              <h6><span><strong>Street #.: </strong> {{property.main_street}} </span></h6>
                              <h6><span><strong>Estate: </strong> {{property.estate_name}} </span></h6>
                              <h6><span><strong>Constituency: </strong> {{property.constituency}} </span></h6>
                          </div>  
                          <div class="col-md-4">
                                <div class="card">
                                    <!-- <div class="card-header">
                                        UNITS
                                    </div> -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="#" @click.prevent="openUnit">Generate Unit IDs</a>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="#">Property Features</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                         </div>                        
                      </div>
                      <!-- /.user-block -->   
                      <div class="row mt-2">
                          <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                <span class="username">
                                <p>Tenants Information</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                            <!-- Tenants Table Information                    -->
                            <div class="col-md-12">
                                <table class="table table-striped table-fixed">
                                    <thead>
                                        <th>Tenant Name</th>
                                        <th>House ID</th>
                                        <th>Rent</th>
                                        <th>Transactions</th>
                                        <th>Expenses</th>
                                    </thead>
                                    <tbody>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tbody>

                                </table>
                            </div>
                      </div>
                      <!-- /.user-block -->       
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                <span class="username">
                                <p>Employment Information</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Employment Type: </strong> {{property.employment_type}} </span></h6>
                              <h6><span><strong>Employment Status: </strong> {{property.employment_status}} </span></h6>                              
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Date Started: </strong> {{property.date_started}} </span></h6>
                              <h6><span><strong>Commission Structure:</strong> {{property.str_label}}({{property.str_percent}}% + KSH {{property.str_amount}}) </span></h6>
                          </div>                          
                      </div>
                      <!-- /.user-block -->                   
                    </div>
                    <!-- /.post -->                    

                  </div>  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- MODALS -->
        <div class="modal fade in" id="modal-unit" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">New Unit: {{property.property_name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                
              </div>
              <form @submit.prevent="createUnit" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                <div class="modal-body">                  
                        <div class="form-group row">
                            <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Unit #:</label>
                                <div class="col-md-9">
                                <input type="text" v-model="form.unit_number" name="unit_number" id="unit_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('unit_number') }">
                                    
                                    <has-error :form="form" field="unit_number"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Label:</label>
                                <div class="col-md-9">
                                <input type="text" v-model="form.unit_size" name="unit_size" id="unit_size" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('unit_size') }">
                                    
                                    <has-error :form="form" field="unit_size"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Rent Amount:</label>
                                <div class="col-md-9">
                                <input type="number" v-model="form.unit_value" name="unit_value" id="unit_value" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('unit_value') }">
                                    
                                    <has-error :form="form" field="unit_value"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Unit Level:</label>
                                <div class="col-md-9">
                                <input type="text" v-model="form.unit_level" name="unit_level" id="unit_level" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('unit_level') }">
                                    
                                    <has-error :form="form" field="unit_value"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Available:</label>
                                <div class="col-md-9">
                                <input type="checkbox" v-model="form.unit_status" name="unit_status" id="unit_status" true-value="1" false-value="0" :class="{ 'is-invalid': form.errors.has('unit_status') }">
                                    
                                    <has-error :form="form" field="unit_status"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Comments:</label>
                                <div class="col-md-9">
                                <textarea rows="5" type="text" v-model="form.other_details" name="other_details" id="other_details" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('other_details') }"></textarea>
                                    
                                    <has-error :form="form" field="unit_value"></has-error>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
    </div>
</template>
<script>
export default {
    data(){
        return{
            property:'',
            property_id: this.$route.params.id,
            floors: [],
            form: new Form({
                unit_number: '',
                property_id: this.$route.params.id,
                unit_size: '',
                unit_value: '',
                vacant: 1,
                unit_status: 1,
                // unit_status: '',
                other_details: '',
                unit_type_id: '',
                unit_level: ''
            }),

        }
    },
    methods: {
        getProperty()
        {
            axios.get('api/properties/'+this.property_id).then(({data})=>(
                this.property = data
            ));
        },
        openUnit()
        {
            this.form.reset();
            $('#modal-unit').modal('show');
        },
        createUnit(){
            this.form.post('api/units')
            .then(()=>{
                this.form.reset();
                Toast.fire({
                    type: 'success',
                    title: 'Unit saved successfully.'
                })
            })
            .catch(()=>{

            })
            // this.form.reset();
        }
    },
    mounted() 
    {
        this.$Progress.start();
        this.getProperty();
        this.$Progress.finish();
    }
}
</script>
<style scoped>
.user-block .username, .user-block .description, .user-block .comment {
    margin-left: 0px;
    color: #3490dc;
}
</style>


