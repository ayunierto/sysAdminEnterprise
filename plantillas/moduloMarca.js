new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  data: () => ({
    drawer: true,
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "#",
        align: "start",
        sortable: false,
        value: "ruc",
      },
      { text: "Nombre", value: "name" },
      { text: "Descripción", value: "rubro" },
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
      return this.editedIndex === -1 ? "Registar Marca" : "Editar Marca";
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
          name: "Gingerbread",
          ruc: 356,
          rubro: 16.0,
        },
        {
          name: "Jelly bean",
          ruc: 375,
          rubro: 0.0,
        },
        {
          name: "Lollipop",
          ruc: 392,
          rubro: 0.2,
        },
        {
          name: "Honeycomb",
          ruc: 408,
          rubro: 3.2,
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
