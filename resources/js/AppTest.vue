<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col form-inline">
                <b-form-input
                    id="input-2"
                    v-model="newTask"
                    required
                    placeholder="Enter Task"
                    @keyup.enter="add"
                ></b-form-input>
                <b-button @click="add" variant="primary" class="ml-3">Add</b-button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-3">
                <div class="p-2 alert alert-secondary">
                    <h3>Back Log</h3>
                    <!-- Backlog draggable component. Pass arrBackLog to list prop -->
                    <draggable
                        class="list-group kanban-column"
                        :list="arrBackLog"
                        group="tasks"
                    >
                        <div
                            class="list-group-item"
                            v-for="element in arrBackLog"
                            :key="element.name"
                        >
                            {{ element.name }}
                        </div>
                    </draggable>
                </div>
            </div>

            <div class="col-3">
                <div class="p-2 alert alert-primary">
                    <h3>In Progress</h3>
                    <!-- In Progress draggable component. Pass products to list prop -->
                    <draggable
                        class="list-group kanban-column"
                        :list="products"
                        group="tasks"
                    >
                        <div
                            class="list-group-item"
                            v-for="element in products"
                            :key="element.name"
                        >
                            {{ element.name }}
                        </div>
                    </draggable>
                </div>
            </div>

            <div class="col-3">
                <div class="p-2 alert alert-warning">
                    <h3>Testing</h3>
                    <!-- Testing draggable component. Pass arrTested to list prop -->
                    <draggable
                        class="list-group kanban-column"
                        :list="arrTested"
                        group="tasks"
                    >
                        <div
                            class="list-group-item"
                            v-for="element in arrTested"
                            :key="element.name"
                        >
                            {{ element.name }}
                        </div>
                    </draggable>
                </div>
            </div>

            <div class="col-3">
                <div class="p-2 alert alert-success">
                    <h3>Done</h3>
                    <!-- Done draggable component. Pass arrDone to list prop -->
                    <draggable
                        class="list-group kanban-column"
                        :list="arrDone"
                        group="tasks"
                    >
                        <div
                            class="list-group-item"
                            v-for="element in arrDone"
                            :key="element.name"
                        >
                            {{ element.name }}
                        </div>
                    </draggable>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import draggable
import draggable from "vuedraggable";

export default {
    name: "kanban-board",
    components: {
        //import draggable as a component
        draggable
    },
    data() {
        return {
            products: [],
            // for new tasks
            newTask: "",
            // 4 arrays to keep track of our 4 statuses
            arrBackLog: [
                { name: "Code Sign Up Page" },
                { name: "Test Dashboard" },
                { name: "Style Registration" },
                { name: "Help with Designs" }
            ],
            arrTested: [],
            arrDone: []
        };
    },
    created() {
        this.axios
            .get('/api/columns/')
            .then(response => {
                this.products = response.data;
            });
    },
    methods: {
        //add new tasks method
        add: function() {
            if (this.newTask) {
                this.arrBackLog.push({ name: this.newTask });
                this.newTask = "";
            }
        },
        deleteProduct(id) {
            this.axios
                .delete(`/api/columns/${id}`)
                .then(response => {
                    let i = this.products.map(data => data.id).indexOf(id);
                    this.products.splice(i, 1)
                });
        },
        addProduct() {
            this.axios
                .post('/api/columns', this.product)
                .then(response => (
                    console.log(this.products)
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
};
</script>

<style>
/* light stylings for the kanban columns */
.kanban-column {
    min-height: 300px;
}
</style>
