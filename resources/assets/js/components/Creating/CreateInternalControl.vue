<template>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1> {{title}} </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.saturday.length > 0}">
                        <div class="panel-default ">
                            <label>Sabado</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.saturday" class="form-control">
                            </div>
                            <small class="help-block">{{errors.saturday}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.number.length > 0}">
                        <div class="panel-default ">
                            <label>Numero de Control Interno</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                <input type="number" v-model="data.number" class="form-control">
                            </div>
                            <small class="help-block">{{errors.number}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.number_of_envelopes.length > 0}">
                        <div class="panel-default ">
                            <label>Numero de Sobres</label>

                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input class="form-control" type="number" v-model="data.number_of_envelopes"/>


                            </div>
                            <small class="help-block">{{errors.number_of_envelopes}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.balance.length > 0}">
                        <div class="panel-default ">
                            <label>Total Ingresado</label>

                            <div class="input-group     custom-checkbox ">
                                <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                <input type="text" class="form-control" v-model="data.balance">
                            </div>
                            <small class="help-block">{{errors.balance}}</small>
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
                            <button :disabled="data.name === null" v-on:click="send" class="btn btn-success">Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import vSelect from "vue-select";
    import {Confirm} from '@lassehaslev/vue-confirm';
    export default {
        props: ['title', 'url', 'internal_control'],
        components: {vSelect},
        data() {
            return {
                data: {
                    saturday: '',
                    number: null,
                    number_of_envelopes: '',
                    balance: '',
                    name: null,
                    typeIC: ''
                },
                errors: {
                    saturday: '',
                    number: '',
                    number_of_envelopes: '',
                    balance: '',
                },
                formData: '',
                items: '',
                itemsNames: '',
                itemsSizes: '',
            }
        },
        computed: {
            internalControls() {
                return JSON.parse(this.internal_control)
            },
        },
        created() {
            var optionsSelect = [];
        },
        methods: {
            pdfInfo: function (data) {
                return "/tesoreria/reporte-semanal/" + data;
            },
            send: function (event) {
                console.log(this.data.selected);
                var self = this;
                axios.post('/tesoreria/' + self.url, this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            document.location = 'registro-de-ingresos/' + response.data.token;
                            this.data.saturday = '';
                            this.data.number = '';
                            this.data.number_of_envelopes = '';
                            this.data.balance = '';
                            this.errors.saturday = '';
                            this.errors.number = '';
                            this.errors.number_of_envelopes = '';
                            this.errors.balance = '';
                        }
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
                        } else if (error.response.status === 500) {
                            console.log(data);
                            for (var index in data) {
                                var messages = '';
                                data[index].forEach(function (item) {
                                    messages += item + ' '
                                });
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
            remove: function (data, index) {
                axios.post('/tesoreria/delete-internal-control', data)
                    .then(response => {
                        this.internalControls.splice(index, 1);
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
                axios.post('/tesoreria/upload-internal-control', this.formData)
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
