<template>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div id="newMembers" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center " >
                            <h1> {{title}} </h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.name.length > 0}">
                            <div class="panel-default ">
                                <label>Nombre</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <input type="text" v-model="data.name"   class="form-control" >
                                  </div>
                                <small class="help-block"  >{{errors.name}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.percent_of_budget.length > 0}">
                            <div class="panel-default ">
                                <label>Porcentaje Presupuestado</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <input type="text" v-model="data.percent_of_budget"   class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.percent_of_budget}}</small>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12  text-center">
                            <div class="btn">
                                <button   v-on:click="send"  class="btn btn-success">Guardar </button>
                            </div>
                        </div>
                    </div>
                </div>
                <data-table source="/tesoreria/lists-departament" title="Lista Departamentos de la Iglesia"></data-table>
            </div>
        </div>

</template>

<script>
    import dataTable from '../Lists/ListsDepartaments.vue'
    export default {
        props: ['title','url'],
        components: {dataTable},
         data () {
             return   {
                 data: {
                     name: '',
                     percent_of_budget: '',
                },
                 errors: {
                     name: '',
                     percent_of_budget: '',
                 },
             }
         },
        methods: {
            send: function (event) {
                var self = this;
                axios.post('/tesoreria/'+self.url, this.data)
                    .then(response => {
                        if(response.data.success = true){
                    this.$alert({title: 'Se Guardo con Exito!!!',
                        message: response.data.message});
                        this.data.name= '';
                        this.data.percent_of_budget= '';
                        this.errors.name= '';
                        this.errors.percent_of_budget= '';
                        }
                }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.data;
                        if(error.response.status === 422)
                        {
                            for(var index in data)
                            {
                                var messages = '';
                                data[index].forEach( function(item){ messages += item + ' '});
                                self.errors[index] = messages;
                            }
                        }else if(error.response.status === 401){
                            self.errors.response.invalid = true;
                            self.errors.response.msg = data.msg.message;
                        }else{
                            console.log(error);
                            alert("Error generic");
                        }
                    } else if (error.request) {
                        console.log(error.request);
                        alert("Error empty");
                    } else {
                        console.log('Error', error.message);
                        alert("Error");
                    }
                });
            }
        },
    }
</script>

<style scoped>

    .mostrar {
        display: block;
    }
</style>
