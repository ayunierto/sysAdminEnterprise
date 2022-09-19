
<template>
    <v-card class="ma-3" color="blue lighten-5">
        <v-card-title class="text-center justify-center py-6">
            <h3 class="font-weight-bold basil--text">
                GENERADOR DE CÓDIGOS
            </h3>
        </v-card-title>
        <v-tabs fixed-tabs icons-and-text>
            <v-tab>
                BARCode <v-icon>mdi-barcode</v-icon>
            </v-tab>
            <v-tab>
                QRCode <v-icon>mdi-qrcode</v-icon>
            </v-tab>
            <!-- Generador de BARCODE -->
            <v-tab-item>
                <v-card elevation="2">
                    <v-container>
                        <h5>DATOS DE CÓDIGO</h5>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-row>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-text-field label="Nombre Producto" placeholder="Name" v-model="namebarcode"
                                            outlined>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-text-field label="Código Barra" placeholder="BARCODE" v-model="barcode"
                                            outlined>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="2" md="2">
                                        <v-text-field label="Tamaño Código" v-model="escalaCode" type="number" min="1"
                                            outlined>
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                                <v-layout class="ma-2" row wrap align-center justify-center>
                                    <v-card color="#FFFFFF" id="bar-code">
                                        <h3 style="font-size: 13px;">&nbsp;&nbsp;Producto:
                                            {{namebarcode}}&nbsp;</h3>
                                        <v-layout class="ma-2" row wrap align-center justify-center fill-height>
                                            <barcode class="col-xs-6 barcode" :value="barcode" height="100"
                                                :width="escalaCode" background="transparent">
                                            </barcode>
                                        </v-layout>
                                    </v-card>
                                    &nbsp;&nbsp;
                                    <v-btn color="green darken-2" small class="white--text" fab @click="guardarBarCode">
                                        <v-icon dark>
                                            mdi-folder-download
                                        </v-icon>
                                    </v-btn>
                                </v-layout>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </v-tab-item>
            <!-- Generador de QRCODE -->
            <v-tab-item>
                <v-card elevation="2">
                    <v-container>
                        <h5>DATOS DE CÓDIGO</h5>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-row>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-text-field label="Nombre Producto" placeholder="Name" v-model="nameqrcode"
                                            outlined>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="3" md="3">
                                        <v-text-field label="Código QR" placeholder="QRCODE" v-model="qrcode" outlined>
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                                <v-layout class="ma-2" row wrap align-center justify-center>
                                    <v-card color="#FFFFFF" id="qr-code">
                                        <h3 style="font-size: 13px;">&nbsp;&nbsp;Producto:
                                            {{nameqrcode}}&nbsp;</h3>
                                        <v-layout class="ma-2" row wrap align-center justify-center fill-height>
                                            <qrcode v-model='qrcode' :options="{ width: 200 }"></qrcode>
                                        </v-layout>
                                    </v-card>
                                    &nbsp;&nbsp;
                                    <v-btn color="green darken-2" class="white--text" @click="guardarQr">
                                        <v-icon dark>
                                            mdi-folder-download
                                        </v-icon>
                                    </v-btn>
                                </v-layout>


                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>
            </v-tab-item>
        </v-tabs>
    </v-card>
</template>
<script>
import AdminLayout from '@/Layouts/AdminLayout'
import VueBarcode from 'vue-barcode'
import VueQrcode from '@chenfengyuan/vue-qrcode';

export default {
    name: 'hello',
    components: {
        AdminLayout,
        'barcode': VueBarcode,
        'qrcode': VueQrcode,
    },
    data() {
        return {
            barcode: 'Alpa2022',
            namebarcode: '',
            escalaCode: 1,
            qrcode: 'Alpa Perú 2022',
            nameqrcode: '',
        }
    },
    methods: {
        guardarBarCode() {
            var extension = this.namebarcode
            domtoimage.toBlob(document.getElementById("bar-code")).then(function (blob) {
                window.saveAs(blob, extension + '.png');
            });
        },
        guardarQr() {
            var extension = this.nameqrcode
            domtoimage.toBlob(document.getElementById("qr-code")).then(function (blob) {
                window.saveAs(blob, extension + '.png');
            });
        },
    },
}
</script>
