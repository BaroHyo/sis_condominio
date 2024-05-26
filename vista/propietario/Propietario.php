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
    Phx.vista.Propietario = {
        require: '../../../sis_condominio/vista/propietario/PropietarioBase.php', // direcion de la clase que va herrerar
        requireclase: 'Phx.vista.PropietarioBase', // nombre de la calse
        title: 'Propietario', // nombre de interaz
        nombreVista: 'Propietario',
        bsave: false,
        constructor: function (config) {
            const inicialAtributos = this.Atributos;
            this.Atributos = [
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_persona'

                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Nombre",
                        gwidth: 130,
                        name: 'nombre',
                        allowBlank: false,
                        maxLength: 150,
                        minLength: 2,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.nombre', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Apellido Paterno",
                        gwidth: 130,
                        name: 'ap_paterno',
                        allowBlank: false,
                        maxLength: 150,

                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.apellido_paterno', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Apellido Materno",
                        gwidth: 130,
                        name: 'ap_materno',
                        allowBlank: true,
                        maxLength: 150,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.apellido_materno', type: 'string'},//p.apellido_paterno
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Fecha de Nacimiento",
                        gwidth: 120,
                        name: 'fecha_nacimiento',
                        allowBlank: false,
                        maxLength: 100,
                        minLength: 1,
                        format: 'd/m/Y',
                        anchor: '100%',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {type: 'date'},
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'genero',
                        fieldLabel: 'Genero',
                        allowBlank: true,
                        emptyText: 'Genero...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        store: ['masculino', 'femenino']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {
                        type: 'list',
                        options: ['masculino', 'femenino']
                    },
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Cualidad 1",
                        gwidth: 130,
                        name: 'cualidad_1',
                        allowBlank: false,
                        maxLength: 50,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.cualidad_1', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Cualidad 2",
                        gwidth: 130,
                        name: 'cualidad_2',
                        allowBlank: false,
                        maxLength: 50,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.cualidad_2', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'tipo_documento',
                        fieldLabel: 'Tipo Documento',
                        allowBlank: true,
                        emptyText: 'Tipo Doc...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        store: ['documento_identidad', 'pasaporte', 'Ninguno']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {
                        type: 'list',
                        options: ['documento_identidad', 'pasaporte'],
                    },
                    grid: true,
                    valorInicial: 'documento_identidad',
                    form: true
                },
                {
                    config: {
                        fieldLabel: "CI",
                        gwidth: 80,
                        name: 'ci',
                        allowBlank: true,
                        maxLength: 15,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'expedicion',
                        fieldLabel: 'Expedido En',
                        allowBlank: true,
                        emptyText: 'Expedido En...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        store: ['CB', 'LP', 'BN', 'CJ', 'PT', 'CH', 'TJ', 'SC', 'OR', 'OTRO']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {
                        type: 'list',
                        options: ['CB', 'LP', 'BN', 'CJ', 'PT', 'CH', 'TJ', 'SC', 'OR', 'OTRO'],
                    },
                    grid: true,
                    valorInicial: 'expedicion',
                    form: true
                },
                ...inicialAtributos
            ];
            const inicialFields = this.fields;
            this.fields = [
                {name: 'id_persona'},
                {name: 'nombre', type: 'string'},
                {name: 'tipo_documento', type: 'string'},
                {name: 'expedicion', type: 'string'},
                {name: 'ap_paterno', type: 'string'},
                {name: 'ap_materno', type: 'string'},
                {name: 'ci', type: 'string'},
                {name: 'cualidad_1', type: 'string'},
                {name: 'cualidad_2', type: 'string'},
                {name: 'fecha_nacimiento', type: 'date', dateFormat: 'Y-m-d'},
                {name: 'genero', type: 'string'},
                ...inicialFields
            ];
            this.initButtons = [this.cmbCondominio];
            this.idContenedor = config.idContenedor;
            Phx.vista.Propietario.superclass.constructor.call(this, config);
            this.cmbCondominio.on('select', function (combo, record, index) {
                this.tmpCondominio = record.data.id_condominio;
                this.capturaFiltros();
            }, this);
            this.store.baseParams = {tipo_interfaz: this.nombreVista};
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
                Phx.vista.Propietario.superclass.onButtonNew.call(this);
                this.Cmp.id_condominio.setValue(this.cmbCondominio.getValue());
            }
        },
        onButtonEdit: function () {
            Phx.vista.Propietario.superclass.onButtonEdit.call(this);
        },
        tabsouth: [
            {
                url: '../../../sis_condominio/vista/unidad_propietario/UnidadPropietario.php',
                title: 'Unidad',
                height: '50%',
                cls: 'UnidadPropietario'
            },
            {
                url: '../../../sis_condominio/vista/estacionamiento_propietario/EstacionamientoPropietario.php',
                title: 'Parqueo',
                height: '50%',
                cls: 'EstacionamientoPropietario'
            },
            {
                url: '../../../sis_condominio/vista/baulera_propietario/BauleraPropietario.php',
                title: 'Baulera',
                height: '50%',
                cls: 'BauleraPropietario'
            },
            {
                url: '../../../sis_condominio/vista/miembro_familiar/MiembroFamiliar.php',
                title: 'Miembros Familiares',
                height: '50%',
                cls: 'MiembroFamiliar'
            },
            {
                url: '../../../sis_condominio/vista/vehiculo/Vehiculo.php',
                title: 'Vehiculos',
                height: '50%',
                cls: 'Vehiculo'
            },
            {
                url: '../../../sis_condominio/vista/mascota/Mascota.php',
                title: 'Mascotas',
                height: '50%',
                cls: 'Mascota'
            }
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
