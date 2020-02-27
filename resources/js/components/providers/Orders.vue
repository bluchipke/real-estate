<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-11">
                                Work Orders
                            </div>
                            <div class="col-md-1">
                                <a href="#" @click.prevent="showOrder"><i class="fa fa-plus"></i></a>
                            </div>                                                     
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Provider</th>
                                    <th>Task Note</th>
                                    <th>Created</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <!-- <th>Address</th>
                                    <th>Created</th>
                                    <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in work_orders.data" :key="d.work_order_id">
                                    <td>{{++index}}</td>
                                    <td> <a href="#" @click.prevent="updateItem(d)" >{{d.work_order}}</a> </td>
                                    <td>{{d.provider_name}}</td>
                                    <td>{{d.order_notes}}</td>
                                    <td>{{d.created_at | moment('DD/MM/YYYY')}}</td>
                                    <td>{{d.deadline | moment('DD/MM/YYYY')}}</td>
                                    <td></td>
                                    <!-- <td></td>
                                    <td></td>
                                    <td></td> -->
                                   
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="work_orders" @pagination-change-page="getResults"></pagination>
                    </div>                   
                </div>
            </div>
        
        </div>    
        

          <!-- modal window for creating work_orders--> 
           <div class="modal fade show" id="modal-provider" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="this.edit_mode == false">CREATE</h4>
                            <h4 class="modal-title" v-if="this.edit_mode == true">EDIT</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="edit_mode ? updateOrder() : createOrder()" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
            
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Task Details</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Task:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.work_order" name="work_order" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('work_order') }">
                                            <has-error :form="form" field="work_order"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Provider:</label>
                                    <div class="col-md-9">
                                        <v-select v-model="form.provider_name" name="provider_id" :value="form.provider_id" :options="providers.data" label="provider_name" class="" :class="{ 'is-invalid': form.errors.has('provider_id') }">
                                            <!-- <option value="">Select</option> -->
                                        </v-select>
                                            <has-error :form="form" field="provider_id"></has-error>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Deadline:</label>
                                    <div class="col-md-9">
                                        <vue-date-picker format="YYYY-MM-DD" formatted="ll" v-model="form.deadline" :only-date="true" name="deadline" class="" :class="{ 'is-invalid': form.errors.has('deadline') }"></vue-date-picker>
                                            <has-error :form="form" field="deadline"></has-error>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Notes:</label>
                                        <div class="col-md-9">
                                        <textarea type="text" v-model="form.order_notes" name="order_notes" id="order_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('order_notes') }"></textarea>
                                            <has-error :form="form" field="order_notes"></has-error>
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
            providers: {},
            work_orders: {},
            edit_mode: false,        
            // driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            form: new Form({
                work_order_id: '',
                deadline: '',
                provider_id: '',
                provider_name:'',
                phone_no: '',
                work_order: '',
                business_location: '',
                order_notes: ''
            })
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/work_orders?page=' + page)
				.then(response => {
					this.work_orders = response.data;
				});
		},
        
        getOrders(){            
            axios.get('api/work_orders').then(({ data})=>(this.work_orders = data));
        },

        getProviders(){            
            axios.get('api/providers').then(({ data})=>(this.providers = data));
        },
        showItem(){
            this.edit_mode = false;
            this.form.reset();
            $('#modal-type').modal('show');
        },
        showOrder(){
            this.edit_mode = false;
            this.form.reset();
            this.getProviders();
            $('#modal-provider').modal('show');
        },
        updateItem(d){
            this.edit_mode = true;
            this.form.reset();
            this.getProviders();
            $('#modal-provider').modal('show');            
            this.form.fill(d);
        },
        updateModal(d){
            this.edit_mode = true;
            this.form.reset();
            $('#modal-provider').modal('show');            
            this.form.fill(d);
        },
        
         createOrder(){
            this.$Progress.start();
            this.form.post('api/work_orders')
            .then(({data})=>{
                Toast.fire({
                    type: 'success',
                    title: data.message
                })
                $('#modal-provider').modal('hide');
                this.getOrders();
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
        
        updateOrder(){
            this.$Progress.start();
            this.form.put('api/work_orders/'+this.form.work_order_id)
            .then(({data})=>{
                Toast.fire({
                    type: 'success',
                    title: data.message
                })
                $('#modal-provider').modal('hide');
                this.getOrders();
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
        
      
    },
    created(){
        this.$Progress.start();
        this.getOrders();
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
