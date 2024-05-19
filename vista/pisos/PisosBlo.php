<?php
/**
 * @package pXP
 * @file PisosBlo.php
 * @author  MAM
 * @date 27-12-2016 14:45
 * @Interface para el inicio de solicitudes de materiales
 */
header("content-type: text/javascript; charset=UTF-8");
?>

<script>
    Phx.vista.PisosBlo = {
        require: '../../../sis_condominio/vista/pisos/Pisos.php', // direcion de la clase que va herrerar
        requireclase: 'Phx.vista.Pisos', // nombre de la calse
        title: 'Piso', // nombre de interaz
        nombreVista: 'PisosBlo',
        bsave: false,
        bexcel: false,
        constructor: function (config) {
            this.maestro = config.maestro;
            Phx.vista.PisosBlo.superclass.constructor.call(this, config);
            this.init();
        },
        onReloadPage: function (m) {
            this.maestro = m;
            this.store.baseParams = {
                tipo_interfaz: this.nombreVista,
                id_bloques: this.maestro.id_bloques
            };
            this.load({params: {start: 0, limit: 50}})
        },
        loadValoresIniciales: function () {
            Phx.vista.PisosBlo.superclass.loadValoresIniciales.call(this);
            this.Cmp.id_bloques.setValue(this.maestro.id_bloques);
        },
    };
</script>
