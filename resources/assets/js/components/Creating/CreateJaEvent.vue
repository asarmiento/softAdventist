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
                    <!--div-- class=" col-lg-3 col-md-3  " :class="{'has-feedback has-error':errors.code.length > 0}">
                        <div class="panel-default ">
                            <label>Cual es tu Pais</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                <v-select v-model="data.country" :on-change="localField" :options="countrys"></v-select>
                            </div>
                            <small class="help-block">{{errors.code}}</small>
                        </div>
                    </div-->
                    <div class="col-lg-3 col-md-3" :class="{'has-feedback has-error':errors.name.length > 0}">
                        <div class="panel-default ">
                            <label>Nombre </label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input v-model="data.name" class="form-control"/>
                            </div>
                            <small class="help-block">{{errors.name}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.last_name.length > 0}">
                        <div class="panel-default ">
                            <label for="name">Apellido</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-lastfm"></i></span>
                                <input id="name" type="text" v-model="data.last_name" class="form-control">
                            </div>
                            <small class="help-block">{{errors.last_name}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.age.length > 0}">
                        <div class="panel-default ">
                            <label for="age">Edad</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-lemon-o"></i></span>
                                <input id="age" type="text" v-model="data.age" class="form-control">
                            </div>
                            <small class="help-block">{{errors.age}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.email.length > 0}">
                        <div class="panel-default ">
                            <label for="email">Email</label>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="email" type="text" v-model="data.email" class="form-control">
                            </div>
                            <small class="help-block">{{errors.email}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  "
                         :class="{'has-feedback has-error':errors.launch.length > 0}">
                        <div class="panel-default ">
                            <label for="launch">Almuerzo</label>
                            <div class="input-group ">
                                <input id="launch" type="checkbox" v-model="data.launch" class="">
                            </div>
                            <small class="help-block">{{errors.launch}}</small>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3  ">
                        <div class="panel-default ">
                            <div class="input-group ">
                                <a @click="send" class="btn btn-success"><span><i class="fa fa-send"></i></span></a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="panel  col-sm-12">
                <div class="panel-body col-sm-12 table table-borderless"><strong>
                    <div class="  col-md-2">
                        Codigo Ingreso
                    </div>
                    <div class="  col-md-2">
                        Nombre Del Joven
                    </div>
                    <div class="  col-md-2">
                        Edad
                    </div>
                    <div class="  col-md-2">
                        Email
                    </div>
                    <div class="  col-md-2">
                        Si desea Almuerzo
                    </div>
                    <div class="  col-md-2">
                        Eliminar
                    </div>
                </strong>
                </div>
                <div v-for="(boy,index) in boys" class="panel-body col-sm-12 table table-borderless">
                    <div class="  col-md-2">
                        {{boy.code}}
                    </div>
                    <div class="  col-md-2">
                        {{boy.name}} {{boy.last_name}}
                    </div>
                    <div class="  col-md-2">
                        {{boy.age}}
                    </div>
                    <div class="  col-md-2">
                        {{boy.email}}
                    </div>
                    <div v-if="boy.launch" class="  col-md-2">
                        <span class="btn btn-primary"><i class="fa fa-hand-o-up"></i> Tiene Almuerzo</span>
                    </div>
                    <div v-else class=" col-md-2">
                        <span class="btn btn-danger"><i class="fa fa-hand-o-down"></i> No Tiene Almuerzo</span>
                    </div>
                    <div class=" col-md-2">
                        <a @click="remove(index, boy.id)"><span class="btn btn-danger"><i
                                class="fa fa-remove"></i> </span></a>
                    </div>
                </div>
            </div>
            <div class=" col-lg-5 col-md-5  ">
                <div class="panel-body">
                    <!--Dropzonejs using Bootstrap theme-->
                    <!--===================================================-->
                    <p>Debe subir la imagen del Deposito .</p>
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
                                                         style="width:100%;"
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
        </div>


    </div>

</template>

<script>
  import vSelect from "vue-select";
  import swal from "sweetalert2"
  // import google from "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"
  export default {
    props: ['title', 'url'],
    components: {vSelect, swal},
    data() {
      return {
        data: {
          name: '',
          last_name: '',
          age: '',
          email: '',
          launch: '',

        },
        errors: {
          name: '',
          last_name: '',
          age: '',
          email: '',
          launch: '',
        },
        boys: [],
        localfields: [],
        locations: [
          {lat: 9.43632230, lng: -84.12949780},
          {lat: 9.325817, lng: -83.951656},
        ]
      }
    },
    computed: {},
    created() {
      this.$http.get('/registrado/lista-de-inscriptos').then((response) => {
        this.boys = response.data;
      });

    },
    methods: {

      send: function (event) {


        var self = this;
        axios.post('/registrado/registered/boys', this.data)
          .then(response => {
            if (response.data.success = true
            ) {
              const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });

              toast({
                type: 'success',
                title: 'Se guardo con exito el Joven'
              })
              self.boys.push(response.data.boy);
              this.data.code = '';
              this.data.name = '';
              this.data.last_name = '';
              this.data.email = '';
              this.data.age = '';
              this.data.launch = '';

              this.errors.age = '';
              this.errors.launch = '';
              this.errors.email = '';
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
              swal("Error generic", error.response.message, 'error');
            } else {
              console.log(error);
              swal("Error generic", 'Algo a ocurrido', 'error');
            }
          } else if (error.request) {
            console.log(error.request);
            swal("Error generic", error.request, 'error');
          } else {
            console.log('Error', error.message);
            swal("Error generic", error.message, 'error');
          }
        });
      },
      remove: function (index, event) {


        var self = this;
        axios.post('/registrado/delete/boys', {'id': event})
          .then(response => {
            if (response.data.success = true
            ) {
              const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });

              toast({
                type: 'error',
                title: 'Se Borro con exito'
              })
              this.boys.splice(index, 1)
              this.data.code = '';
              this.data.name = '';
              this.data.last_name = '';
              this.errors.age = '';
              this.errors.launch = '';
              this.errors.email = '';
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
              swal("Error generic", error.response.message, 'error');
            } else {
              console.log(error);
              swal("Error generic", 'Algo a ocurrido', 'error');
            }
          } else if (error.request) {
            console.log(error.request);
            swal("Error generic", error.request, 'error');
          } else {
            console.log('Error', error.message);
            swal("Error generic", error.message, 'error');
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
        axios.post('/registrado/upload/boys', this.formData)
          .then(response => {
            this.data.file = response.data
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
    #map {
        height: 300px;
        width: 700px;
    }

    .mostrar {
        display: block;
    }
</style>
