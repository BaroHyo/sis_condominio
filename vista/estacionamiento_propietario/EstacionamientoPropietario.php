<?php
/****************************************************************************************
 * @package pXP
 * @file gen-EstacionamientoPropietario.php
 * @author  (admin)
 * @date 15-05-2024 20:44:50
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 20:44:50    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.EstacionamientoPropietario = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.EstacionamientoPropietario.superclass.constructor.call(this, config);
                this.init();
                const dataPadre = Phx.CP.getPagina(this.idContenedorPadre).getSelectedData();
                if (dataPadre) {
                    this.onEnablePanel(this, dataPadre);
                } else {
                    this.bloquearMenus();
                }
            },

            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_estacionamiento_propietario'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_propietario'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        name: 'id_estacionamiento',
                        fieldLabel: 'Parqueo',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Estacionamiento/listarEstacionamiento',
                            id: 'id_estacionamiento',
                            root: 'datos',
                            sortInfo: {
                                field: 'numero_espacio',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_estacionamiento', 'id_condominio', 'numero_espacio', 'tipo_espacion'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'est.numero_espacio', es_propietario: 'si'}
                        }),
                        valueField: 'id_estacionamiento',
                        displayField: 'numero_espacio',
                        gdisplayField: 'numero_espacio',
                        hiddenName: 'id_estacionamiento',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '100%',
                        gwidth: 150,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['numero_espacio']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'est.numero_espacio', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'tipo_espacion',
                        fieldLabel: 'Tipo Espacion',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 4
                    },
                    type: 'Field',
                    filters: {pfiltro: 'est.tipo_espacion', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'informacion_adicional',
                        fieldLabel: 'Informacion Adicional',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 4
                    },
                    type: 'Field',
                    filters: {pfiltro: 'est.informacion_adicional', type: 'string'},
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
                    filters: {pfiltro: 'esp.fecha_reg', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
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
                    filters: {pfiltro: 'esp.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'esp.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'esp.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'esp.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Estacionamiento Propietario',
            ActSave: '../../sis_condominio/control/EstacionamientoPropietario/insertarEstacionamientoPropietario',
            ActDel: '../../sis_condominio/control/EstacionamientoPropietario/eliminarEstacionamientoPropietario',
            ActList: '../../sis_condominio/control/EstacionamientoPropietario/listarEstacionamientoPropietario',
            id_store: 'id_estacionamiento_propietario',
            fields: [
                {name: 'id_estacionamiento_propietario', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_propietario', type: 'numeric'},
                {name: 'id_estacionamiento', type: 'numeric'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'numero_espacio', type: 'string'},
                {name: 'tipo_espacion', type: 'string'},
                {name: 'informacion_adicional', type: 'string'},

            ],
            sortInfo: {
                field: 'id_estacionamiento_propietario',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            fwidth: '40%',
            fheight: '15%',
            onReloadPage: function (m) {
                this.maestro = m;
                this.store.baseParams = {id_propietario: this.maestro.id_propietario};
                this.iniciarEvento();
                this.load({params: {start: 0, limit: 50}})
            },
            loadValoresIniciales: function () {
                Phx.vista.EstacionamientoPropietario.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_propietario.setValue(this.maestro.id_propietario);
            },
            iniciarEvento: function () {
                this.Cmp.id_estacionamiento.store.baseParams = Ext.apply(this.Cmp.id_estacionamiento.store.baseParams, {id_condominio: this.maestro.id_condominio});
                this.Cmp.id_estacionamiento.modificado = true;
            }
        }
    )
</script>
        
        