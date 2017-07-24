<template>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel-heading">
                <div class="text-center ">
                    <h1> {{title}} </h1>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de gastos sin Cheques</h3>
                </div>

                <div class="panel-body">
                    <div id="demo-dt-delete_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table id="demo-dt-delete"
                               class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0"
                               width="100%" role="grid" aria-describedby="demo-dt-delete_info" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th class="sorting">Numero de Factura</th>
                                <th class="sorting">Fecha de registro</th>
                                <th class="min-tablet sorting">Detalle</th>
                                <th class="min-tablet sorting">Cuenta</th>
                                <th class="min-tablet sorting">Monto</th>
                                <th class="min-tablet sorting"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="expense in expenses" role="row" class="odd">
                                <td class="">{{expense.number}}</td>
                                <td>{{expense.date}}</td>
                                <td>{{expense.detail}}</td>
                                <td>{{expense.balance}}</td>
                                <td>{{expense.balance}}</td>
                                <td><a target='_blank' class='btn btn-info'>
                                    <i class='fa fa-file-image-o'></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
</template>

<script>
    export default {
        props: ['title'],
        components: {},
        data() {
            return {
                expenses: ''
            }
        },
        computed: {},
        created() {
            this.$http.get('/tesoreria/lista-de-gastos').then((response) => {
                this.expenses = response.data;
            });
        },
        methods: {},
    }
</script>

