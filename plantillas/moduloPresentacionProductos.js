new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  data: () => ({
    drawer: true,
    dialog: false,
    dialogDelete: false,
    search: '',
    listaProdcutos: [
      { producto: "Yogurt", abbr: "YT", id: 1 },
      { producto: "Aceite", abbr: "GA", id: 2 },
      { producto: "Fideos", abbr: "AT", id: 3 },
      { producto: "Azucar", abbr: "MN", id: 4 },
      { producto: "Sal", abbr: "PP", id: 5 },
    ],
    headers: [
      {
        text: "#",
        align: "start",
        sortable: false,
        value: "num",
      },
      { text: "Producto", value: "producto" },
      { text: "Presentacion", value: "presentacion" },
      { text: "Valor(UND)", value: "precio" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      producto: "",
      presentacion: "",
      num: 0,
      precio: 0,
    },
    defaultItem: {
      producto: "",
      presentacion: "",
      num: 0,
      precio: 0,
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Registar Presentación de Productos"
        : "Editar Presentación de Productos";
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

          producto: "Atún",
          presentacion: "Lata",
          num: 159,
          precio: 6.0,
        },
        {

          producto: "Sal",
          presentacion: "Bolsa",
          num: 237,
          precio: 9.0,
        },
        {
          producto: "Gaseosa",
          presentacion: "Boltella",
          num: 262,
          precio: 16.0,
        },
        {

          producto: "Aceite",
          presentacion: "Botella",
          num: 305,
          precio: 3.7,
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
