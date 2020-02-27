<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">DETAILS</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">TRIPS</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">EXPENSES</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">INCOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">DRIVERS</a></li> -->
                        </ul>
                    </div>
                    <div class="col-md-1">
                        <router-link :to="'/landlords/'+landlord.landlord_id+'/edit'" class="btn btn-sm btn-flat btn-block btn-success"><i class="fa fa-edit"></i></router-link>
                    </div>
                     <div class="col-md-1">
                        <router-link :to="'/landlords/'+landlord.landlord_id+'/edit'" class="btn btn-sm btn-flat btn-block btn-danger"><i class="fa fa-trash"></i></router-link>
                    </div>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                 <div class="col-sm-12">
                                    <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                        <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                        <span class="username">
                                        <p>General Information</p>
                                        <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                        </span>
                                        <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h6><span><strong>Name: </strong>{{landlord.first_name+' '+landlord.last_name}} </span></h6>
                                    <h6><span><strong>Address: </strong> {{landlord.postal_address}} </span></h6>
                                    <h6><span><strong>Postal Code: </strong> {{landlord.postal_code}} </span></h6>
                                    <h6><span><strong>Phone #: </strong> {{landlord.phone_number}} </span></h6>
                                </div>
                                <div class="col-sm-6">
                                    <h6><span><strong>Email: </strong> {{landlord.email_address}} </span></h6>
                                    <h6><span><strong>Properties: </strong> # </span></h6>
                                    <h6><span><strong>Billing: </strong> # </span></h6>
                                    <h6><span><strong>Invoices: </strong> # </span></h6>
                                </div> 
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="row mt-5">
                                <!-- <div class="card"> -->
                                    <!-- <div class="card-header">Transactions</div> -->
                                    <!-- <div class="card-body"> -->
                                        <div class="col-md-12"><a href="#">Billing Details</a></div>
                                        <div class="col-md-12"><a href="#">Banks &amp; Accounts</a></div>
                                        <div class="col-md-12"><a href="#">Invoices &amp; Receipts</a></div>
                                        <div class="col-md-12"><a href="#">General Transactions</a></div>
                                        <div class="col-md-12"><a href="#">Properties</a></div>
                                    <!-- </div> -->
                                <!-- </div> -->
                            </div>
                        </div>                        
                      </div>
                      <!-- /.user-block -->   
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                <span class="username">
                                <p>Other Details</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Capacity: </strong> {{landlord.capacity}} </span></h6>
                              <h6><span><strong>Year of Manufacturing: </strong> {{landlord.yom}} </span></h6>                              
                              <h6><span><strong>Origin: </strong> {{landlord.origin}} </span></h6>  
                              <h6><span><strong>Condition: </strong> {{landlord.condition}} </span></h6> 
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Policy Number: </strong> {{landlord.policy_number}} </span></h6>
                              <h6><span><strong>Insurer #:</strong> {{landlord.insurer}} </span></h6>
                              <h6><span><strong>Status #:</strong> {{landlord.status}} </span></h6>
                              <h6><span><strong>Expiry Date: </strong> {{landlord.insurance_expiry}} </span></h6>
                          </div>                          
                      </div>                                      
                    </div>
                    <!-- /.post -->                    

                  </div> 
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
</template>
<script>
export default {
    data(){
        return{
            landlord:'',
            landlord_id: this.$route.params.id,

        }
    },
    methods: {
        getVehicle(){
            axios.get('/api/landlords/'+this.landlord_id).then(({data})=>(
                this.landlord = data
            ));
        },

    },
    mounted() {
            // this.$progress.start();
            this.getVehicle();
            // this.$progress.finish();
        }
}
</script>
<style scoped>
.user-block .username, .user-block .description, .user-block .comment {
    margin-left: 0px;
    color: #3490dc;
}
</style>


