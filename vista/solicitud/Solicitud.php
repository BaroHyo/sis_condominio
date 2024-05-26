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
    Phx.vista.Solicitud = {
        require: '../../../sis_condominio/vista/solicitud/SolicitudBase.php', // direcion de la clase que va herrerar
        requireclase: 'Phx.vista.SolicitudBase', // nombre de la calse
        title: 'Solicitud', // nombre de interaz
        nombreVista: 'Solicitud',
        bsave: false,
        constructor: function (config) {
            this.initButtons = [this.cmbCondominio];
            this.idContenedor = config.idContenedor;
            Phx.vista.Solicitud.superclass.constructor.call(this, config);
            this.cmbCondominio.on('select', function (combo, record, index) {
                this.tmpCondominio = record.data.id_condominio;
                this.capturaFiltros();
                this.iniciarEvento();
            }, this);
            this.store.baseParams = {tipo_interfaz: this.nombreVista};
        },
        iniciarEvento: function () {
            this.Cmp.id_propietario.store.baseParams = Ext.apply(this.Cmp.id_propietario.store.baseParams, {id_condominio: this.cmbCondominio.getValue()});
            this.Cmp.id_propietario.modificado = true;

            this.Cmp.id_areas_comunes.store.baseParams = Ext.apply(this.Cmp.id_areas_comunes.store.baseParams, {id_condominio: this.cmbCondominio.getValue()});
            this.Cmp.id_areas_comunes.modificado = true;
        },
        capturaFiltros: function (combo, record, index) {
            if (this.validarFiltros()) {
                this.store.baseParams.id_condominio = this.cmbCondominio.getValue();
                this.load({params: {start: 0, limit: 50}});
            }
        },
        validarFiltros: function () {
            return !!(this.cmbCondominio.validate());
        },
        onButtonNew: function () {
            if (!this.validarFiltros()) {
                alert('Especifique el Condominio antes.')
            } else {
                Phx.vista.Solicitud.superclass.onButtonNew.call(this);
                this.Cmp.id_condominio.setValue(this.cmbCondominio.getValue());
            }
        },
        onButtonEdit: function () {
            Phx.vista.Solicitud.superclass.onButtonEdit.call(this);
        },
        tabsouth: [
            {
                url: '../../../sis_condominio/vista/invitados/Invitados.php',
                title: 'Lista Invitados',
                height: '50%',
                cls: 'Invitados'
            },
        ],
        cmbCondominio: new Ext.form.ComboBox({
            fieldLabel: 'Condominio',
            allowBlank: false,
            emptyText: 'Seleccione un condominio...',
            blankText: 'Condominio',
            grupo: [0, 1, 2, 3, 4],
            store: new Ext.data.JsonStore({
                url: '../../sis_condominio/control/Condominio/listarCondominio',
                id: 'id_condominio',
                root: 'datos',
                sortInfo: {
                    field: 'nombre',
                    direction: 'ASC'
                },
                totalProperty: 'total',
                fields: ['id_condominio', 'codigo', 'nombre', 'direccion'],
                remoteSort: true,
                baseParams: {par_filtro: 'con.nombre'}
            }),
            valueField: 'id_condominio',
            triggerAction: 'all',
            displayField: 'nombre',
            hiddenName: 'id_condominio',
            mode: 'remote',
            pageSize: 50,
            queryDelay: 500,
            listWidth: '280',
            width: 280
        }),
    };
</script>
