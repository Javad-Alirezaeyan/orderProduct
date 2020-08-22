<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Brand</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
            <tr   v-for="product in products">
                <th scope="row">1</th>
                <td>{{ product.product_name }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.name }}</td>
                <td>
                    <a  href="checkout?productId" class="btn btn-warning btn-sm " role="button" aria-disabled="true"> Buy</a>
                    <a href="addToBasket" class="btn btn-danger btn-sm " role="button" aria-disabled="true"> Add to Basket</a>
                </td>
            </tr>

            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        name: "ProductList",
        data(){
            return{
            }
        },
        props : ["products"]
    }
</script>

<style scoped>

</style>