<template>

    <!---------------------------------->
    <div class="row">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-6 text-xs-center">
                    <div  style="height: 50px">
                            <label class="control-label">Mostrar por pagina: </label>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"
                                        aria-expanded="false">{{ datos.per_page }} <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li v-for="count in counts" v-if="count === datos.per_page" class="active">
                                        <a href="" @click.prevent="perPage(datos.path,count)">{{count}}</a>
                                    </li>
                                    <li v-else><a @click.prevent="perPage(datos.path,count)"
                                                  href="">{{count}}</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-5 ">
                                <div class="dataTables_info " id="" role="status"
                                     aria-live="polite">
                                    Mirando {{datos.from}} al {{datos.to}} de {{datos.total}} Filas
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-sm-6 text-xs-center text-right">
                    <div  style="height: 50px">
                    <div class="  pull-right">
                        <ul v-if="my_pages.length > 1" class="pagination pull-right">
                            <li v-show="datos.prev_page_url" class="footable-page-arrow disabled">
                                <a data-page="prev" href="#"
                                   @click.prevent="pagePre(datos.prev_page_url)">‹</a></li>
                            <li v-for="number in my_pages" class="footable-page"
                                :class="{'active': number == datos.current_page}">
                                <a class="" href="" @click.prevent="page(datos.path,number)">{{ number
                                    }}</a>
                            </li>
                            <li v-show="datos.next_page_url" class="footable-page-arrow">
                                <a @click.prevent="pageNext(datos.next_page_url)" data-page="next"
                                   href="#next">›</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-sm-12 input-group text-right search">
                         <input type="text" @keyup="search(datos.path)"
                               placeholder="Puede buscar aqui por: Iglesia, Miembro"
                               name="search" v-model="txtSearch" class="form-control input-lg">

                </div>
            </div>
        </div>

        <div class="col-md-12 ">

        </div>

        <div v-if="campo" class="panel-group accordion" id="demo-acc-mix">
            <div class="panel panel-success " v-for="(items, index) in datos.data">

                <!--Accordion title-->
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-parent="#accordion" data-toggle="collapse" :href="items.url">{{items.name}}</a>
                    </h4>
                </div>

                <!--Accordion content-->
                <div class="panel-collapse collapse in" :id="(items.name)">
                    <div class="panel-body">
                        <div  class="col-sm-4 col-md-3" v-for="itemes in items.members_c">


                            <!-- Contact Widget -->
                            <!---------------------------------->
                            <div class="panel pos-rel">
                                <div class="pad-all text-center">

                                    <div class="widget-control">
                                        <a href="#" class="add-tooltip btn btn-trans" data-original-title="Favorite">
                                            <span class="favorite-color text-lg"><i class="demo-psi-star"></i></span>

                                        </a>
                                        <a href="#" class="add-tooltip btn btn-trans">

                                        </a>
                                        <div class="btn-group dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown"
                                               aria-expanded="false">
                                                <i class="pci-ver-dots"></i></a>
                                            <ul  class="dropdown-menu dropdown-menu-right" style="">
                                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <a href="#">
                                        <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="/img/profile-photos/2.png">
                                        <p class="text-lg text-semibold mar-no text-main">{{(itemes.name)}} {{(itemes.last)}}</p>
                                        <p class="text-sm"><a href="/softadventist/perfile-clubes">Lista de Especialidades</a></p>
                                    </a>
                                    <div class="pad-top btn-groups" v-if="itemes.member_club">
                                        <a href="#" v-for="card in itemes.member_club" class="btn btn-icon  icon-lg add-tooltip"
                                           data-container="body">
                                            <img v-for="buttonT in card.club" :src="urlButton(buttonT)" width="50" height="50">
                                        </br><i v-if="card.code_gm"  >Código Guia: {{card.code_gm}}</i>
                                            </br>    <i v-if="card.code_lj" >Código Lider: {{card.code_lj}}</i>
                                        </a>


                                    </div>
                                </div>
                            </div>
                            <!---------------------------------->


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div v-else class="col-sm-4 col-md-3" v-for="items in datos.data">


            <!-- Contact Widget -->
            <!---------------------------------->
            <div class="panel pos-rel">
                <div class="pad-all text-center">

                    <div class="widget-control">
                        <a href="#" class="add-tooltip btn btn-trans" data-original-title="Favorite">
                            <span class="favorite-color text-lg"><i class="demo-psi-star"></i></span>

                        </a>
                        <a href="#" class="add-tooltip btn btn-trans">

                        </a>
                        <div class="btn-group dropdown">
                            <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="pci-ver-dots"></i></a>
                            <ul  class="dropdown-menu dropdown-menu-right" style="">
                                <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>
                           </ul>
                        </div>
                    </div>

                    <a href="#">
                        <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="/img/profile-photos/2.png">
                        <p class="text-lg text-semibold mar-no text-main">{{(items.member)}}</p>
                        <p class="text-sm">Iglesia: {{items.church}}</p>
                        <p class="text-sm"><a href="/softadventist/perfile-clubes">Lista de Especialidades</a></p>
                    </a>
                    <div class="pad-top btn-groups" v-if="items.club">
                        <a href="#" v-for="card in items.club" class="btn btn-icon  icon-lg add-tooltip"
                           data-container="body">
                            <img :src="urlButton(card)" width="50" height="50">
                        </a>

                    </div>
                </div>
            </div>
            <!---------------------------------->


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
                    name: '',
                    last_name: '',
                    address: '',
                    phone: '',
                    email: '',
                },
                txtSearch: '',
                counts: [
                    "10",
                    "20",
                    "50",
                    "100",
                    "500",
                ],
                datos: [],
                my_pages: [],
                per_page: 10,
                columns: [],
                typeAll: true,
                typeStyle: true,
                campo: false,
                }
        },
        created() {

            var self = this;
            this.$http.get("/data-member-tarjetas-public").then((response) => {
                self.datos = response.data.model;

                self.campo = response.data.campo;
               // self.my_pages = response.data.my_pages;
               // self.columns = response.data.columns;
            });
        },
        methods: {

            reducir (card) {


               return card.substr(1);
            },
            urlButton(card) {

                return "/img/Botones/" + card.url_card;
            },
            nameComplate(member) {
                return member;
            },
            send: function (event) {
                axios.post('/softadventist/save-visitor', this.data)
                    .then(response => {
                        if (response.data.success = true) {
                            Swal('Se Guardo con Exito!!!', response.data.message, 'success');

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


                                for (var index in data) {
                                    var messages = '';
                                    data[index].forEach(function (item) {
                                        messages += item + ' '
                                    });
                                    self.errors[index] = messages;
                                }
                            }
                        } else if (error.request) {
                             alert("Error empty");
                        } else {
                              alert("Error");
                        }
                    });
            },
            search: function (url) {
                var self = this;
                this.$http.get(url + "?search=" + this.txtSearch).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            },
            pagePre(url) {
                url += "&perPage=" + this.datos.per_page;
                url += "&search=" + this.txtSearch;
                var self = this;
                this.$http.get(url).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            },
            pageNext(url) {
                url += "&perPage=" + this.datos.per_page;
                url += "&search=" + this.txtSearch;
                var self = this;
                this.$http.get(url).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            },
            page(url, number) {
                if (!isNaN(number)) {
                    var self = this;
                    url += "?page=" + number;
                    url += "&perPage=" + this.datos.per_page;
                    url += "&search=" + this.txtSearch;
                    this.$http.get(url).then((response) => {
                        self.datos = response.data.model;
                        self.my_pages = response.data.my_pages;
                    });
                }
            },
            perPage(url, number) {
                console.log(number);
                var self = this;
                this.$http.get(url + "?perPage=" + number + "&search=" + this.txtSearch).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            },
            all(url, total) {
                var self = this;
                if (this.typeAll) {
                    this.typeAll = false;
                } else {
                    this.typeAll = true;
                }
                this.$http.get(url + "?all=" + total + "&search=" + this.txtSearch).then((response) => {
                    self.datos = response.data.model;
                    self.my_pages = response.data.my_pages;
                });
            }

        },


    }
</script>

<style>

    .mostrar {
        display: block;
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
