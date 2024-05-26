<?php
/****************************************************************************************
 * @package pXP
 * @file gen-Invitados.php
 * @author  (admin)
 * @date 21-05-2024 04:12:21
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                21-05-2024 04:12:21    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.Invitados = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.Invitados.superclass.constructor.call(this, config);
                this.init();
            },
            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_invitados'
                    },
                    type: 'Field',
                    form: true
                },
                {
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
                        name: 'revisar',
                        fieldLabel: 'revisar',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100
                    },
                    type: 'Checkbox',
                    filters: {pfiltro: 'inv.revisar', type: 'boolean'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'nombre',
                        fieldLabel: 'Nombres',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 200
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'inv.nombre', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'ap_paterno',
                        fieldLabel: 'Apellido Paterno',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 200
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'inv.ap_paterno', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'ap_materno',
                        fieldLabel: 'Apellido Materno',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 200
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'inv.ap_materno', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'fecha_nacimiento',
                        fieldLabel: 'Fecha Nacimiento',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {pfiltro: 'inv.fecha_nacimiento', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'tipo_documento',
                        fieldLabel: 'Tipo Documento',
                        allowBlank: false,
                        emptyText: 'Tipo...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        anchor: '50%',
                        gwidth: 100,
                        store: ['Cedula', 'Pasaporte']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'inv.tipo_documento', type: 'string'},
                    valorInicial: 'Cedula',
                    form: true,
                    grid: true,
                },
                {
                    config: {
                        name: 'codigo_documento',
                        fieldLabel: 'Codigo Documento',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 50
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'inv.codigo_documento', type: 'string'},
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
                        gwidth: 200,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'inv.informacion_adicional', type: 'string'},
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
                    filters: {pfiltro: 'inv.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'inv.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'inv.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'inv.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'inv.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Invitados',
            ActSave: '../../sis_condominio/control/Invitados/insertarInvitados',
            ActDel: '../../sis_condominio/control/Invitados/eliminarInvitados',
            ActList: '../../sis_condominio/control/Invitados/listarInvitados',
            id_store: 'id_invitados',
            fields: [
                {name: 'id_invitados', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_solicitud', type: 'numeric'},
                {name: 'revisar', type: 'boolean'},
                {name: 'nombre', type: 'string'},
                {name: 'ap_paterno', type: 'string'},
                {name: 'ap_materno', type: 'string'},
                {name: 'fecha_nacimiento', type: 'date', dateFormat: 'Y-m-d'},
                {name: 'tipo_documento', type: 'string'},
                {name: 'codigo_documento', type: 'string'},
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
                field: 'id_invitados',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            onReloadPage: function (m) {
                this.maestro = m;
                this.store.baseParams = {id_solicitud: this.maestro.id_solicitud};
                this.load({params: {start: 0, limit: 50}})
            },
            loadValoresIniciales: function () {
                Phx.vista.Invitados.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_solicitud.setValue(this.maestro.id_solicitud);
            },
        }
    )
</script>
        
        