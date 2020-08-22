<template>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <div class="row">
            <div class="col-md-12 order-md-1">
                <div id="errorMessage" class="text-danger"></div>
                <Basket></Basket>
                <CustoemrInfo></CustoemrInfo>
                <CardInfo></CardInfo>

                <div class="offset-md-4 col-md-4">
                    <button class="btn btn-primary btn-lg btn-block " id="btnCheckout" v-on:click="checkout()"  type="submit">
                        <span style="display: none" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Continue to checkout</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import CustoemrInfo from "./CustoemrInfo";
    import CardInfo from "./CardInfo";
    import Basket from "./Basket";
    export default {
        name: "Checkout",
        components: {CardInfo, CustoemrInfo, Basket},

        data(){
            return{
                product: {},
                shipping_fee : 0
            }
        },
        props : ["params", 'id'],

        mounted(){
            this.setProduct(this.params.product)
            this.setShippingFee(this.params.shipping_fee);
        },
        computed: {

        },
        methods:{

            setProduct(product){
                this.$store.dispatch('setProduct', product);
            },
            setShippingFee(shippingFee){
                this.$store.dispatch('setShippingFee', shippingFee);
            },
            async checkout(){
                $("#btnCheckout").attr("disabled", "disabled");
                $("#btnCheckout span").css("display", 'block');

                let data = {
                    product : this.$store.state.product,
                    customer : this.$store.state.customerInfo,
                    card : this.$store.state.cardInfo,
                    shippingFee: this.$store.state.shippingFee,
                    '_token': window.Laravel.csrfToken

                }
               // clear error message
                $("#errorMessage").css("display", 'none').html("");

                $.ajax({
                    url         :   'registerOrder',
                    type        :   'post',
                    dataType    :   'json',
                    data        :   data,
                }).done(function (res, textStatus, xhr) {
                    //console.log(res);
                     window.location.href = "order/"+ res.orderId
                    $("#btnCheckout").attr("disabled", false);
                    $("#btnCheckout span").css("display", 'none');

                }).fail(function (jqXHR, textStatus) {
                       if (jqXHR.status == 400){
                           let a = JSON.parse(jqXHR.responseText );
                           let errorMsg = "";
                           for(let key in a){
                              errorMsg += a[key] + "<br/>";
                           }
                           $("#errorMessage").css("display", 'block').html(errorMsg);
                           window.scrollTo(0, 0);
                       }
                       else{
                           alert("error: "+ jqXHR.responseText);
                       }

                        $("#btnCheckout").attr("disabled", false);
                        $("#btnCheckout span").css("display", 'none');

                    });
            },

            showError(error){
                  alert();
            }
        },
        created(){
        }


    }

</script>

<style scoped>

</style>