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
        text: "PRODUCTOS",
        align: "start",
        sortable: false,
        value: "producto",
      },
      { text: "STOCK", value: "stock" },
      { text: "PRECIO", value: "precio" },
      { text: "MARCA", value: "marca" },
      { text: "CATEGORIA", value: "categoria" },
      { text: "ACCIONES", value: "actions", sortable: false },
    ],

  }),
  methods: {
    getColor(stock) {
      if (stock <= 10 && stock > 5) return "orange";
      else if (stock <= 5) return "red";
      else return "green";
    },
    initialize() {
      this.desserts = [
        {
          producto: "Frozen Yogurt",
          stock: 10,
          precio: 6.0,
          marca: "Universal",
          categoria: "General",
        },
        {
          producto: "Ice cream sandwich",
          stock: 5,
          precio: 9.0,
          marca: "Universal",
          categoria: "General",
        },
      ];
    },
  },
  created() {
    this.initialize();
  },
});
