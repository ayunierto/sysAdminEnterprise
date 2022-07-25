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
        text: "NOMBRE",
        align: "start",
        sortable: false,
        value: "name",
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
          name: "Frozen Yogurt",
          stock: 10,
          precio: 6.0,
          marca: "Universal",
          categoria: "General",
        },
        {
          name: "Ice cream sandwich",
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
