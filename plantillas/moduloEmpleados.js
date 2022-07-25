new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  data: () => ({
    drawer: true,
    dialog: false,
    dialogDelete: false,
    search:'',
    states: [
      { name: "Administrador", abbr: "YT", id: 1 },
      { name: "Gerente", abbr: "GA", id: 2 },
      { name: "Cajero", abbr: "AT", id: 3 },
      { name: "Vendedor", abbr: "MN", id: 4 },
      { name: "Trabajador", abbr: "PP", id: 5 },
    ],
    headers: [
      {
        text: "Empresas",
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
      rubro: 0,
      telefono: 0,
      direccion: 0,
    },
    defaultItem: {
      name: "",
      ruc: 0,
      rubro: 0,
      telefono: 0,
      direccion: 0,
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
          ruc: 159,
          rubro: 6.0,
          telefono: 24,
          direccion: 4.0,
        },
        {
          name: "Ice cream sandwich",
          ruc: 237,
          rubro: 9.0,
          telefono: 37,
          direccion: 4.3,
        },
        {
          name: "Eclair",
          ruc: 262,
          rubro: 16.0,
          telefono: 23,
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
