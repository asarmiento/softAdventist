<template>
    <div :class="pOI(styleClass)">
        <form role="form" enctype="multipart/form-data" @submit.prevent="">

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



        </form>
    </div>
</template>

<script>
    require('es6-promise').polyfill();
    export default {
        props: {
            postURL: {
                type: String,
                required: true
            },
            method: {
                type: String,
                default: 'post'
            },
            successMessagePath: {
                type: String,
                required: true
            },
            name: {
                type: String,
                required: true
            },
            styleClass: {
                type: String,
                default: 'origin'
            }
        },
        /*
         * The component's data.
         */
        data() {
            return {
                items: '',
                itemsAdded: '',
                itemsNames: '',
                itemsSizes: '',
                itemsTotalSize: '',
                formData: '',
                successMsg: '',
                errorMsg: '',
                isLoaderVisible: false,
            }
        },
        methods: {
            // http://scratch99.com/web-development/javascript/convert-bytes-to-mb-kb/
            bytesToSize(bytes) {
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes === 0) return 'n/a';
                let i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                if (i === 0) return bytes + ' ' + sizes[i];
                return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
            },
            pOI(style) {
                if (style === 'origin') {
                    return 'uploadBox'
                }
                else {
                    return 'new'
                }
            },
            onChange(e) {
                this.successMsg = '';
                this.errorMsg = '';
                this.formData = new FormData();
                let files = e.target.files || e.dataTransfer.files;
                this.itemsAdded = this.items.length;
                let fileSizes = 0;
                for (let fileIn in files) {
                    if (!isNaN(fileIn)) {
                        this.items = e.target.files[fileIn] || e.dataTransfer.files[fileIn];
                        this.itemsNames = files[fileIn].name;
                        this.itemsSizes = this.bytesToSize(files[fileIn].size);
                        fileSizes = files[fileIn].size;
                        this.formData.append('items', this.items);
                        console.log(this.items)
                    }
                }
                this.itemsTotalSize = this.bytesToSize(fileSizes);
            },
            removeItems() {
                this.items = '';
                this.itemsAdded = '';
                this.itemsNames = '';
                this.itemsSizes = '';
                this.itemsTotalSize = '';
            },

            onSubmit() {
                axios.post('http://softadventist.dev/tesoreria/upload-check',  this.formData)
                    .then(response => {
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
    }
</script>

<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    .uploadBox {
        position: relative;
        background: #eee;
        padding: 0 1em 1em 1em;
        margin: 1em;
    }

    .uploadBox h3 {
        padding-top: 1em;
    }

    .uploadBox .uploadBoxMain {
        position: relative;
        margin-bottom: 1em;
        margin-right: 1em;
    }

    /* Drag and drop */
    .uploadBox .dropArea {
        position: relative;
        width: 100%;
        height: 300px;
        border: 5px dashed #00ADCE;
        text-align: center;
        font-size: 2em;
        padding-top: 80px;
    }

    .new .dropArea {
        position: relative;
        width: 100%;
        border: 1px dashed #00ADCE;
        text-align: center;
        font-size: 2em;
        padding-top: 80px;
    }

    .uploadBox .dropArea input {
        position: absolute;
        cursor: pointer;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
    }

    /* End drag and drop */

    /* Loader */
    .uploadBox .loader {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        opacity: 0.9;
    }

    .uploadBox .loaderImg {
        border: 9px solid #eee;
        border-top: 9px solid #00ADCE;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    /* End Loader */

    .uploadBox .errorMsg {
        font-size: 2em;
        color: #a94442;
    }

    .uploadBox .successMsg {
        font-size: 2em;
        color: #3c763d;
    }
</style>

