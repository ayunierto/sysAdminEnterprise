new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: (vm) => ({
        drawer: true,
        dialog: false,
        dialogDelete: false,
        search: "",
        // Fecha de formualrio
        date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
            .toISOString()
            .substr(0, 10),
        dateFormatted: vm.formatDate(
            new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
                .toISOString()
                .substr(0, 10)
        ),
        menu1: false,
        // Datos de tabla
        headers: [
            {
                text: "#",
                align: "start",
                sortable: false,
                value: "ruc",
            },
            { text: "Lote", value: "name" },
            { text: "Fecha Vencimiento", value: "rubro" },
            { text: "Actions", value: "actions", sortable: false },
        ],
        desserts: [],
        editedIndex: -1,
        editedItem: {
            name: "",
            ruc: 0,
            rubro: 0,
        },
        defaultItem: {
            name: "",
            ruc: 0,
            rubro: 0,
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Registar Lote" : "Editar Lote";
        },
        computedDateFormatted() {
            return this.formatDate(this.date);
        },
    },

    watch: {
        // fecha
        date(val) {
            this.dateFormatted = this.formatDate(this.date);
        },
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
        formatDate(date) {
            if (!date) return null;

            const [year, month, day] = date.split("-");
            return `${month}/${day}/${year}`;
        },
        parseDate(date) {
            if (!date) return null;

            const [month, day, year] = date.split("/");
            return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
        },
        initialize() {
            this.desserts = [
                {
                    name: "Frozen Yogurt",
                    ruc: 159,
                    rubro: 6.0,
                },
                {
                    name: "Ice cream sandwich",
                    ruc: 237,
                    rubro: 9.0,
                },
                {
                    name: "Eclair",
                    ruc: 262,
                    rubro: 16.0,
                },
                {
                    name: "Cupcake",
                    ruc: 305,
                    rubro: 3.7,
                },
                {
                    name: "Donut",
                    ruc: 452,
                    rubro: 25.0,
                },
                {
                    name: "KitKat",
                    ruc: 518,
                    rubro: 26.0,
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
