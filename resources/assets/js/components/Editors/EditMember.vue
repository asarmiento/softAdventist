<template>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div id="newMembers" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center " >
                            <h1 >Nuevo de Miembro </h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Cédula <strong style="background: red" >*</strong></label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                                    <input type="text" v-model="data.charter"  class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Nombres <strong style="color: red" >*</strong></label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" v-model="data.name" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Apellidos <strong style="color: red" >*</strong></label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                    <input type="text" v-model="data.last" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Fecha Bautizmo</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="date" v-model="data.bautizmoDate" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Fecha Nacimiento</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input type="date" v-model="data.birthdate" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Telefono</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" v-model="data.phone" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Celular</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                    <input type="text" v-model="data.cell" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Email</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                    <input type="text" v-model="data.email" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default material">
                                <label>Estado Civil <strong style="color: red" >*</strong></label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                    <v-select type="text" v-model="data.civil_status" :options="civil" class="form-control" ></v-select>
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default material">
                                <label>Miembro del Club?</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                    <select v-model="data.club"  class="form-control">
                                        <option value="false">No</option>
                                        <option value="true">Si</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default material">
                                <label>Tipo de Sangre </label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                    <input type="text" v-model="data.blood_type" class="form-control" maxlength="3" > </div>
                            </div>
                        </div>
                        <div class=" col-lg-3 col-md-3 ">
                            <div class="panel-default ">
                                <label>Dirección</label>
                                <div class="input-group" >
                                    <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                    <input type="text" v-model="data.address" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12  text-center">
                            <div class="btn">
                                <button   v-on:click="send"  class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    import vSelect from "vue-select";
    import Swal from 'sweetalert2'
    import myDatepicker  from "vue-datepicker";

    export default {
        props:['members'],
        components: {vSelect, myDatepicker,Swal},
        data () {
                 return   {
                     data: {
                         charter: '',
                         name: '',
                         last: '',
                         bautizmoDate: '',
                         birthdate: '',
                         address: '',
                         civil_status: '',
                         phone: '',
                         cell: '',
                         blood_type: '',
                         email: '',
                         club: false,
                         id: '',
                         church_id: '',
                     },
                     civil:[
                         {"label":'Casado(a)',"value":'Casado(a)'},
                         {"label":'Soltero(a)',"value":'Soltero(a)'},
                         {"label":'Divorciado(a)',"value":'Divorciado(a)'},
                         {"label":'Viudo(a)',"value":'Viudo(a)'},
                         {"label":'Union Libre',"value":'Union Libre'},

                     ],

                 }
            },
        created(){
                console.log(this.member);

                this.data.charter = this.member.charter;
                this.data.id = this.member.id;
                this.data.name = this.member.name;
                this.data.last = this.member.last;
                this.data.bautizmoDate = this.member.bautizmoDate;
                this.data.birthdate = this.member.birthdate;
                this.data.address = this.member.address;
                this.data.phone = this.member.phone;
                this.data.blood_type = this.member.blood_type;
                this.data.cell = this.member.cell;
                this.data.user_id = this.member.user_id;
                this.data.church_id = this.member.church_id;
                this.data.email = this.member.email;
            this.data.club = this.member.club;
                this.data.civil_status = {"label":this.member.civil_status,"value":this.member.civil_status};
        },
        computed: {
            member() {
                return JSON.parse(this.members);
            }
            },
        methods: {

            send: function (event) {
                if(this.data.civil_status === ""){
                    Swal('Debe Elegir un Estado Civil', 'No se puede proceder','error');
                    return false;
                }
                axios.post('/softadventist/update-miembros', this.data)
                    .then(response => {
                        if(response.data.success = true){
                            if(Swal('Se Guardo con Exito!!!', response.data.message,'success')){
                                document.location = "/softadventist/lista-miembros";
                            }

                        }
                    })
                .catch(function (error) {
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

<style >

    .mostrar {
        display: block;
    }
    .material{
        z-index: 5;
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
