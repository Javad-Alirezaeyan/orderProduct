<template>
    <div>
        <h4 class="border-bottom border-gray pb-2 mb-0">Basket info</h4>
        <table class="invoice-items" cellspacing="0" cellpadding="0">
            <tbody>
            {{ product }}
            <tr>
                <td>{{ product.name }}</td>
                <td class="alignright">$ {{ product.price }}</td>
            </tr>
            <tr>
                <td>Shipping fee</td>
                <td class="alignright">$ {{ shippingFee}}</td>
            </tr>
            <tr class="total">
                <td class="alignright" width="80%">Total</td>
                <td class="alignright">$ {{ parseFloat(product.price) + parseFloat(shippingFee) }}</td>
            </tr>
            </tbody>
        </table>
        <br/>
        <br/>
    </div>


</template>

<script>
    export default {
        name: "Basket",
        data(){
            return{

            }
        },
        computed: {
            shippingFee () {
                return this.$store.state.shippingFee
            },
            product(){
                return this.$store.state.product
            }
        },
        methods:{

        },
        created() {
           /* this.shipping_fee = this.$store.state.shipping_fee;
            this.product = this.$store.state.product;*/
        }
    }
</script>

<style scoped>

</style>