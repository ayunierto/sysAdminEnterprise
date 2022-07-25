new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  data: () => ({
    drawer: true,
    dialog: false,
    dialogDelete: false,
    search: '',
    headers: [
      {
        text: "#",
        align: "start",
        sortable: false,
        value: "num",
      },
      { text: "Categoria", value: "categorias" },
      { text: "Descripción", value: "descripcion" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      categorias: "",
      num: 0,
      descripcion: "",
    },
    defaultItem: {
      categorias: "",
      num: 0,
      descripcion: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Registar Categoria"
        : "Editar Categoria";
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
          categorias: "Frozen Yogurt",
          num: 159,
          descripcion: "dsd",
        },
        {
          categorias: "Honeycomb",
          num: 408,
          descripcion: "gbfgb",
        },
        {
          categorias: "Donut",
          num: 452,
          descripcion: "nghn",
        },
        {
          categorias: "KitKat",
          num: 518,
          descripcion: "mjhm",
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
