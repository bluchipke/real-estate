<template>
    <div class="container">
        <div class="row justify-content-center">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    LANDLORD DETAILS
                </div>
                <div class="card-body">
                    <form @submit.prevent="createLandlord" @keydown="form.onKeydown($event)">
                    <!-- <alert-success :form="form" message="Your changes have been saved!"></alert-success> -->
                        
                    <div class="row">
                        <fieldset class="col-md-3">
                            <legend><h5>Information</h5></legend>
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
                            <div class="form-group">
                                <label for="" class="form-label">Phone No:</label>
                                <input type="tel" v-model="form.phone_number" name="phone_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                        <has-error :form="form" field="phone_number"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Email Address:</label>
                                <input type="email" v-model="form.email_address" name="email_address" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('email_address') }">
                                        <has-error :form="form" field="email_address"></has-error>
                            </div>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <legend><h5>Other Details</h5></legend>
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
                            <div class="form-group">
                                <label for="" class="form-label">KRA PIN:</label>
                                <input type="text" v-model="form.kra_pin" name="kra_pin" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('kra_pin') }">
                                        <has-error :form="form" field="kra_pin"></has-error>
                            </div>
                            <!-- <div class="form-group">
                                <label for="" class="form-label">Billing:</label>
                                <input type="text" v-model="form.billing_type" name="billing_type" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('billing_type') }">
                                        <has-error :form="form" field="billing_type"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Percentage #:</label>
                                <input type="text" v-model="form.percentage" name="percentage" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('percentage') }">
                                        <has-error :form="form" field="percentage"></has-error>
                            </div> -->
                            
                        </fieldset>
                        <fieldset class="col-md-3">
                            <legend><h5>Accounts Information</h5></legend>
                            
                            <!-- <div class="form-group">
                                <label for="" class="form-label">Bank:</label>
                                <select type="text" v-model="form.bank_id" name="bank_id" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('bank_id') }">
                                    <option value="">Select</option>
                                </select>
                                        <has-error :form="form" field="bank_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Bank Account:</label>
                                <input type="text" v-model="form.bank_account" name="bank_account" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('bank_account') }">
                                        <has-error :form="form" field="bank_account"></has-error>
                            </div> -->
                            <!-- <div class="form-group"> -->
                                <!-- <label for="" class="form-label">Insurance Expiry: (Y-m-d)</label> -->
                                <!-- <datetime format="YYYY-MM-DD" width="190px" v-model="form.insurance_expiry" name="insurance_expiry" :class="{ 'is-invalid': form.errors.has('insurance_expiry') }"></datetime> -->
                                <!-- <input type="text" v-model="form.insurance_expiry" name="insurance_expiry" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('insurance_expiry') }"> -->
                                        <!-- <has-error :form="form" field="insurance_expiry"></has-error> -->
                                        
                            <!-- </div> -->
                             <!-- <div class="form-group">
                                <label for="" class="form-label">Status:</label>
                                <input type="text" v-model="form.status" name="status" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('status') }">
                                        <has-error :form="form" field="status"></has-error>
                            </div> -->
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
            form: new Form({
                
                first_name: '',
                last_name: '',
                phone_number: '',
                email_address: '',
                postal_address: '',
                postal_code: '',
                percentage: '',
                kra_pin: '',
                bank_id: '',
                billing_type: '',
                status: '',
                bank_account: ''
            })
        }
    },
    methods: {

        createLandlord(){
            this.form.post('api/landlords')
            .then(()=>{
                this.form.reset();
                Toast.fire({
                    type: 'success',
                    title: 'Landlord saved successfully.'
                })
            })
            .catch(()=>{

            })
            this.form.reset();
        }
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


