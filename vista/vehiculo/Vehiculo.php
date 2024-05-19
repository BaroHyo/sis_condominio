<?php
/****************************************************************************************
 * @package pXP
 * @file gen-Vehiculo.php
 * @author  (admin)
 * @date 14-05-2024 15:37:08
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                14-05-2024 15:37:08    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.Vehiculo = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.Vehiculo.superclass.constructor.call(this, config);
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
                        name: 'tipo',
                        fieldLabel: 'Tipo',
                        allowBlank: false,
                        emptyText: 'Tipo...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        anchor: '80%',
                        gwidth: 100,
                        store: ['Moto', 'Auto']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'veh.tipo', type: 'string'},
                    valorInicial: 'Auto',
                    form: true,
                    grid: true,
                },
                {
                    config: {
                        name: 'marca',
                        fieldLabel: 'Marca',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 150,
                        maxLength: 50
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'veh.marca', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'modelo',
                        fieldLabel: 'Modelo',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 150,
                        maxLength: 50
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'veh.modelo', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'color',
                        fieldLabel: 'Color',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 20
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'veh.color', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'placa',
                        fieldLabel: 'Placa',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 150,
                        maxLength: 20
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'veh.placa', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'informacion_adicional',
                        fieldLabel: 'informacion_adicional',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'veh.informacion_adicional', type: 'string'},
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
                    filters: {pfiltro: 'veh.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'veh.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'veh.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'veh.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'veh.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Vehiculo',
            ActSave: '../../sis_condominio/control/Vehiculo/insertarVehiculo',
            ActDel: '../../sis_condominio/control/Vehiculo/eliminarVehiculo',
            ActList: '../../sis_condominio/control/Vehiculo/listarVehiculo',
            id_store: 'id_vehiculo',
            fields: [
                {name: 'id_vehiculo', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_propietario', type: 'numeric'},
                {name: 'tipo', type: 'string'},
                {name: 'marca', type: 'string'},
                {name: 'modelo', type: 'string'},
                {name: 'color', type: 'string'},
                {name: 'placa', type: 'string'},
                {name: 'informacion_adicional', type: 'string'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},

            ],
            sortInfo: {
                field: 'id_vehiculo',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            onReloadPage: function (m) {
                this.maestro = m;
                this.store.baseParams = {id_propietario: this.maestro.id_propietario};
                this.load({params: {start: 0, limit: 50}})
            },
            loadValoresIniciales: function () {
                Phx.vista.Vehiculo.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_propietario.setValue(this.maestro.id_propietario);
            },
        }
    )
</script>
        
        