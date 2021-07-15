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
                            <b-list-group-item class="d-flex justify-content-between align-items-center">
                                {{ element.name}}
                                <b-icon icon="x-circle" scale="2" variant="danger" @click="deleteCards(element.id,element.name)"></b-icon>
                            </b-list-group-item>

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
                        :list="arrInProgress"
                        group="tasks"
                    >
                        <div
                            class="list-group-item"
                            v-for="element in arrInProgress"
                            :key="element.name"
                        >
                            <b-list-group-item class="d-flex justify-content-between align-items-center">
                                {{ element.name}}
                                <b-icon icon="x-circle" scale="2" variant="danger"></b-icon>
                            </b-list-group-item>
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
                            <b-list-group-item class="d-flex justify-content-between align-items-center">
                                {{ element.name}}
                                <b-icon icon="x-circle" scale="2" variant="danger"></b-icon>
                            </b-list-group-item>

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
                            <b-list-group-item class="d-flex justify-content-between align-items-center">
                                {{ element.name}}
                                <b-icon icon="x-circle" scale="2" variant="danger"></b-icon>
                            </b-list-group-item>
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
            arrInProgress: [],
            // for new tasks
            newTask: "",
            // 4 arrays to keep track of our 4 statuses
            arrBackLog: [],
            arrTested: [],
            arrDone: []
        };
    },
    created() {
        this.fetchData()
    },
    methods: {
        //add new tasks method
        fetchData(){
            this.axios
                .get('/api/cards/')
                .then(response => {
                    this.arrBackLog = response.data;
                    console.log('yes')
                });
        },
        add: function() {
            if (this.newTask) {
                this.arrBackLog.push({ name: this.newTask });
                this.axios
                    .post('/api/cards', {name: this.newTask})
                    .then(response => (
                        console.log(this.arrInProgress)
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)

                this.newTask = "";
            }

        },
        deleteCards(id,name) {
            console.log(this.arrBackLog)

            if(id){
                this.axios
                    .delete(`/api/cards/${id}`)
                    .then(response => {
                       this.fetchData()
                    });
            }
        },
    }
};
</script>

<style>
/* light stylings for the kanban columns */
.kanban-column {
    min-height: 300px;
}
</style>
