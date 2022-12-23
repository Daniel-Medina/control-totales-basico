//Obtener la url dinaminca sin el http
var url = 'http://' + 'api.' + document.domain;

// generar la fecha actual
var date = new Date();
var UTC = date.getTime() + (date.getTimezoneOffset() * 60000);

nuevaFecha = new Date(UTC + (3600000 * -6));
// Dar formato a la fecha
var fechaActual = nuevaFecha.getDate() + "-" + (nuevaFecha.getMonth() + 1) + "-" + nuevaFecha.getFullYear();



new Vue({
    el: '#calcularRegistros',

    data: {
        fecha: fechaActual,
        fechaInput: '',
        total: 0,
        ventas: 0,
    },

    created() {
        this.consultaInicial();
    },

    methods: {
        consultarRegistros() {
            fechaFormateada = this.fechaInput.split('-');
            this.fecha = fechaFormateada[2] + '-' + fechaFormateada[1] + '-' + fechaFormateada[0];

            this.$http.get(url + '/total?fecha=' + this.fecha).then(function (json) {
                console.log(json.data);
                this.total = json.data.saldo;
                this.ventas = json.data.cantidad;
            }).catch(function (json) {
                //console.log(json);
            });
        },

        consultaInicial() {
            fechaFormateada = fechaActual.split('-');
            this.fecha = fechaFormateada[2] + '-' + fechaFormateada[1] + '-' + fechaFormateada[0];
            console.log(this.fecha);

            this.$http.get(url + '/total').then(function (json) {
                console.log(json.data);
                this.total = json.data.saldo;
                this.ventas = json.data.cantidad;
            }).catch(function (json) {
                //console.log(json);
            });
        }
    },


});