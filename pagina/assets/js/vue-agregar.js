//Obtener la url dinaminca sin el http
var url = 'http://' + 'api.' + document.domain;

// generar la fecha actual
var date = new Date();
var UTC = date.getTime() + (date.getTimezoneOffset() * 60000);

nuevaFecha = new Date(UTC + (3600000 * -6));
// Dar formato a la fecha
var fechaActual = nuevaFecha.getDate() + "-" + (nuevaFecha.getMonth() + 1) + "-" + nuevaFecha.getFullYear();



new Vue({
    el: '#agregarRegistro',

    data: {
        form: {
            cantidad: 0,
            fecha: fechaActual,
        },
    },

    methods: {
        agregarRegistro() {            
            this.$http.post(url + '/agregar/store', this.form, {emulateJSON:true}).then(function (json) {
                //console.log(json);
                this.form.cantidad = 0;
                mensaje('Agregado con exito', 'success');
            }).catch(function (json) {
                //console.log(json.data);
                mensaje('Ocurrio un error: ' + json.data.message, 'error');
            });
        }
    },


});