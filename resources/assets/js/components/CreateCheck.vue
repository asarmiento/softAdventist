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
                        <div class=" col-lg-5 col-md-5  " :class="{'has-feedback has-error':errors.name.length > 0}">
                            <div class="panel-default ">
                                <label>Nombre de Quien se dirige el Cheque</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" v-model="data.name"   class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.name}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.balance.length > 0}">
                            <div class="panel-default ">
                                <label>Monto del Cheque</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <input type="text" v-model="data.balance"   class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.balance}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number.length > 0}">
                            <div class="panel-default ">
                                <label>Numero de Cheque</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                    <input type="text" v-model="data.number"   class="form-control" >
                                  </div>
                                <small class="help-block"  >{{errors.number}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.date.length > 0}">
                            <div class="panel-default ">
                                <label>Fecha del Cheque</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                    <input type="date" v-model="data.date"   class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.date}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.bank.length > 0}">
                            <div class="panel-default ">
                                <label>Cuenta Bancaria</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                    <v-select  :options="allBanks" v-model="data.bank" placeholder="Seleccione una Cuenta"></v-select>

                                </div>
                                <small class="help-block"  >{{errors.bank}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.type.length > 0}">
                            <div class="panel-default ">
                                <label>Tipo de Cheque</label>
                                <div class="input-group " >
                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                    <v-select  :options="option" v-model="data.type"
                                               placeholder="Seleccione un Tipo de Cheque">
                                    </v-select>
                                </div>
                                <small class="help-block"  >{{errors.type}}</small>
                            </div>
                        </div>
                        <div class=" col-lg-5 col-md-5  " :class="{'has-feedback has-error':errors.detail.length > 0}">
                            <div class="panel-default ">
                                <label>Detalle del Cheque</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                    <input type="text" v-model="data.detail" class="form-control" >
                                </div>
                                <small class="help-block"  >{{errors.detail}}</small>
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
            <div class="col-md-12 col-md-offset-0">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lista de Cuentas Bancarias</h3>
                    </div>

                    <div class="panel-body">
                        <div id="demo-dt-delete_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div id="demo-dt-delete_filter" class="dataTables_filter">
                                <label>Buscar: <input type="search" class="form-control input-sm" placeholder="" aria-controls="demo-dt-delete"></label>
                            </div>
                            <table id="demo-dt-delete" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="demo-dt-delete_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 277px;"></th>
                                    <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 277px;">Numero de Cuenta</th>
                                    <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 408px;">Nombre de la cuenta</th>
                                    <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 203px;">Saldo Incial</th>
                                    <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 131px;">Debitos</th>
                                    <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 131px;">Creditos</th>
                                    <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 131px;">Balance</th>
                                    <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 131px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="check in checks" role="row" class="odd">
                                    <td class="sorting_1"><span class="btn btn-info fa fa-pencil"></span></td>
                                    <td class="">{{check.number}}</td>
                                    <td>{{check.name}}</td>
                                    <td>{{check.balance}}</td>
                                    <td>{{check.date}}</td>
                                    <td v-if="check.type === 'church'">Gastos de Iglesia</td>
                                    <td v-else>Informe Campo Local</td>
                                    <td></td>
                                    <td ><a :href="pdfInfo(check.token)"  target='_blank' class='btn btn-danger'>
                                        <i class='fa fa-file-pdf-o'></i></a></td>
                                </tr>
                                </tbody>
                            </table><div class="dataTables_info" id="demo-dt-delete_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div><div class="dataTables_paginate paging_simple_numbers" id="demo-dt-delete_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_previous"><a href="#"><i class="demo-psi-arrow-left"></i></a></li><li class="paginate_button active" aria-controls="demo-dt-delete" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">3</a></li><li class="paginate_button disabled" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_ellipsis"><a href="#">…</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_next"><a href="#"><i class="demo-psi-arrow-right"></i></a></li></ul></div></div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    import vSelect from "vue-select";
    import MultipleFileUploader from 'vue2-multi-uploader'
    export default {
        props: ['title','url','banks'],
        components: {vSelect, MultipleFileUploader},
        data () {
             return   {
                 data: {
                     number: '',
                     bank: '',
                     name: '',
                     balance: '',
                     type: '',
                     detail: '',
                     date: '',
                 },
                 errors: {
                     number: '',
                     bank: '',
                     name: '',
                     balance: '',
                     detail: '',
                     type: '',
                     date: '',
                 },
                 option: [
                     {'value':'church','label':'Gastos de Iglesia'},
                     {'value':'local_field','label':'Reporte al Campo Local'}
                 ],
                 checks:[],
             }
         },
        computed:
            {
              allBanks(){
                  return JSON.parse(this.banks);
              }
            },
        created(){
            this.$http.get('/tesoreria/lista-de-cheques').then((response) => {
                this.checks = response.data;
            });;
        },
        methods: {
            pdfInfo:function (token) {

            },
            send: function (event) {
                var self = this;
                axios.post('/tesoreria/'+self.url, this.data)
                    .then(response => {
                        if(response.data.success = true){
                            this.checks = response.data.list;
                    this.$alert({title: 'Se Guardo con Exito!!!',
                        message: response.data.message});
                        this.data.number= '';
                        this.data.name= '';
                        this.data.balance= '';
                        this.data.date= '';
                        this.data.detail= '';
                        this.data.type= '';
                        this.data.bank= '';
                        this.errors.number= '';
                        this.errors.name= '';
                        this.errors.balance= '';
                        this.errors.date= '';
                        this.errors.detail= '';
                        this.errors.type= '';
                        this.errors.bank= '';
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
