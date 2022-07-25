new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: (vm) => ({
        hasSaved: false,
        isEditing: null,
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
        tipoComprobante: [
            { name: "Ticket", abbr: "YT", id: 1 },
            { name: "Boleta", abbr: "GA", id: 2 },
            { name: "Factura", abbr: "AT", id: 3 },
        ],
    }),
    computed: {
        computedDateFormatted() {
            return this.formatDate(this.date);
        },
    },

    watch: {
        // fecha
        date(val) {
            this.dateFormatted = this.formatDate(this.date);
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
                return `${year}-${month.padStart(2, "0")}-${day.padStart(
                    2,
                    "0"
                )}`;
            },
            save() {
                this.isEditing = !this.isEditing;
                this.hasSaved = true;
            },
        },
    },
});
