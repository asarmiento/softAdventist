<template>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div id="newMembers" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center " >
                            <h1> {{title}}   </h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.saturday.length > 0}">
                            <div class="panel-default ">
                                <label>Sabado</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input type="date" v-model="data.saturday"   class="form-control" >
                                  </div>
                                <small class="help-block"  >{{errors.saturday}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number.length > 0}">
                            <div class="panel-default ">
                                <label>Numero de Control Interno</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                    <input type="number" v-model="data.number"   class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.number}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number_of_envelopes.length > 0}">
                            <div class="panel-default ">
                                <label>Numero de Sobres</label>

                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <input class="form-control" type="number"  v-model="data.number_of_envelopes"  />


                                </div>
                                <small class="help-block"  >{{errors.number_of_envelopes}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.balance.length > 0}">
                            <div class="panel-default ">
                                <label>Total Ingresado</label>

                                <div class="input-group     custom-checkbox " >
                                    <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                    <input type="text" class="form-control"   v-model="data.balance">
                                 </div>
                                <small class="help-block"  >{{errors.balance}}</small>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12  text-center">
                            <div class="btn">
                                <button   v-on:click="send"  class="btn btn-success">Guardar </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    import vSelect from "vue-select";
    import { Confirm } from '@lassehaslev/vue-confirm';
    export default {
        props: ['title','url'],
        components: {vSelect},
         data () {
             return   {
                 data: {
                     saturday: '',
                     number: null,
                     number_of_envelopes:'',
                     balance:'',
                 },
                 errors: {
                     saturday: '',
                     number: '',
                     number_of_envelopes:'',
                     balance:'',
                 }
             }
         },
       computed:{
            select(){
             // return  JSON.parse(this.contents)
            },
        },
        created(){
            var optionsSelect = [];
               // console.log(JSON.parse(this.contents));
        },
        methods: {
            send: function (event) {
                console.log(this.data.selected);
                var self = this;
                axios.post('/tesoreria/'+self.url, this.data)
                    .then(response => {
                        if(response.data.success = true){
                    this.$alert({title: 'Se Guardo con Exito!!!',
                        message: response.data.message});
                        document.location = 'registro-de-ingresos/'+response.data.token;
                        this.data.saturday= '';
                        this.data.number= '';
                        this.data.number_of_envelopes= '';
                        this.data.balance= '';
                        this.errors.saturday= '';
                        this.errors.number= '';
                        this.errors.number_of_envelopes= '';
                        this.errors.balance= '';
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
                        }else if(error.response.status === 500)
                        {
                            console.log(data);
                            for(var index in data)
                            {
                                var messages = '';
                                data[index].forEach( function(item){ messages += item + ' '});
                                self.errors[index] = messages;
                            }
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


</style>
