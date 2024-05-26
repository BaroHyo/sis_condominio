<?php
/****************************************************************************************
 * @package pXP
 * @file gen-Solicitud.php
 * @author  (admin)
 * @date 15-05-2024 22:06:23
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 22:06:23    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.SolicitudBase = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.SolicitudBase.superclass.constructor.call(this, config);
                this.init();
            },

            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_solicitud'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_proceso_wf'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_estado_wf'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_condominio'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        name: 'nro_tramite',
                        fieldLabel: 'Nro. Tramite',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 150,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'soa.nro_tramite', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'estado',
                        fieldLabel: 'Estado',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'soa.estado', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'id_propietario',
                        fieldLabel: 'Propietario',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Propietario/listarPropietario',
                            id: 'id_propietario',
                            root: 'datos',
                            sortInfo: {
                                field: 'nombre',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_propietario', 'nombre', 'ap_materno', 'ap_paterno'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'p.nombre#p.apellido_paterno#p.apellido_materno'}
                        }),
                        valueField: 'id_propietario',
                        displayField: 'nombre',
                        gdisplayField: 'desc_propietario',
                        hiddenName: 'id_propietario',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '80%',
                        gwidth: 150,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['desc_propietario']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'per.nombre', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'id_areas_comunes',
                        fieldLabel: 'Areas Comunes',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/AreasComunes/listarAreasComunes',
                            id: 'id_areas_comunes',
                            root: 'datos',
                            sortInfo: {
                                field: 'nombre',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_areas_comunes', 'nombre', 'descripcion'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'are.nombre'}
                        }),
                        valueField: 'id_areas_comunes',
                        displayField: 'nombre',
                        gdisplayField: 'desc_area_comunes',
                        hiddenName: 'id_areas_comunes',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '80%',
                        gwidth: 200,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['desc_area_comunes']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'per.nombre', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'fecha',
                        fieldLabel: 'Fecha',
                        allowBlank: false,
                        anchor: '50%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {pfiltro: 'soa.fecha', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'hr_desde',
                        fieldLabel: 'Desde (Hr.)',
                        allowBlank: true,
                        increment: 1,
                        width: 120,
                        format: 'H:i:s',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('H:i:s') : ''
                        }
                    },
                    type: 'TimeField',
                    id_grupo: 1,
                    grid: false,
                    form: true
                },
                {
                    config: {
                        name: 'hr_hasta',
                        fieldLabel: 'Hasta (Hr.)',
                        allowBlank: true,
                        increment: 1,
                        width: 120,
                        format: 'H:i:s',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('H:i:s') : ''
                        }
                    },
                    type: 'TimeField',
                    id_grupo: 1,
                    grid: false,
                    form: true
                },
                {
                    config: {
                        name: 'desc_condominio',
                        fieldLabel: 'Condominio',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'con.nombre ', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {

                    config: {
                        name: 'importe_garantia',
                        fieldLabel: 'Total Garantia',
                        allowBlank: true,
                        anchor: '30%',
                        gwidth: 100,
                        disabled: true,
                    },
                    type: 'NumberField',
                    filters: {pfiltro: 'soa.importe_garantia', type: 'numeric'},
                    id_grupo: 1,
                    grid: false,
                    form: true,
                },
                {

                    config: {
                        name: 'importe_mb',
                        fieldLabel: 'Total Importe',
                        allowBlank: true,
                        anchor: '30%',
                        gwidth: 100,
                        disabled: true,
                    },
                    type: 'NumberField',
                    filters: {pfiltro: 'soa.importe_mb', type: 'numeric'},
                    id_grupo: 1,
                    grid: false,
                    form: true,
                },
                {
                    config: {
                        name: 'descripcion',
                        fieldLabel: 'Justificacion',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'soa.descripcion', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'estado_reg',
                        fieldLabel: 'Estado Reg.',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'soa.estado_reg', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'usr_reg',
                        fieldLabel: 'Creado por',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 4
                    },
                    type: 'Field',
                    filters: {pfiltro: 'usu1.cuenta', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'fecha_reg',
                        fieldLabel: 'Fecha creación',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y H:i:s') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {pfiltro: 'soa.fecha_reg', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'id_usuario_ai',
                        fieldLabel: 'Fecha creación',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 4
                    },
                    type: 'Field',
                    filters: {pfiltro: 'soa.id_usuario_ai', type: 'numeric'},
                    id_grupo: 1,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        name: 'usuario_ai',
                        fieldLabel: 'Funcionaro AI',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 300
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'soa.usuario_ai', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'usr_mod',
                        fieldLabel: 'Modificado por',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 4
                    },
                    type: 'Field',
                    filters: {pfiltro: 'usu2.cuenta', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'fecha_mod',
                        fieldLabel: 'Fecha Modif.',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y H:i:s') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {pfiltro: 'soa.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Solicitud',
            ActSave: '../../sis_condominio/control/Solicitud/insertarSolicitud',
            ActDel: '../../sis_condominio/control/Solicitud/eliminarSolicitud',
            ActList: '../../sis_condominio/control/Solicitud/listarSolicitud',
            id_store: 'id_solicitud',
            fields: [
                {name: 'id_solicitud', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_propietario', type: 'numeric'},
                {name: 'fecha', type: 'date', dateFormat: 'Y-m-d'},
                {name: 'estado', type: 'string'},
                {name: 'nro_tramite', type: 'string'},
                {name: 'id_proceso_wf', type: 'numeric'},
                {name: 'id_estado_wf', type: 'numeric'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'id_condominio', type: 'numeric'},
                {name: 'descripcion', type: 'string'},
                {name: 'desc_propietario', type: 'string'},
                {name: 'desc_condominio', type: 'string'},
                {name: 'id_areas_comunes', type: 'numeric'},
                {name: 'importe_mb', type: 'numeric'},
                {name: 'hr_desde', type: 'date', dateFormat: 'H:i:s'},
                {name: 'hr_hasta', type: 'date', dateFormat: 'H:i:s'},
                {name: 'importe_garantia', type: 'numeric'},
                {name: 'desc_area_comunes', type: 'string'},
            ],
            sortInfo: {
                field: 'id_solicitud',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
        }
    )
</script>
        
        