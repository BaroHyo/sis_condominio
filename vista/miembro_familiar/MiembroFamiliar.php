<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MiembroFamiliar.php
 * @author  (admin)
 * @date 14-05-2024 15:36:36
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                14-05-2024 15:36:36    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.MiembroFamiliar = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.MiembroFamiliar.superclass.constructor.call(this, config);
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
                        name: 'id_vehiculo'
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
                        name: 'id_tipo_relacion',
                        fieldLabel: 'Tipo Relacion',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/TipoRelacion/listarTipoRelacion',
                            id: 'id_tipo_relacion',
                            root: 'datos',
                            sortInfo: {
                                field: 'tipo',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_tipo_relacion', 'tipo'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'tip.tipo'}
                        }),
                        valueField: 'id_tipo_relacion',
                        displayField: 'tipo',
                        gdisplayField: 'desc_tipo',
                        hiddenName: 'id_tipo_relacion',
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
                            return String.format('{0}', record.data['desc_tipo']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'tip.tipo', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'nombre',
                        fieldLabel: 'Nombre',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'mie.nombre', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'apellido_paterno',
                        fieldLabel: 'Apellido Paterno',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'mie.apellido_paterno', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'apellido_materno',
                        fieldLabel: 'Apellido Materno',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'mie.apellido_materno', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'informacion_adicional',
                        fieldLabel: 'Informacion Adicional',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'mie.informacion_adicional', type: 'string'},
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
                    filters: {pfiltro: 'mie.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'mie.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'mie.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'mie.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'mie.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Miembro Familiar',
            ActSave: '../../sis_condominio/control/MiembroFamiliar/insertarMiembroFamiliar',
            ActDel: '../../sis_condominio/control/MiembroFamiliar/eliminarMiembroFamiliar',
            ActList: '../../sis_condominio/control/MiembroFamiliar/listarMiembroFamiliar',
            id_store: 'id_vehiculo',
            fields: [
                {name: 'id_vehiculo', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_propietario', type: 'numeric'},
                {name: 'id_tipo_relacion', type: 'numeric'},
                {name: 'nombre', type: 'string'},
                {name: 'apellido_paterno', type: 'string'},
                {name: 'apellido_materno', type: 'string'},
                {name: 'informacion_adicional', type: 'string'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'desc_tipo', type: 'string'},
            ],
            sortInfo: {
                field: 'id_vehiculo',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            fwidth: '50%',
            fheight: '25%',
            onReloadPage: function (m) {
                this.maestro = m;
                this.store.baseParams = {id_propietario: this.maestro.id_propietario};
                this.load({params: {start: 0, limit: 50}})
            },
            loadValoresIniciales: function () {
                Phx.vista.MiembroFamiliar.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_propietario.setValue(this.maestro.id_propietario);
            },
        }
    )
</script>
        
        