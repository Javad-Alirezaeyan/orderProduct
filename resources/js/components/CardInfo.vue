<template>
    <div>
        <h4 class="mb-3">Payment</h4>
        <hr class="mb-4">
        <div class="d-block my-3">
            <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">Paypal</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name">Name on card</label>
                <input type="text" v-model="name" class="form-control" id="name" placeholder="" v-on:blur="setInfo()" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                    Name on card is required
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="cardNumber">Credit card number</label>
                <input type="text" v-model="cardNumber" value="4242424242424242" class="form-control" id="cardNumber" v-on:blur="setInfo()" placeholder="" required>
                <div class="invalid-feedback">
                    Credit card number is required
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label >Expiration</label>
                <div class="row">
                    <div class="form-group col-md-6">
                        <select id="year" v-model="year" v-on:blur="setInfo()" class="form-control">
                            <option selected value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2020</option>
                            <option value="2024">2020</option>
                            <option value="2025">2020</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select id="month"  v-model="month" v-on:blur="setInfo()" class="form-control">
                            <option value="1" >01</option>
                            <option value="2" >02</option>
                            <option value="3" >03</option>
                            <option value="4" >04</option>
                            <option value="5" >05</option>
                            <option value="6" >06</option>
                            <option value="7" >07</option>
                            <option value="8" >08</option>
                            <option value="9" >09</option>
                            <option value="10" >10</option>
                            <option value="11" >11</option>
                            <option selected value="12" >12</option>
                        </select>
                    </div>
                </div>

                <div  class="invalid-feedback">
                    Expiration date required
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="cvv">CVV</label>
                <input type="text" v-model="cvv"  class="form-control" v-on:blur="setInfo()"  id="cvv" placeholder="" required>
                <div class="invalid-feedback">
                    Security code required
                </div>
            </div>
        </div>
        <hr class="mb-4">
    </div>
</template>

<script>
    export default {
        name: "CardInfo",
        data(){
            return{
                name: 'test',
                cardNumber: '4242424242424242',
                cvv: '233',
                year: '2012',
                month: '9'
            }
        },
        methods:{
            setInfo(){
                this.setCardInfo(
                    {
                        name: this.name,
                        cardNumber: this.cardNumber,
                        cvv: this.cvv,
                        year: this.year,
                        month: this.month
                    }
                );
            },
            setCardInfo(card){
                this.$store.dispatch('setCardInfo', card);
            }
        }
    }
</script>

<style scoped>

</style>