<template>
    <v-col cols="12" class="mt-3">
        <v-form>
            <v-container>
                
            </v-container>
            <label for="barcode">Code Barre</label>
                <v-text-field id="barcode" type="text" v-model="barcode" required placeholder="Saisissez le Code Barre"></v-text-field>
        </v-form>
        <v-card no-body>
            <v-tabs card>
                <v-tab title="Barcode" active>
                    <v-select :value.sync="selectedBC" v-model="selectedBC" :options="barcodeOpt"></v-select>
                    <barcode class="col-xs-6 barcode" :format="selectedBC" :value="barcode" font-options="bold"
                        width="2px" height="150px">
                        Code barre {{ (barcode.length > 0)?'invalide' : 'vide'}}
                    </barcode>
                </v-tab>
                <v-tab title="QRcode">
                    <v-select :value.sync="selectedQR" v-model="selectedQR" :options="qrcodeOpt" disabled></v-select>
                    <template v-if="barcode.length > 0">
                        <div class="col-xs-6 qrcode">
                            <qrcode :value="barcode" :options='qrcode' class="result"></qrcode>
                        </div>
                    </template>
                    <p class="title">{{ ( barcode.length > 0 )? barcode :'Code barre Vide' }}</p>
                </v-tab>
            </v-tabs>
        </v-card>
    </v-col>
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
            barcode: 'P-1-A110A130',
            selectedBC: 'CODE128',
            selectedQR: 'H',
            qrcode: {
                size: 200,
                level: 'H'
            },
            BCOptions: [
                { value: 'CODE128', text: 'CODE128' },
                { value: 'EAN2', text: 'EAN-2' },
                { value: 'EAN5', text: 'EAN-5' },
                { value: 'EAN8', text: 'EAN-8' },
                { value: 'EAN13', text: 'EAN-13' },
                { value: 'UPC', text: 'UPC' },
                { value: 'CODE39', text: 'CODE39' },
                { value: 'ITF14', text: 'ITF-14' },
                { value: 'MSI', text: 'MSI' },
                { value: 'codabar', text: 'codabar' },
            ],
            barcodeOpt: ['CODE128', 'EAN2', 'EAN5', 'EAN8', 'EAN13', 'UPC', 'CODE39', 'ITF14', 'MSI', 'codabar'],
            qrcodeOpt: ['L', 'M', 'Q', 'H'],
            QRoptions: [
                { value: 'L', text: 'L', disabled: true },
                { value: 'M', text: 'M', disabled: true },
                { value: 'Q', text: 'Q', disabled: true },
                { value: 'H', text: 'H', disabled: true }
            ]
        }
    },
}
</script>
