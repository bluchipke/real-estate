<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-11">
                                ACTIVITIES
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
                                    <th>Activity</th>
                                    <th>Work Order</th>
                                    <th>Created</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in activities.data" :key="d.activity_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateItem(d)" >{{d.activity_name}}</a> </td>
                                    <td>
                                        
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="card-footer">
                        <pagination :data="activities" @pagination-change-page="getResults"></pagination>
                    </div>                    -->
                </div>
            </div>
            
        </div>    
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-activity" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="this.edit_mode == false">CREATE</h4>
                            <h4 class="modal-title" v-if="this.edit_mode == true">EDIT</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="this.edit_mode ? updateActivity() : createActivity()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>CREATE</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-12" >Activity:</label>
                                    <div class="col-md-12">
                                        <input type="text" v-model="form.activity_name" name="activity_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('activity_name') }">
                                            <has-error :form="form" field="activity_name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-12" >Work Order:</label>
                                     <div class="col-md-12">
                                        <!-- <v-select type="text" v-model="form.work_order" name="work_order" id="work_order" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('work_order') }"> -->
                                            <!-- <option value="Select Option"></option> -->
                                        <!-- </v-select> -->
                                            <has-error :form="form" field="work_order"></has-error>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Deadline:</label>
                                    <div class="col-md-9">
                                        <vue-date-picker format="YYYY-MM-DD" formatted="ll" :only-date="true"  v-model="form.end_date" name="end_date" class="" :class="{ 'is-invalid': form.errors.has('end_date') }"></vue-date-picker>
                                            <has-error :form="form" field="end_date"></has-error>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-12" style="text-transform: capitalize;">Summary:</label>
                                        <div class="col-md-12">
                                        <textarea type="text" v-model="form.activity_notes" name="activity_notes" id="activity_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('activity_notes') }"></textarea>
                                            <has-error :form="form" field="activity_notes"></has-error>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" v-if="edit_mode = false" class="btn btn-sm btn-success"><i class="fa fa-check"></i> SUBMIT</button>
                                <button :disabled="form.busy" v-if="edit_mode = true" class="btn btn-sm btn-success"><i class="fa fa-check"></i> UPDATE</button>
                            </div>
                        </form>
                        <!-- form body -->
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
            orders: {},
            activities: {},
            edit_mode: false,        
            vsearch: '',
            selected: '',
            form: new Form({
                activity_id: '',
                activity_name: '',
                activity_notes: '',
                work_order: '',
                end_date: '',
            })
        }
    },
    methods: {
        
        getOrders(){
            axios.get('api/work_orders').then(({ data})=>(this.orders = data));
        },
        getActivities(){            
            axios.get('api/activities').then(({ data})=>(this.activities = data));
        },
        showItem(){
            this.edit_mode = false;
            this.form.reset();
            $('#modal-activity').modal('show');
        },        
        updateItem(d){
            this.edit_mode = true;
            this.form.reset();
            // $('#modal-activity').modal('show');            
            this.form.fill(d);
        },
        
        createActivity(){
            this.$Progress.start();
            this.form.post('api/activities')
            .then(({data})=>{
                Toast.fire({
                    type: 'success',
                    title: data.message
                })
                $('#modal-activity').modal('hide');
                this.getActivities();
            })
            .catch(({data})=>{
                Toast.fire({
                    type: 'warning',
                    title: data.message
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
         
        
        updateActivity(){
            this.$Progress.start();
            this.form.put('api/activities/'+this.form.activity_id)
            .then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Activity details updated successfully.'
                })
                $('#modal-activity').modal('hide');
                this.getActivities();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Activity details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        
      
    },
    created(){
        this.$Progress.start();
        this.getActivities();
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
