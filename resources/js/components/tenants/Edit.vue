<template>
    <div class="container">
        <div class="row justify-content-center">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    TENANT DETAILS
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateTenant" @keydown="form.onKeydown($event)">
                    <!-- <alert-success :form="form" message="Your changes have been saved!"></alert-success> -->
                        
                    <div class="row">
                        <fieldset class="col-md-3">
                            <legend><h5>Primary Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Tenant Type:</label>
                                <select type="text" v-model="form.tenant_type" name="tenant_type" class="form-control" :class="{ 'is-invalid': form.errors.has('tenant_type') }">
                                    <option value="">Select</option>
                                    <option value="1">PERSONAL</option>
                                    <option value="2">BUSINESS</option>
                                </select>
                                        <has-error :form="form" field="tenant_type"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">First Name:</label>
                                <input type="text" v-model="form.first_name" name="first_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                        <has-error :form="form" field="first_name"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Last Name:</label>
                                <input type="text" v-model="form.last_name" name="last_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('last_name') }">
                                        <has-error :form="form" field="last_name"></has-error>
                            </div>
                            <div class="form-group" v-if="form.tenant_type == 1">
                                <label for="" class="form-label">Gender:</label>
                                <select type="text" v-model="form.gender" name="gender" class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
                                    <option value="">Select</option>
                                    <option value="Male">MALE</option>
                                    <option value="Female">FEMALE</option>
                                </select>
                                        <has-error :form="form" field="gender"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Phone No:</label>
                                <input type="tel" v-model="form.phone_number" name="phone_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                        <has-error :form="form" field="phone_number"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Email Address:</label>
                                <input type="email" v-model="form.tenant_email" name="tenant_email" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('tenant_email') }">
                                        <has-error :form="form" field="tenant_email"></has-error>
                            </div>
                            <div class="form-group" v-if="form.tenant_type == 1">
                                <label for="" class="form-label">Marital Status:</label>
                                <select type="text" v-model="form.marital_status" name="marital_status" class="form-control" :class="{ 'is-invalid': form.errors.has('marital_status') }">
                                    <option value="">Select</option>
                                    <option value="Single">SINGLE</option>
                                    <option value="Married">MARRIED</option>
                                    <option value="Divorced">DIVORCED</option>
                                </select>
                                        <has-error :form="form" field="marital_status"></has-error>
                            </div>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <legend><h5>Other Details</h5></legend>                            
                            <div class="form-group">
                                <label for="" class="form-label">Tenant Code:</label>
                                <input type="text" v-model="form.tenant_code" name="tenant_code" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('tenant_code') }">
                                        <has-error :form="form" field="tenant_code"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Postal Address:</label>
                                <input type="text" v-model="form.postal_address" name="postal_address" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('postal_address') }">
                                        <has-error :form="form" field="postal_address"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Postal Code:</label>
                                <input type="text" v-model="form.postal_code" name="postal_code" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('postal_code') }">
                                        <has-error :form="form" field="postal_code"></has-error>
                            </div>
                            <div class="form-group" v-if="form.tenant_type == 1">
                                <label for="" class="form-label">ID Card / Passport:</label>
                                <input type="text" v-model="form.id_card_passport" name="id_card_passport" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('id_card_passport') }">
                                        <has-error :form="form" field="id_card_passport"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">KRA PIN:</label>
                                <input type="text" v-model="form.kra_pin" name="kra_pin" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('kra_pin') }">
                                        <has-error :form="form" field="kra_pin"></has-error>
                            </div>
                        </fieldset>
                        <fieldset class="col-md-3" v-if="form.tenant_type == 1 || form.tenant_type == 2">
                            <legend><h5>Secondary Details</h5></legend>                          
                            <div class="form-group" v-if="form.tenant_type == 1">
                                <label for="" class="form-label">NSSF #:</label>
                                <input type="text" v-model="form.nssf_number" name="nssf_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('nssf_number') }">
                                        <has-error :form="form" field="nssf_number"></has-error>
                            </div>
                            <div class="form-group" v-if="form.tenant_type == 1">
                                <label for="" class="form-label">NHIF:</label>
                                <input type="text" v-model="form.nhif_number" name="nhif_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('nhif_number') }">
                                        <has-error :form="form" field="nhif_number"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label" v-if="form.tenant_type == 1">Employer Name:</label>
                                <label for="" class="form-label" v-if="form.tenant_type == 2">Business Name:</label>
                                <input type="text" v-model="form.employer_name" name="employer_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('employer_name') }">
                                        <has-error :form="form" field="employer_name"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label" v-if="form.tenant_type == 1">Employer  Contact:</label>
                                <label for="" class="form-label" v-if="form.tenant_type == 2">Business Contact:</label>
                                <input type="text" v-model="form.employer_contact" name="employer_contact" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('employer_contact') }">
                                        <has-error :form="form" field="employer_contact"></has-error>
                            </div>
                            
                            
                        </fieldset>
                    </div>
                       <div class="row">
                           <div class="col-md-2 mt-2" style="padding-left: 8px !important;">                               
                                <button :disabled="form.busy" type="submit" class="btn btn-sm btn-block btn-flat btn-success"><i class="fa fa-check"></i> SAVE</button>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
import datetime from 'vuejs-datetimepicker';
export default {   
    components: {
                datetime
            },
    data() {
        return{        
            tenant: {},
            tenant_id: this.$route.params.id,    
            form: new Form({
                
                first_name: '',
                last_name: '',
                phone_number: '',
                tenant_email: '',
                postal_address: '',
                nhif_number :'',
                employer_name: '',
                employer_contact: '',
                tenant_code: '',
                postal_code: '',
                nssf_number:'',
                percentage: '',
                gender: '',
                tenant_type: '',
                marital_status: '',
                kra_pin: '',
                id_card_passport:'',
                bank_id: '',
                billing_type: '',
                status: '',
                bank_account: ''
            })
        }
    },
    methods: {

      getTenant(){
            axios.get('api/tenants/'+this.tenant_id)
            .then(({data})=>(       
                this.form.fill(data)
            ));           
        },
        updateTenant(){
            this.form.put('api/tenants/'+this.tenant_id);
            Toast.fire({
                type: 'success',
                title: 'Tenant updated successfully.'
            })
        },
    },
    created(){
        this.$Progress.start();
        this.getTenant();
        this.$Progress.finish();
    }
    
}
</script>

<style scoped>
    fieldset { border:1px solid #c2c2c2; margin: 5px; border-radius: 3px; }
    .form-control{ border-radius: 0px; }

    legend {
        padding: 0.2em 0.5em;
        /* border:1px solid #c2c2c2; */
        color:#070707;
        font-size:90%;
        text-align:left;
        width: auto;
    }

    .form-control-sm {
        height: calc(1.0em + 0.5rem + 2px);
        padding: 0.75rem 0.5rem;
    }
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
    label {
        margin-bottom: 0.2rem;
        color: #245d73;
    }
    .form-group {
        margin-bottom: 0.5rem;
    }
    h5, .h5 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 0rem;
    }

     .card-header{
        /* float:left; */
       background-color: #2a8ee0;
       border-color:#2a8ee0;
       color: #fff;
       font-weight: bold;
       font-size: 14px;
       padding: 5px;
      }

      .card{
          border-radius: 0px;
      }
      .span{
          color: red;
      }
</style>


