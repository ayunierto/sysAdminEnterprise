new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  data: () => ({
    drawer: true,
    dialog: false,
    search: '',

    // Datos modal categoria
    categoria: [
      { name: "Categoria 1", abbr: "YT", id: 1 },
      { name: "Categoria 2", abbr: "GA", id: 2 },
      { name: "Categoria 3", abbr: "AT", id: 3 },
      { name: "Categoria 4", abbr: "MN", id: 4 },
      { name: "Categoria 5", abbr: "PP", id: 5 },
    ],
    marca: [
      { name: "Marca 1", abbr: "YT", id: 1 },
      { name: "Marca 2", abbr: "GA", id: 2 },
      { name: "Marca 3", abbr: "AT", id: 3 },
      { name: "Marca 4", abbr: "MN", id: 4 },
      { name: "Marca 5", abbr: "PP", id: 5 },
    ],
    unidadmedida: [
      { name: "Medida 1", abbr: "YT", id: 1 },
      { name: "Medida 2", abbr: "GA", id: 2 },
      { name: "Medida 3", abbr: "AT", id: 3 },
      { name: "Medida 4", abbr: "MN", id: 4 },
      { name: "Medida 5", abbr: "PP", id: 5 },
    ],
    proveedor: [
      { name: "Proveedor 1", abbr: "YT", id: 1 },
      { name: "Proveedor 2", abbr: "GA", id: 2 },
      { name: "Proveedor 3", abbr: "AT", id: 3 },
      { name: "Proveedor 4", abbr: "MN", id: 4 },
      { name: "Proveedor 5", abbr: "PP", id: 5 },
    ],
    lote: [
      { name: "Lote 1", abbr: "YT", id: 1 },
      { name: "Lote 2", abbr: "GA", id: 2 },
      { name: "Lote 3", abbr: "AT", id: 3 },
      { name: "Lote 4", abbr: "MN", id: 4 },
      { name: "Lote 5", abbr: "PP", id: 5 },
    ],
    dialogDelete: false,
    headers: [
      {
        text: "#",
        align: "start",
        sortable: false,
        value: "",
      },
      { text: "Nombre", value: "name" },
      { text: "Stock", value: "stock" },
      { text: "Precio Venta", value: "precio" },
      { text: "Marca", value: "marca" },
      { text: "Fecha Vencimiento", value: "fecha" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    desserts: [],
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Registar Productos"
        : "Editar Productos";
    },
  },

  watch: {
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
          stock: 100,
          precio: 6.0,
          marca: 'Actual',
          fecha: '22-07-2022',
        },
        {
          name: "KitKat",
          stock: 100,
          precio: 26.0,
          marca: 'Nueva',
          fecha: '22-07-2022',
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


    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },
});
