<?php
/****************************************************************************************
 * @package pXP
 * @file gen-BauleraPropietario.php
 * @author  (admin)
 * @date 15-05-2024 20:44:58
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 20:44:58    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.BauleraPropietario = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.BauleraPropietario.superclass.constructor.call(this, config);
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
                        name: 'id_baulera_propietario'
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
                        name: 'id_baulera',
                        fieldLabel: 'Baulera',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Baulera/listarBaulera',
                            id: 'id_baulera',
                            root: 'datos',
                            sortInfo: {
                                field: 'codigo',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_baulera', 'codigo', 'informacion_adicional'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'bau.codigo', es_propietario: 'si'}
                        }),
                        valueField: 'id_baulera',
                        displayField: 'codigo',
                        gdisplayField: 'codigo',
                        hiddenName: 'id_baulera',
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
                            return String.format('{0}', record.data['codigo']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'bau.codigo', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'informacion_adicional',
                        fieldLabel: 'Informacion Adicional',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'bau.informacion_adicional', type: 'string'},
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
                    filters: {pfiltro: 'bap.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'bap.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'bap.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'bap.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'bap.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Baulera Propietario',
            ActSave: '../../sis_condominio/control/BauleraPropietario/insertarBauleraPropietario',
            ActDel: '../../sis_condominio/control/BauleraPropietario/eliminarBauleraPropietario',
            ActList: '../../sis_condominio/control/BauleraPropietario/listarBauleraPropietario',
            id_store: 'id_baulera_propietario',
            fields: [
                {name: 'id_baulera_propietario', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_propietario', type: 'numeric'},
                {name: 'id_baulera', type: 'numeric'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'codigo', type: 'string'},
                {name: 'informacion_adicional', type: 'string'},

            ],
            sortInfo: {
                field: 'id_baulera_propietario',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            fwidth: '40%',
            fheight: '15%',
            onReloadPage: function (m) {
                this.maestro = m;
                this.store.baseParams = {id_propietario: this.maestro.id_propietario};
                this.iniciarEvento()
                this.load({params: {start: 0, limit: 50}})
            },
            loadValoresIniciales: function () {
                Phx.vista.BauleraPropietario.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_propietario.setValue(this.maestro.id_propietario);
            },
            iniciarEvento: function () {
                this.Cmp.id_baulera.store.baseParams = Ext.apply(this.Cmp.id_baulera.store.baseParams, {id_condominio: this.maestro.id_condominio});
                this.Cmp.id_baulera.modificado = true;
            }
        }
    )
</script>
        
        