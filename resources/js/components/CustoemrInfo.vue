<template>
    <div>
        <h4 class="mb-3">Customer info</h4>
        <hr class="mb-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder=""
                           v-on:blur="setInfo()" v-model="firstName"
                           value="" required="">
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder=""
                           v-model="lastName"
                           v-on:blur="setInfo()"
                           value="" required="">
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="address">Email<span class="text-danger">*</span> </label>
                <input type="email" class="form-control" name="email" id="email"  v-on:blur="setInfo()"  v-model="email" required="">
                <div class="invalid-feedback">
                    Please enter your email.
                </div>
            </div>

            <div class="mb-3">
                <label for="address">Address <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" v-model="address"  v-on:blur="setInfo()"  name="address" id="address" required="">
                <div class="invalid-feedback">
                    Please enter your shipping address.
                </div>
            </div>
        <br/>
        <br/>
    </div>

</template>

<script>
    export default {
        name: "CustoemrInfo",

        data(){
            return{
                firstName: "",
                lastName : "",
                email: "",
                address: ""
            }
        },
        methods:{
            setInfo(){
                this.setCustomerInfo(
                    {
                        firstName: this.firstName,
                        lastName : this.lastName,
                        email: this.email,
                        address: this.address
                    }
                );
            },
            setCustomerInfo(customer){
                this.$store.dispatch('setCustomerInfo', customer);
            }
        }

    }
</script>

<style scoped>

</style>