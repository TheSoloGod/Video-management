<template>
    <div class="api-calling">
        <div class="error" v-if="errors.length">
            <span v-for="err in errors">
                {{ err }}
            </span>
        </div>
        <div class="create-form m-3">
            <div class="product-name-input form-group">
                <input class="form-control" type="text" v-model="product.name">
            </div>
            <div class="product-name-input form-group">
                <input class="form-control" type="text" v-model="product.price">
            </div>
            <div class="button-create form-group text-center">
                <button @click="createProduct" class="btn btn-outline-primary">Create</button>
            </div>
        </div>
        <hr>
        <div class="list-products">
            <h2>LIST PRODUCT</h2>
            <div class="product-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Date created</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, index) in listProducts" :key="product.id">
                            <td>{{ product.id}}</td>

                            <td v-if="!product.isEdit">
                                {{ product.name}}
                            </td>
                            <td v-else>
                                <input type="text" class="form-control" v-model="selectedProduct.name">
                            </td>

                            <td v-if="!product.isEdit">
                                {{ product.price}}
                            </td>
                            <td v-else>
                                <input type="text" class="form-control" v-model.number="selectedProduct.price">
                            </td>

                            <td>{{ product.created_at}}</td>

                            <td v-if="!product.isEdit">
                                <button class="btn btn-primary" @click="selectProduct(product)">Edit</button>
                                <button class="btn btn-danger" @click="deleteProduct(product, index)">Delete</button>
                            </td>
                            <td v-else>
                                <button class="btn btn-outline-info" @click="updateProduct(index)">Save</button>
                                <button class="btn btn-outline-danger" @click="product.isEdit = false">Cancel</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ApiCalling",
        data() {
            return {
                product: {
                    name: '',
                    price: 0,
                },
                selectedProduct: {},
                errors: [],
                listProducts: [],
            }
        },
        created() {
            this.getListProducts();
        },
        methods: {
            createProduct() {
                axios.post('/products', {name: this.product.name, price: this.product.price})
                    .then(response => {
                        this.listProducts.push({ ...response.data.product, isEdit: false});
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name;
                    })
            },
            getListProducts() {
                axios.get('/products')
                    .then(response => {
                        this.listProducts = response.data;
                        this.listProducts.forEach(item => {
                            Vue.set(item, 'isEdit', false)
                        })
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name;
                    })
            },
            selectProduct(product) {
                this.selectedProduct = { ...product };
                product.isEdit = true;
            },
            updateProduct(index) {
                axios.put('/products/' + this.selectedProduct.id, {
                    name: this.selectedProduct.name,
                    price: this.selectedProduct.price,
                })
                    .then(response => {
                        this.listProducts[index].name = this.selectedProduct.name;
                        this.listProducts[index].price = this.selectedProduct.price;
                        this.listProducts[index].isEdit = false;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name;
                    })
            },
            deleteProduct(product, index) {
                axios.delete('/products/' + product.id)
                    .then(response => {
                        console.log(response.data.result);
                        this.listProducts.splice(index, 1);
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name;
                    })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .error {
        color: red;
    }
</style>
