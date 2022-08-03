new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: () => ({
        isEditing: null,
        dialog: false,
        dialog2:false,
        dialogDelete: false,
        date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
    menu2: false,
        tipoComprobante: [
            { name: "Ticket", abbr: "YT", id: 1 },
            { name: "Boleta", abbr: "GA", id: 2 },
            { name: "Factura", abbr: "AT", id: 3 },
        ],
        desserts: [
            {
                producto: "Frozen Yogurt",
                presentacion: "cja 12 und",
                cantidad: 159,
                precio: 50,
            },
            {
                producto: "Ice cream sandwich",
                presentacion: "sobre 5 und",
                cantidad: 237,
                precio: 12,
            },
            {
                producto: "Eclair",
                presentacion: "saco 50kg",
                cantidad: 262,
                precio: 30,
            },
            {
                producto: "Cupcake",
                presentacion: "molde 5 kg",
                cantidad: 305,
                precio: 15,
            },
        ],
    }),
    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },
    methods: {
        save() {
            this.isEditing = !this.isEditing;
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem);
            } else {
                this.desserts.push(this.editedItem);
            }
            this.close();
        },
        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            this.editedIndex = this.desserts.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },
        deleteItemConfirm() {
            this.desserts.splice(this.editedIndex, 1);
            this.closeDelete();
        },
        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
    },
});
