<?php
/**
 * @package pXP
 * @file Comunicado.php
 * @author  MAM
 * @date 27-12-2016 14:45
 * @Interface para el inicio de solicitudes de materiales
 */
header("content-type: text/javascript; charset=UTF-8");
?>

<script>
    Phx.vista.Comunicado = {
        require: '../../../sis_condominio/vista/comunicado/ComunicadoBase.php', // direcion de la clase que va herrerar
        requireclase: 'Phx.vista.ComunicadoBase', // nombre de la calse
        title: 'Comunicado', // nombre de interaz
        nombreVista: 'Comunicado',
        bsave: false,
        gruposBarraTareas: [
            {name: 'borrador', title: '<h1 align="center"><i></i>Registrados</h1>', grupo: 0, height: 0},
            {name: 'notificado', title: '<h1 align="center"><i></i>Notificados</h1>', grupo: 1, height: 0}
        ],
        tam_pag: 50,
        actualizarSegunTab: function (name, indice) {
            if (this.finCons) {
                this.store.baseParams.pes_estado = name;
                this.load({params: {start: 0, limit: this.tam_pag}});
            }
        },
        bnewGroups: [0],
        bactGroups: [0, 1, 2],
        bdelGroups: [0],
        beditGroups: [0],
        bexcelGroups: [0, 1, 2],
        constructor: function (config) {
            this.idContenedor = config.idContenedor;
            Phx.vista.Comunicado.superclass.constructor.call(this, config);
            this.store.baseParams = {tipo_interfaz: this.nombreVista};
            this.store.baseParams.pes_estado = 'borrador';
            this.addButton('bto-notifcar', {
                grupo: [0],
                text: 'Notificar',
                iconCls: 'bemail',
                disabled: true,
                handler: this.onNotificar
            });
            this.load({params: {start: 0, limit: this.tam_pag}})
        },
        preparaMenu: function (n) {
            Phx.vista.Comunicado.superclass.preparaMenu.call(this, n);
            this.getBoton('bto-notifcar').enable();
        },
        liberaMenu: function () {
            const tb = Phx.vista.Comunicado.superclass.liberaMenu.call(this);
            if (tb) {
                this.getBoton('bto-notifcar').disable();
            }
        },
        onNotificar: function () {
            const data = this.sm.getSelected().data;
            Phx.CP.loadingShow();
            Ext.Ajax.request({
                url: '../../sis_condominio/control/Comunicado/notificarComunidaco',
                params: {id_comunicado: data.id_comunicado},
                success: this.succesCn,
                failure: this.conexionFailure,
                timeout: this.timeout,
                scope: this
            });
        },
        succesCn: function (resp) {
            Phx.CP.loadingHide();
            const reg = Ext.util.JSON.decode(Ext.util.Format.trim(resp.responseText));
            this.load({params: {start: 0, limit: this.tam_pag}});
        },
    };
</script>
