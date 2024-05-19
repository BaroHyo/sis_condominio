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
    Phx.vista.PisosCon = {
        require: '../../../sis_condominio/vista/pisos/Pisos.php', // direcion de la clase que va herrerar
        requireclase: 'Phx.vista.Pisos', // nombre de la calse
        title: 'Piso', // nombre de interaz
        nombreVista: 'PisosCon',
        bsave: false,
        bexcel: false,
        id_condominio: null,
        constructor: function (config) {
            this.idContenedor = config.idContenedor;
            this.maestro = config;
            this.id_condominio = this.maestro.id_condominio;
            Phx.vista.PisosCon.superclass.constructor.call(this, config);
            this.init();
            this.store.baseParams = {
                tipo_interfaz: this.nombreVista,
                id_condominio: this.id_condominio
            };
            this.load({params: {start: 0, limit: this.tam_pag}});
        },
        loadValoresIniciales: function () {
            Phx.vista.PisosCon.superclass.loadValoresIniciales.call(this);
            this.Cmp.id_condominio.setValue(this.id_condominio);
        },
    };
</script>
