<template>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div id="newMembers" class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center ">
                        <h1>Registrar Especialidades </h1>
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
                    <div class=" col-lg-6 col-md-6 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Especialidad </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select v-model="data.specialty" :options="specialites"></v-select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-6 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Instructor </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <v-select v-model="data.member_in_club" :options="instructores"></v-select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-6 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Otro Instructor </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input v-model="data.other_instructor" class="form-control" type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-6 col-md-6 col-xs-12 ">
                        <div class="panel-default ">
                            <label>Fecha de Finalización</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                <input v-model="data.date" type="date"/>
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
                    other_instructor: '',
                    date: '',
                    specialty: '',
                    member_in_club: '',
                },
                txtSearch: '',
                counts: ['5', '10', '20', '50'],
                datos: [],
                my_pages: [],
                columns: [],
                typeAll: true,
                typeStyle: true,
                listMembers: [],
                specialites: [],
                instructores: [],
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
            this.$http.get('/softadventist/lista-de-especialidades-select').then((response) => {
                this.specialites = response.data;

            });
            this.$http.get('/softadventist/lista-de-instructores-select').then((response) => {
                this.instructores = response.data;

            });
            this.$http.get('/softadventist/code-liderjuvenil').then((response) => {
                this.data.codelj = response.data;

            });


        },
        methods: {

            send: function (event) {

                axios.post('/softadventist/save-especiality-member', this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            Swal(response.data.message, 'Puede Seguir agregando información', 'success');
                            this.member = '';
                            this.other_instructor = '';
                            this.date = '';
                            this.specialty = '';
                            this.member_in_club = '';
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
                                Swal('!Ooop', error.response.data.message, 'error');
                            } else if (error.response.status === 401) {
                                Swal('!Ooop', error.response.data.message, 'error');
                            } else if (error.response.status === 500) {
                                Swal('!Ooop', error.response.data.message, 'error');
                            }
                        } else if (error.request) {
                            Swal('!Ooop', error.response.data.message, 'error');
                        } else {
                            Swal('!Ooop', error.response.data.message, 'error');
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

    .amigo {
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

    .companero {
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
    }

    #explorador {
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

    .explorador {
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

    .orientador {
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

    .viajero {
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
    }

    #guia {
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

    .guia {
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
