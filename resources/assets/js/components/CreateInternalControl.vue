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
                        <div class=" col-lg-5 col-md-5  ">
                            <div class="panel-body">
                                <!--Dropzonejs using Bootstrap theme-->
                                <!--===================================================-->
                                <p>Debe subir la imagen del control interno firmado.</p>
                                <div class="bord-top pad-ver">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-file btn-success fileinput-button dz-clickable">
					                <i class="fa fa-plus"></i>
					                Buscar Archivo...
                                     <input type="file" id="items" @change="onChange"
                                            name="items">
					            </span>
                                    <div class="btn-group pull-right">
                                        <button id="dz-upload-btn" @click="onSubmit" class="btn btn-primary" type="submit">
                                            <i class="fa fa-upload-cloud"></i> subir
                                        </button>
                                    </div>
                                </div>
                                <div id="dz-previews">
                                    <div id="" class="pad-top bord-top dz-image-preview">
                                        <div class="media" v-if="itemsNames">
                                            <div class="media-body">
                                                <!--This is used as the file preview template-->
                                                <div class="media-block">
                                                    <div class="media-body">
                                                        <p class="text-main text-bold mar-no text-overflow" data-dz-name="">
                                                            {{itemsNames}}</p>
                                                        <span class="dz-error text-danger text-sm"
                                                              data-dz-errormessage=""></span>
                                                        <p class="text-sm" data-dz-size=""><strong>{{itemsSizes}}</strong>
                                                        </p>
                                                        <div id="dz-total-progress" style="opacity:50">
                                                            <div class="progress progress-xs active" role="progressbar"
                                                                 aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                                <div class="progress-bar progress-bar-success"
                                                                     style="width:15%;"
                                                                     data-dz-uploadprogress=""></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-right">
                                                <button data-dz-remove="" @click="removeItems"
                                                        class="btn btn-xs btn-danger dz-cancel">
                                                    <i class="demo-pli-cross"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Dropzonejs using Bootstrap theme-->
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12  text-center">
                            <div class="btn">
                                <button  :disabled="data.name === null"  v-on:click="send"  class="btn btn-success">Guardar </button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>


            <div class="col-md-12 col-md-offset-0">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de Controles Internos</h3>
                </div>

                <div class="panel-body">
                    <div id="demo-dt-delete_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div id="demo-dt-delete_filter" class="dataTables_filter">
                            <label>Buscar: <input type="search" class="form-control input-sm" placeholder="" aria-controls="demo-dt-delete"></label>
                        </div>
                        <table id="demo-dt-delete" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="demo-dt-delete_info" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 277px;">Eliminar</th>
                                <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 277px;">Sabado</th>
                                <th class="sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 408px;">Numero de Sobres</th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 203px;">Total Ingresado</th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 131px;">Estado</th>
                                <th class="min-tablet sorting" tabindex="0" aria-controls="demo-dt-delete" rowspan="1" colspan="1" aria-label="Extn.: activate to sort column ascending" style="width: 131px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(control,index) in internalControls" role="row" class="odd">
                                <td class="sorting_1">
                                    <a v-if="control.status === 'no aplicado'" @click="remove(control,index)" ><span class="btn btn-danger fa fa-remove"></span></a>
                                </td>
                                <td class="">{{control.saturday}}</td>
                                <td>{{control.number_of_envelopes}}</td>
                                <td>{{control.balance}}</td>
                                <td>{{control.status}}</td>
                                <td ><a :href="pdfInfo(control.saturday)"  target='_blank' class='btn btn-danger'>
                                    <i class='fa fa-file-pdf-o'></i></a></td>
                            </tr>
                        </tbody>
                    </table><div class="dataTables_info" id="demo-dt-delete_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div><div class="dataTables_paginate paging_simple_numbers" id="demo-dt-delete_paginate"><ul class="pagination"><li class="paginate_button previous disabled" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_previous"><a href="#"><i class="demo-psi-arrow-left"></i></a></li><li class="paginate_button active" aria-controls="demo-dt-delete" tabindex="0"><a href="#">1</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">2</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">3</a></li><li class="paginate_button disabled" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_ellipsis"><a href="#">…</a></li><li class="paginate_button " aria-controls="demo-dt-delete" tabindex="0"><a href="#">6</a></li><li class="paginate_button next" aria-controls="demo-dt-delete" tabindex="0" id="demo-dt-delete_next"><a href="#"><i class="demo-psi-arrow-right"></i></a></li></ul></div></div>
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
        props: ['title','url','internal_control'],
        components: {vSelect},
         data () {
             return   {
                 data: {
                     saturday: '',
                     number: null,
                     number_of_envelopes:'',
                     balance:'',
                     name:null,
                     typeIC:''
                 },
                 errors: {
                     saturday: '',
                     number: '',
                     number_of_envelopes:'',
                     balance:'',
                 },
                 formData: '',
                 items: '',
                 itemsNames: '',
                 itemsSizes: '',
             }
         },
       computed:{
           internalControls(){
              return  JSON.parse(this.internal_control)
            },
        },
        created(){
            var optionsSelect = [];
               // console.log(JSON.parse(this.internal_control));
        },
        methods: {
            pdfInfo: function (data) {
                 return "/tesoreria/reporte-semanal/"+data;
            },
            send: function (event) {
                console.log(this.data.selected);
                var self = this;
                axios.post('/tesoreria/'+self.url, this.data)
                    .then(response => {
                        if(response.data.success = true){
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
            },
            remove: function (data,index) {
                axios.post('/tesoreria/delete-internal-control', data)
                    .then(response => {
                        this.internalControls.splice(index,1);
                        this.$alert({
                            title: 'Se Elimino con Exito!!!',
                            message: response.data
                        });
                    }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.data;
                        if (error.response.status === 422) {
                            for (var index in data) {
                                var messages = '';
                                data[index].forEach(function (item) {
                                    messages += item + ' '
                                });
                                self.errors[index] = messages;
                            }
                        } else if (error.response.status === 401) {
                            self.errors.response.invalid = true;
                            self.errors.response.msg = data.msg.message;
                        } else {
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
            },
            bytesToSize(bytes) {
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes === 0) return 'n/a';
                let i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                if (i === 0) return bytes + ' ' + sizes[i];
                return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
            },
            onChange(e) {
                this.formData = new FormData();
                let files = e.target.files || e.dataTransfer.files;
                let fileSizes = 0;
                for (let fileIn in files) {
                    if (!isNaN(fileIn)) {
                        this.items = e.target.files[fileIn] || e.dataTransfer.files[fileIn];
                        this.itemsNames = files[fileIn].name;
                        this.data.typeIC = files[fileIn].type;
                        this.itemsSizes = this.bytesToSize(files[fileIn].size);
                        fileSizes = files[fileIn].size;
                        this.formData.append('items', this.items);
                        console.log(files[fileIn])
                    }
                }
            },
            removeItems() {
                this.items = '';
                this.itemsNames = '';
                this.itemsSizes = '';
            },
            onSubmit() {
                axios.post('http://softadventist.dev/tesoreria/upload-internal-control', this.formData)
                    .then(response => {
                        this.data.name = response.data
                        console.log(response.data)
                    }).catch(function (error) {
                    if (error.response) {
                        let data = error.response.data;
                        if (error.response.status === 422) {
                            for (var index in data) {
                                var messages = '';
                                data[index].forEach(function (item) {
                                    messages += item + ' '
                                });
                                self.errors[index] = messages;
                            }
                        } else if (error.response.status === 401) {
                            self.errors.response.invalid = true;
                            self.errors.response.msg = data.msg.message;
                        } else {
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
            },
        },
    }
</script>

<style scoped>


</style>
