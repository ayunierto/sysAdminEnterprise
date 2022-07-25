new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  data: () => ({
    drawer: true,
    dialog: false,
    dialogDelete: false,
    states: [
      { name: "Yogut", abbr: "YT", id: 1 },
      { name: "Galletas", abbr: "GA", id: 2 },
      { name: "Atún", abbr: "AT", id: 3 },
      { name: "Maní", abbr: "MN", id: 4 },
      { name: "Papa", abbr: "PP", id: 5 },
      { name: "Fideos", abbr: "FI", id: 4 },
      { name: "Maiz", abbr: "MA", id: 5 },
    ],
    headers: [
      {
        text: "Productos",
        align: "start",
        sortable: false,
        value: "name",
      },
      { text: "Precio Mayor", value: "ruc" },
      { text: "Precio Menor", value: "rubro" },
      { text: "Precio Especial", value: "telefono" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      ruc: 0,
      rubro: 0,
      telefono: 0,
    },
    defaultItem: {
      name: "",
      ruc: 0,
      rubro: 0,
      telefono: 0,
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Registar Precios" : "Editar Precios";
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
        },
        {
          name: "Ice cream sandwich",
          ruc: 237,
          rubro: 9.0,
          telefono: 37,
        },
        {
          name: "Eclair",
          ruc: 262,
          rubro: 16.0,
          telefono: 23,
        },
        {
          name: "Cupcake",
          ruc: 305,
          rubro: 3.7,
          telefono: 67,
        },
        {
          name: "Gingerbread",
          ruc: 356,
          rubro: 16.0,
          telefono: 49,
        },
        {
          name: "Jelly bean",
          ruc: 375,
          rubro: 0.0,
          telefono: 94,
        },
        {
          name: "Lollipop",
          ruc: 392,
          rubro: 0.2,
          telefono: 98,
        },
        {
          name: "Honeycomb",
          ruc: 408,
          rubro: 3.2,
          telefono: 87,
        },
        {
          name: "Donut",
          ruc: 452,
          rubro: 25.0,
          telefono: 51,
        },
        {
          name: "KitKat",
          ruc: 518,
          rubro: 26.0,
          telefono: 65,
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
