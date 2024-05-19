<?php
/**
 * @package pXP
 * @file VacacionVoBo.php
 * @author  MAM
 * @date 27-12-2016 14:45
 * @Interface para el inicio de solicitudes de materiales
 */
header("content-type: text/javascript; charset=UTF-8");
?>

<script>
    Phx.vista.Condominio = {
        require: '../../../sis_condominio/vista/condominio/CondominioBase.php', // direcion de la clase que va herrerar
        requireclase: 'Phx.vista.CondominioBase', // nombre de la calse
        title: 'Condominio', // nombre de interaz
        nombreVista: 'Condominio',
        bsave: false,
        constructor: function (config) {
            this.idContenedor = config.idContenedor;
            Phx.vista.Condominio.superclass.constructor.call(this, config);
            this.store.baseParams = {tipo_interfaz: this.nombreVista};
            this.load({params: {start: 0, limit: this.tam_pag}})
        },
        tabsouth: [
            {
                url: '../../../sis_condominio/vista/unidades/Unidades.php',
                title: 'Unidades',
                height: '50%',
                cls: 'Unidades'
            },
            {
                url: '../../../sis_condominio/vista/areas_comunes/AreasComunes.php',
                title: 'Areas Comunes',
                height: '50%',
                cls: 'AreasComunes'
            },
            {
                url: '../../../sis_condominio/vista/estacionamiento/Estacionamiento.php',
                title: 'Parqueo',
                height: '50%',
                cls: 'Estacionamiento'
            },
            {
                url: '../../../sis_condominio/vista/baulera/Baulera.php',
                title: 'Baulera',
                height: '50%',
                cls: 'Baulera'
            },
        ],
        cmbCondominio: new Ext.form.ComboBox({
            fieldLabel: 'Condominio',
            allowBlank: false,
            emptyText: 'Seleccione...',
            blankText: 'Condominio',
            grupo: [0, 1, 2, 3, 4],
            store: new Ext.data.JsonStore(
                {
                    url: '../../sis_parametros/control/Gestion/listarGestion',
                    id: 'id_gestion',
                    root: 'datos',
                    sortInfo: {
                        field: 'gestion',
                        direction: 'DESC'
                    },
                    totalProperty: 'total',
                    fields: ['id_gestion', 'gestion'],
                    remoteSort: true,
                    baseParams: {par_filtro: 'gestion'}
                }),
            valueField: 'id_gestion',
            triggerAction: 'all',
            displayField: 'gestion',
            hiddenName: 'id_gestion',
            mode: 'remote',
            pageSize: 50,
            queryDelay: 500,
            listWidth: '280',
            width: 100
        }),
    };
</script>
