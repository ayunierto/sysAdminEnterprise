new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  data: () => ({
    drawer: true,
    dialog: false,
    dialogDelete: false,
    search: '',
    states: [
      { name: "Administrador", abbr: "YT", id: 1 },
      { name: "Gerente", abbr: "GA", id: 2 },
      { name: "Cajero", abbr: "AT", id: 3 },
      { name: "Vendedor", abbr: "MN", id: 4 },
      { name: "Trabajador", abbr: "PP", id: 5 },
    ],
    headers: [
      {
        text: "EMPLEADOS",
        align: "start",
        sortable: false,
        value: "name",
      },
      { text: "RUC", value: "ruc" },
      { text: "Rubro", value: "rubro" },
      { text: "Teléfono", value: "telefono" },
      { text: "Dirección", value: "direccion" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      ruc: 0,
      rubro: "",
      telefono: 0,
      direccion: "",
    },
    defaultItem: {
      name: "",
      ruc: 0,
      rubro: "",
      telefono: 0,
      direccion: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Registar Empleado" : "Editar Empleado";
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
          name: "Frozen Yogurt",
          ruc: 15956746982,
          rubro: "alimetos",
          telefono: 246178820,
          direccion: "jr. ",
        },
        {
          name: "Ice cream sandwich",
          ruc: 23776521489,
          rubro: "alimentos",
          telefono: 379476318,
          direccion: "jr. ",
        },
        {
          name: "Eclair",
          ruc: 26284672954,
          rubro: "Alimentos",
          telefono: 230217964,
          direccion: "jr. ",
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
