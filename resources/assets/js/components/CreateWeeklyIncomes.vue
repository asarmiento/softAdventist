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
                        <div class=" col-lg-3 col-md-3  ">
                            <h3>Control Interno # <strong class="blue">{{rows.number}}</strong> </h3>
                        </div>
                        <div class=" col-lg-3 col-md-3  ">
                            <h3>Total Registrado <strong> {{rows.balance}}</strong> Colones</h3>
                        </div>
                        <div class=" col-lg-3 col-md-3  ">
                            <h3>En <strong>{{rows.number_of_envelopes}} </strong> sobres de Diezmos y ofrendas</h3>
                        </div>
                        <div class=" col-lg-3 col-md-3  ">
                            <h3>El sabado <strong>{{rows.saturday}}</strong> </h3>
                        </div>
                        <div class=" col-lg-12 col-md-12  ">
                            <hr> </hr>
                            <hr> </hr>
                        </div>
                        <div class=" col-lg-3 col-md-3 " :class="{'has-feedback has-error':errors.saturday.length > 0}">
                            <div class="panel-default ">
                                <label>Nombre del Sobre de Diezmos</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <v-select v-model="data.member_id" :options="dataMembers"></v-select>
                                  </div>
                                <small class="help-block"  >{{errors.saturday}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number.length > 0}">
                            <div class="panel-default ">
                                <label>Numero de Sobre</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                    <input type="number" v-model="data.envelope_number"   class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.number}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number.length > 0}">
                            <div class="panel-default ">
                                <label>Diezmos</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                    <input type="number" v-model="data.envelope_number"   class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.number}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number.length > 0}">
                            <div class="panel-default ">
                                <label>Ofrendas</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                    <input type="number" v-model="data.envelope_number"   class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.number}}</small>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-6 col-lg-4 eq-box-lg">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Ingresos para el Campo Local   </h3>

                                    </div>
                                    <div class="panel-body">

                                        <!--Large-->
                                        <!--===================================================-->
                                        <div class="list-group">


                                            <div class="list-group-item list-item-lg" >
                                                <input type="text" id="demo-vs-definput" v-model="data.envelope_number"   class="form-control border" >
                                                <v-select v-model="data.member_id" :options="dataMembers"></v-select>
                                                <a class="demo-icon btn btn-success"><i class="fa fa-plus"></i> <span> </span> Agregar</a>
                                            </div>
                                            <div class="list-group-item list-item-lg" ><label class="left " style="width: 60%">Prioridades</label>
                                                <label style="width: 20%" class="right">1500.00</label>
                                                <a style="width: 10%" class="btn btn-danger"><span class="fa fa-remove"></span></a></div>
                                        </div>
                                        <!--===================================================-->

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 eq-box-lg">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Otros Ingresos para la Iglesia</h3>
                                    </div>
                                    <div class="panel-body">

                                        <!--Large-->
                                        <!--===================================================-->
                                        <div class="list-group">
                                            <div class="list-group-item list-item-lg" >
                                                <input type="text"  v-model="data.envelope_number"   class="form-control border" >
                                                <v-select v-model="data.member_id" :options="dataMembers"></v-select>
                                                <a class="demo-icon btn btn-success"><i class="fa fa-plus"></i> <span> </span> Agregar</a>
                                            </div>
                                            <div class="list-group-item list-item-lg" ><label style="width: 60%">Material Escuela Sab.</label>
                                                <label style="width: 20%">2500.00</label>
                                                <a style="width: 10%" class="btn btn-danger"><span class="fa fa-remove"></span></a></div>
                                       </div>
                                        <!--===================================================-->

                                    </div>
                                </div>
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
        props: ['title','url','internalcontrol','members'],
        components: {vSelect},
         data () {
             return   {
                 data: {
                     saturday: '',
                     members: null,
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
            rows(){
              return JSON.parse(this.internalcontrol)
            },
           dataMembers(){
               return JSON.parse(this.members)
           },
        },
        created(){

                console.log(typeof(this.internalcontrol));
        },
        methods: {
            send: function (event) {

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
