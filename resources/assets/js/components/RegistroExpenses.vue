<template>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div id="newAccountExpense" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center " >
                            <h1> {{title}}   </h1>
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

                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.income_account_id.length > 0}">
                            <div class="panel-default ">
                                <label for="data.income_account_id">Tipo de Ingreso</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <v-select   v-model="data.income_account_id"  :options="select" ></v-select>
                                </div>
                                <small class="help-block"  >{{errors.income_account_id}}</small>
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
    import vSelect from "vue-select"
    export default {
        props: ['title','url','accounts','checks'],
        components: {vSelect},
         data () {
             return   {
                 data: {
                     name: '',
                     income_account_id: null,
                 },
                 errors: {
                     name: '',
                     income_account_id: '',
                 }
             }
         },
        computed:{
            select(){
              return  JSON.parse(this.accounts)
            },
        },
        created(){
           console.log(JSON.parse(this.accounts));
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
                        this.data.name= '';
                        this.data.income_account_id= '';
                        this.errors.name= '';
                        this.errors.income_account_id= '';
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

