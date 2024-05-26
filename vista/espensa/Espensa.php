<?php
/****************************************************************************************
 * @package pXP
 * @file gen-Espensa.php
 * @author  (admin)
 * @date 25-05-2024 21:15:41
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                25-05-2024 21:15:41    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.Espensa = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.idContenedor = config.idContenedor;
                this.maestro = config;
                //llama al constructor de la clase padre
                Phx.vista.Espensa.superclass.constructor.call(this, config);
                this.init();
                this.store.baseParams = {id_condominio: this.maestro.id_condominio};
                this.load({params: {start: 0, limit: this.tam_pag}})
            },

            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_espensa'
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
                        name: 'nombre',
                        fieldLabel: 'Nombre',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'esp.nombre', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'importe',
                        fieldLabel: 'Importe',
                        allowBlank: true,
                        anchor: '40%',
                        gwidth: 150,
                        renderer: function (value, p, record) {
                            Number.prototype.formatDinero = function (c, d, t) {
                                var n = this,
                                    c = isNaN(c = Math.abs(c)) ? 2 : c,
                                    d = d == undefined ? "." : d,
                                    t = t == undefined ? "," : t,
                                    s = n < 0 ? "-" : "",
                                    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                                    j = (j = i.length) > 3 ? j % 3 : 0;
                                return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
                            };
                            return String.format('<div style="vertical-align:middle;text-align:right;"><b>{0}</b></div>', (parseFloat(value)).formatDinero(2, ',', '.'));
                        }
                    },
                    type: 'NumberField',
                    filters: {pfiltro: 'esp.importe', type: 'numeric'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'id_moneda',
                        origen: 'MONEDA',
                        fieldLabel: 'Moneda',
                        anchor: '30%',
                        allowBlank: false,
                        gdisplayField: 'desc_moneda',//mapea al store del grid
                        gwidth: 200,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['desc_moneda']);
                        }
                    },
                    type: 'ComboRec',
                    id_grupo: 1,
                    grid: true,
                    form: true
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
            title: 'Espensa',
            ActSave: '../../sis_condominio/control/Espensa/insertarEspensa',
            ActDel: '../../sis_condominio/control/Espensa/eliminarEspensa',
            ActList: '../../sis_condominio/control/Espensa/listarEspensa',
            id_store: 'id_espensa',
            fields: [
                {name: 'id_espensa', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_condominio', type: 'numeric'},
                {name: 'nombre', type: 'string'},
                {name: 'importe', type: 'numeric'},
                {name: 'id_moneda', type: 'numeric'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'desc_moneda', type: 'string'},
            ],
            sortInfo: {
                field: 'id_espensa',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            fwidth: '60%',
            fheight: '25%',
            loadValoresIniciales: function () {
                Phx.vista.Espensa.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_condominio.setValue(this.maestro.id_condominio);
            },
        }
    )
</script>
        
        