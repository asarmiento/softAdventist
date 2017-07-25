<template>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel-heading">
                <div class="text-center ">
                    <h1></h1>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{title}}</h3>
                </div>
                <div class="panel-body">
                    <v-paginator :resource_url="resource_url" @update="updateResource"></v-paginator>
                </div>
            </div>

        </div>

    </div>
    </div>
</template>

<script>
    import VuePaginator from 'vuejs-paginator'
    export default {
        props: ['source','title'],
        components: {VPaginator: VuePaginator},
        data() {
            return {
                animals: [],
                resource_url: [],

            }

        },
        // Here you define the url of your paginated API
        resource_url: '',
        computed: {},
        created() {
            var self = this;
            this.$http.get('/tesoreria/lists-miembros').then((response) => {
                self.resource_url = response.data;
            });
            console.log(this.resource_url);
        },
        methods: {
            updateResource(data){
                this.animals = data
            }
        },
    }
</script>

