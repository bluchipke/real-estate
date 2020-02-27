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
                        <router-link :to="'/tenants/'+tenant.tenant_id+'/edit'" class="btn btn-sm btn-flat btn-block btn-success"><i class="fa fa-edit"></i></router-link>
                    </div>
                     <div class="col-md-1">
                        <router-link :to="'/tenants/'+tenant.tenant_id+'/edit'" class="btn btn-sm btn-flat btn-block btn-danger"><i class="fa fa-trash"></i></router-link>
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
                                    <h6><span><strong>Name: </strong>{{tenant.first_name+' '+tenant.last_name}} </span></h6>
                                    <h6><span><strong>Address: </strong> {{tenant.postal_address}} </span></h6>
                                    <h6><span><strong>Postal Code: </strong> {{tenant.postal_code}} </span></h6>
                                    <h6><span><strong>Phone #: </strong> {{tenant.phone_number}} </span></h6>
                                </div>
                                <div class="col-sm-6">
                                    <h6><span><strong>Email: </strong> {{tenant.tenant_email}} </span></h6>
                                    <h6><span><strong>KRA Pin: </strong> {{tenant.kra_pin}}</span></h6>
                                    <h6><span><strong>Move In Date: </strong> {{tenant.begin_date}}</span></h6>
                                    <h6 style="background: #0abf0a; padding: 5px; color: #fff;"><span><strong>Tenant Type: </strong> {{tenant.tenant_type_name}} </span></h6>
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
                                <span class="username">
                                <p>Secondary Details</p>
                                </span>
                            </div>
                          </div>
                          <div class="col-sm-6" v-if="tenant.tenant_type == 1">
                              <h6><span><strong>Gender: </strong> {{tenant.gender}} </span></h6>
                              <h6><span><strong>Marital Status: </strong> {{tenant.marital_status}} </span></h6>                              
                              <h6><span><strong>DOB: </strong> {{tenant.dob}} </span></h6>  
                              <h6><span><strong>ID / Passport: </strong> {{tenant.id_card_passport}} </span></h6> 
                              <h6><span><strong>Employer Name: </strong> {{tenant.employer_name}} </span></h6>
                              <h6><span><strong>Employer Contact: </strong> {{tenant.employer_contact}} </span></h6>  
                              <h6><span><strong>Property </strong> {{tenant.property_id}} </span></h6> 
                              <h6><span><strong>Unit: </strong> {{tenant.unit_id}} </span></h6> 
                          </div>
                          <div class="col-sm-6" v-if="tenant.tenant_type == 2">
                              <h6><span><strong>Business Name: </strong> {{tenant.employer_name}} </span></h6>
                              <h6><span><strong>Business Contact:</strong> {{tenant.employer_contact}} </span></h6>
                              <h6><span><strong>Property #:</strong> {{tenant.property_id}} </span></h6>
                              <h6><span><strong>Unit:: </strong> {{tenant.unit_id}} </span></h6>
                          </div>                          
                      </div>   
                      <div class="row">
                           <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <span class="username">
                                <p>Payment &amp; Expenses History</p>
                                </span>
                            </div>
                          </div>
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
            tenant:'',
            tenant_id: this.$route.params.id,

        }
    },
    methods: {
        getTenant(){
            axios.get('/api/tenants/'+this.tenant_id).then(({data})=>(
                this.tenant = data
            ));
        },

    },
    mounted() {
            this.$Progress.start();
            this.getTenant();
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


