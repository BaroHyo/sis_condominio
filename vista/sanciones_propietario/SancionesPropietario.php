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
    Phx.vista.SancionesPropietario = {
        require: '../../../sis_condominio/vista/sanciones_propietario/SancionesPropietarioBase.php', // direcion de la clase que va herrerar
        requireclase: 'Phx.vista.SancionesPropietarioBase', // nombre de la calse
        title: 'Sanciones Propietario', // nombre de interaz
        nombreVista: 'SancionesPropietario',
        bsave: false,
        gruposBarraTareas: [
            {name: 'borrador', title: '<h1 align="center"><i></i>Registrados</h1>', grupo: 0, height: 0},
            {name: 'pendiente', title: '<h1 align="center"><i></i>Pendiente</h1>', grupo: 1, height: 0},
            {name: 'pagado', title: '<h1 align="center"><i></i>Pagado</h1>', grupo: 2, height: 0}
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
            this.initButtons = [this.cmbCondominio];
            Phx.vista.SancionesPropietario.superclass.constructor.call(this, config);
            this.store.baseParams = {tipo_interfaz: this.nombreVista};
            this.store.baseParams.pes_estado = 'borrador';
            this.cmbCondominio.on('select', function (combo, record, index) {
                this.tmpCondominio = record.data.id_condominio;
                this.capturaFiltros();
            }, this);
            this.onInicarEvento()
        },
        onInicarEvento: function () {
            this.Cmp.id_sancion.on('select', function (combo, record, index) {
                this.Cmp.importe.reset();
                this.Cmp.id_moneda.reset();
                this.Cmp.importe.setValue(record.data.importe_mb);
                this.Cmp.id_moneda.setValue(record.data.id_moneda);
                this.Cmp.id_moneda.setRawValue(record.data.desc_moneda);
            }, this);
        },
        onButtonNew: function () {
            if (!this.validarFiltros()) {
                alert('Especifique el Condominio antes.')
            } else {
                Phx.vista.SancionesPropietario.superclass.onButtonNew.call(this);
                this.Cmp.id_propietario.store.baseParams = Ext.apply(this.Cmp.id_propietario.store.baseParams, {id_condominio: this.cmbCondominio.getValue()});
                this.Cmp.id_propietario.modificado = true;
                this.Cmp.fecha.setValue(new Date());
            }
        },
        onButtonEdit: function () {
            Phx.vista.SancionesPropietario.superclass.onButtonEdit.call(this);
            this.Cmp.id_propietario.store.baseParams = Ext.apply(this.Cmp.id_propietario.store.baseParams, {id_condominio: this.cmbCondominio.getValue()});
            this.Cmp.id_propietario.modificado = true;
        },
        validarFiltros: function () {
            return !!(this.cmbCondominio.validate());
        },
        capturaFiltros: function (combo, record, index) {
            if (this.validarFiltros()) {
                this.store.baseParams.id_condominio = this.cmbCondominio.getValue();
                this.load({params: {start: 0, limit: 50}});
            }
        },
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
