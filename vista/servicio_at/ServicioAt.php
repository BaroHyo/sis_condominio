<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ServicioAt.php
 * @author  (admin)
 * @date 16-05-2024 13:12:18
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                16-05-2024 13:12:18    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.ServicioAt = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.ServicioAt.superclass.constructor.call(this, config);
                this.init();
                this.load({params: {start: 0, limit: this.tam_pag}})
            },

            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_servicio_at'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        name: 'codigo',
                        fieldLabel: 'Codigo',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'ser.codigo', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'nombre',
                        fieldLabel: 'Nombre',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'ser.nombre', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'tipo',
                        fieldLabel: 'Tipo',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 50
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'ser.tipo', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'contacto',
                        fieldLabel: 'Contacto',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 50
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'ser.contacto', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'nit',
                        fieldLabel: 'Nit',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'ser.nit', type: 'string'},
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
                    filters: {pfiltro: 'ser.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'ser.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'ser.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'ser.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'ser.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Servicio',
            ActSave: '../../sis_condominio/control/ServicioAt/insertarServicioAt',
            ActDel: '../../sis_condominio/control/ServicioAt/eliminarServicioAt',
            ActList: '../../sis_condominio/control/ServicioAt/listarServicioAt',
            id_store: 'id_servicio_at',
            fields: [
                {name: 'id_servicio_at', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'codigo', type: 'string'},
                {name: 'nombre', type: 'string'},
                {name: 'tipo', type: 'string'},
                {name: 'contacto', type: 'string'},
                {name: 'nit', type: 'string'},
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
                field: 'id_servicio_at',
                direction: 'ASC'
            },
            bdel: true,
            bsave: true
        }
    )
</script>
        
        