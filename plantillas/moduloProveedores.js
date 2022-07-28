new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: () => ({
        drawer: true,
        dialog: false,
        dialogDelete: false,
        search: "",
        headers: [
            {
                text: "Proveedores",
                align: "start",
                sortable: false,
                value: "name",
            },
            { text: "RUC", value: "ruc" },
            { text: "Descripcion", value: "descripcion" },
            { text: "Teléfono", value: "telefono" },
            { text: "Dirección", value: "direccion" },
            { text: "Actions", value: "actions", sortable: false },
        ],
        desserts: [],
        editedIndex: -1,
        editedItem: {
            name: "",
            ruc: 0,
            descripcion: "",
            telefono: 0,
            direccion: 0,
        },
        defaultItem: {
            name: "",
            ruc: 0,
            descripcion: "",
            telefono: 0,
            direccion: 0,
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Registar Proveedor"
                : "Editar Proveedor";
        },
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            this.desserts = [
                {
                    name: "Frozen",
                    ruc: 15938877164,
                    descripcion: "",
                    telefono: 2445220078,
                    direccion: 4.0,
                },
                {
                    name: "Ice",
                    ruc: 23178476527,
                    descripcion: "",
                    telefono: 3777154860,
                    direccion: 4.3,
                },
                {
                    name: "Eclair",
                    ruc: 26276522846,
                    descripcion: "",
                    telefono: 234023078,
                    direccion: 6.0,
                },
            ];
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

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem);
            } else {
                this.desserts.push(this.editedItem);
            }
            this.close();
        },
    },
});
