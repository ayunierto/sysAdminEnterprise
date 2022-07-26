new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: () => ({
        hasSaved: false,
        isEditing: null,
        // Fecha de formualrio
        menu1: false,
        dialog: false,
        dialogDelete: false,
        tipoComprobante: [
            { name: "Ticket", abbr: "YT", id: 1 },
            { name: "Boleta", abbr: "GA", id: 2 },
            { name: "Factura", abbr: "AT", id: 3 },
        ],
        desserts: [
            {
                producto: "Frozen Yogurt",
                cantidad: 159,
                precio: 50,
            },
            {
                producto: "Ice cream sandwich",
                cantidad: 237,
                precio: 12,
            },
            {
                producto: "Eclair",
                cantidad: 262,
                precio: 30,
            },
            {
                producto: "Cupcake",
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
            this.hasSaved = true;
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
