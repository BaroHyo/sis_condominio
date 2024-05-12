<?php
/****************************************************************************************
 * @package pXP
 * @file gen-Baulera.php
 * @author  (admin)
 * @date 12-05-2024 15:44:06
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                12-05-2024 15:44:06    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.Baulera = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.Baulera.superclass.constructor.call(this, config);
                this.init();
            },

            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_baulera'
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
                        name: 'codigo',
                        fieldLabel: 'Codigo',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 20
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'bau.codigo', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'informacion_adicional',
                        fieldLabel: 'informacion Adicional',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'bau.informacion_adicional', type: 'string'},
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
                    filters: {pfiltro: 'bau.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'bau.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'bau.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'bau.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'bau.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Baulera',
            ActSave: '../../sis_condominio/control/Baulera/insertarBaulera',
            ActDel: '../../sis_condominio/control/Baulera/eliminarBaulera',
            ActList: '../../sis_condominio/control/Baulera/listarBaulera',
            id_store: 'id_baulera',
            fields: [
                {name: 'id_baulera', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_condominio', type: 'numeric'},
                {name: 'codigo', type: 'string'},
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
                field: 'id_baulera',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            onReloadPage: function (m) {
                this.maestro = m;
                this.store.baseParams = {id_condominio: this.maestro.id_condominio};
                this.load({params: {start: 0, limit: 50}})
            },
            loadValoresIniciales: function () {
                Phx.vista.Baulera.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_condominio.setValue(this.maestro.id_condominio);
            },
        }
    )
</script>
        
        