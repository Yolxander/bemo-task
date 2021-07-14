<template>
    <div id="main" >
        <h2>Dashboard</h2>
        <div id="columns">
            <div v-for="product in products" :key="product.id" id="column">
                <p>{{ product.name }}</p>
                    <div class="btn-group" role="group">
                        <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                    </div>
               </div>
        </div>
        <CreateColumns />
    </div>

</template>

<script>

import CreateColumns from "./components/CreateColumns";

export default {

    components: {
        CreateColumns
    },
    data() {
        return {
            products: []
        }
    },
    created() {
        this.axios
            .get('/api/columns/')
            .then(response => {
                this.products = response.data;
            });
    },
    methods: {
        deleteProduct(id) {
            this.axios
                .delete(`/api/columns/${id}`)
                .then(response => {
                    let i = this.products.map(data => data.id).indexOf(id);
                    this.products.splice(i, 1)
                });
        }
    }
}
</script>

<style scoped>

#main{
    display: flex;
    justify-content: space-around;
}

#columns{
    display: flex;
    justify-content: space-between;
}

#column{
    display: flex;
    justify-content: space-between;
    border: 1px solid red;
    width:300px;
}
</style>
