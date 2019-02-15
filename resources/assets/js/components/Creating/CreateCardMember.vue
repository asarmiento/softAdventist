<template>

    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1>Registrar Clases Progresivas </h1>
                    </div>
                </div>
                <div class="panel-body">
                    <div class=" col-lg-6 col-md-6 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Miembro </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select v-model="data.member" :options="listMembers"></v-select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 col-md-12 col-xs-12 ">
                    <div class=" col-lg-12 col-md-12 col-xs-12 ">
                        <div class="box ">
                            <div class="input-group col-md-4">
                                <label style="color:#106BA0;font-size: 16px">Tarjeta de Amigo </label>
                                <input type="checkbox" v-model="data.cardA" class="amigo">
                                <img src="/img/Botones/Amigo.gif" class="responsive " width="30" height="30" >
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group col-md-3">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateA" class="form-control">
                            </div>
                            <div class="col-md-4 amigo">
                                <label for="amigo">Adjunte su tarjeta de Amigo </label>
                                <input type="file" id="amigo" >
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 col-md-12 col-xs-12  ">
                        <div class="panel-default ">
                            <div class="input-group  col-md-4">
                                <label style="color:#a01c27 ; font-size: 16px">Tarjeta de Compañero</label>
                                <input type="checkbox" v-model="data.cardC">
                                <img src="/img/Botones/Compañero.gif" class="responsive " width="30" height="30" >
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group  col-md-3">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateC" class="form-control">
                            </div>
                            <div class="input-group companero  col-md-3">
                                <label for="companero">Adjunte su tarjeta de Compañero </label>
                                <input type="file" id="companero">
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 col-md-12 col-xs-12  ">
                        <div class="panel-default ">
                            <div class="input-group  col-md-4">
                                <label style="font-size: 16px; color: #186e37">Tarjeta de Explorador</label>
                                <input type="checkbox" v-model="data.cardE">
                                <img src="/img/Botones/Explorador.gif" class="responsive " width="30" height="30" >
                                </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group col-md-3">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateE" class="form-control">
                            </div>
                            <div class="input-group col-md-3 explorador">
                                <label for="explorador">Adjunte su tarjeta de Explorador </label>
                                <input type="file" id="explorador" >
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 col-md-12 col-xs-12 ">
                        <div class="panel-default ">
                             <div class="input-group col-md-4">
                                 <label style="font-size: 16px; color: #111723">Tarjeta Orientador</label>
                                 <input type="checkbox" v-model="data.cardO">
                                <img src="/img/Botones/Orientador.gif" class="responsive " width="30" height="30" >
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group col-md-3">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateO" class="form-control">
                            </div>
                            <div class="input-group col-md-3 orientador">
                                <label for="orientador">Adjunte su tarjeta de Orientador </label>
                                <input type="file" id="orientador" >
                            </div>
                        </div>
                    </div>
                    <div class="  col-lg-12 col-md-12 col-xs-12   ">
                        <div class="panel-default ">
                            <div class="input-group col-md-4 col-xs-12">
                                <label style="font-size: 16px; color: #811eac">Tarjeta de Viajero</label>
                                <input type="checkbox" v-model="data.cardV">
                                <img src="/img/Botones/Viajero.gif" class="responsive " width="30" height="30" >
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group col-md-3  col-xs-12">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateV" class="form-control">
                            </div>
                            <div class="input-group col-md-3  col-xs-12 viajero">
                                <label for="viajero">Adjunte su tarjeta de Viajero </label>
                                <input type="file" id="viajero" >
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12 col-md-12 col-xs-12  ">
                        <div class="panel-default col-md-4  col-xs-12 ">
                            <div class="input-group">
                                <label style="color:#0f023f; font-size: 16px; ">Tarjeta de Guia</label>
                                <input type="checkbox" v-model="data.cardG">
                                <img src="/img/Botones/Guia.gif" class="responsive " width="30" height="30" >
                            </div>
                            <label>Fecha de Investidura</label>
                            <div class="input-group col-md-3  col-xs-12">
                                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input type="date" v-model="data.dateG" class="form-control">
                            </div>
                            <div class="input-group guia col-md-3  col-xs-12">
                                <label for="guia">Adjunte su tarjeta de Guia </label>
                                <input type="file" id="guia"  name="items" >
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
                    </div>

                </div>
                </div>
                <div class="col-lg-12 col-md-12  text-center">
                    <div class="btn">
                        <button v-on:click="send" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vSelect from "vue-select";
    import Swal from 'sweetalert2'
    import myDatepicker from "vue-datepicker";

    export default {
        components: {vSelect, myDatepicker, Swal},
        data() {
            return {
                data: {
                    member: '',
                    dateA: '',
                    cardA: false,
                    dateC: '',
                    cardC: false,
                    dateE: '',
                    cardE: false,
                    dateO: '',
                    cardO: false,
                    dateV: '',
                    cardV: false,
                    dateG: '',
                    cardG: false,
                },
                txtSearch: '',
                counts: ['5', '10', '20', '50'],
                datos: [],
                my_pages: [],
                columns: [],
                typeAll: true,
                typeStyle: true,
                listMembers: [],
                club_directors: "",
                cards: [],
                formData: '',
                guia: '',
                itemsNames: '',
                itemsSizes: '',
            }
        }, created() {
            this.$http.get('/softadventist/lista-miembros-select').then((response) => {
                this.listMembers = response.data;

            });


        },
        methods: {

            send: function (event) {

                axios.post('/softadventist/save-miembros-card-club', this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            Swal('Se Guardo con Exito!!!', response.data.message, 'success');
                            this.data.member = '';
                            this.data.cardA = false;
                            this.data.cardC = false;
                            this.data.cardE = false;
                            this.data.cardO = false;
                            this.data.cardV = false;
                            this.data.cardG = false;
                        }
                    })
                    .catch(function (error) {
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
            }
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
            axios.post('/softadventist/upload-internal-control', this.formData)
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

    }
</script>

<style>

    .mostrar {
        display: block;
    }

    .material {
        z-index: 5;
    }
     #amigo {
         background-color: #106BA0;
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;

    }
    label[for=" amigo"] {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        background-color: #106BA0;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }
    .amigo{
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        margin: 5px;
        background-color: #106BA0;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }

    #companero {
        background-color: #a01c27;
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;

    }
    label[for=" companero"] {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        background-color: #a01c27;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }
    .companero{
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        margin: 5px;
        background-color: #a01c27;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }  #explorador {
        background-color: #186e37;
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;

    }
    label[for=" explorador"] {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        background-color: #186e37;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }
    .explorador{
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        margin: 5px;
        background-color: #186e37;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }
#orientador {
        background-color: #c2c2c4;
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;

    }
    label[for=" orientador"] {
        font-size: 14px;
        font-weight: 600;
        color: #0f023f;
        background-color: #c2c2c4;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }
    .orientador{
        font-size: 14px;
        font-weight: 600;
        color: #0f023f;
        margin: 5px;
        background-color: #c2c2c4;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }
    #viajero {
        background-color: #6f117f;
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;

    }
    label[for=" viajero"] {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        background-color: #6f117f;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }
    .viajero{
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        margin: 5px;
        background-color: #6f117f;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }#guia {
        background-color: #dedf3d;
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;

    }
    label[for=" guia"] {
        font-size: 14px;
        font-weight: 600;
        color: #0f023f;
        background-color: #dedf3d;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }
    .guia{
        font-size: 14px;
        font-weight: 600;
        color: #0f023f;
        margin: 5px;
        background-color: #dedf3d;
        display: inline-block;
        transition: all .5s;
        cursor: pointer;
        padding: 15px 40px !important;
        text-transform: uppercase;
        width: fit-content;
        text-align: center;
    }

    @media only screen and (min-width: 320px) {
        #sale-otro-table {
            display: none;
        }

        #sale-pc-table {
            display: block;
        }

        h1, h2 {
            font-size: 18px;
        }

    }

    /* Small devices (landscape phones, 576px and up)*/
    @media (min-width: 576px) {
        #sale-otro-table {
            display: none;
        }

        #sale-pc-table {
            display: block;
        }
    }

    /* Medium devices (tablets, 768px and up)*/
    @media (min-width: 768px) {
        #sale-otro-table {
            display: block;
        }

        #sale-pc-table {
            display: none;
        }
    }

    /* Large devices (desktops, 992px and up)*/
    @media (min-width: 992px) {
        #sale-otro-table {
            display: block;
        }

        #sale-pc-table {
            display: none;
        }
    }

    /* Extra large devices (large desktops, 1200px and up)*/
    @media (min-width: 1200px) {
        #sale-otro-table {
            display: block;
        }

        h1, h2 {
            font-size: 28px;
            text-align: center;
        }

        #sale-pc-table {
            display: none;
        }
    }
</style>
