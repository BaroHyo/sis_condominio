<?php
/**
 * @package pXP
 * @file TransaccionesIngreso.php
 * @author  MAM
 * @date 27-12-2016 14:45
 * @Interface para el inicio de solicitudes de materiales
 */
header("content-type: text/javascript; charset=UTF-8");
?>

<script>
    Phx.vista.TransaccionesIngreso = {
        require: '../../../sis_condominio/vista/transacciones/Transacciones.php', // direcion de la clase que va herrerar
        requireclase: 'Phx.vista.Transacciones', // nombre de la calse
        title: 'Ingreso', // nombre de interaz
        nombreVista: 'TransaccionesIngreso',
        bsave: false,
        constructor: function (config) {
            this.idContenedor = config.idContenedor;
            Phx.vista.TransaccionesIngreso.superclass.constructor.call(this, config);
            this.store.baseParams.pes_tipo = 'ingreso';
        },
        onButtonNew: function () {
            Phx.vista.TransaccionesIngreso.superclass.onButtonNew.call(this);
            this.Cmp.tipo.setValue('ingreso');
            this.Cmp.id_plan_cuenta_at.store.baseParams.sw_tipo = 'ingreso';
            this.Cmp.id_plan_cuenta_at.modificado = true;
            this.Cmp.fecha.setValue(new Date());
        },
    };
</script>
