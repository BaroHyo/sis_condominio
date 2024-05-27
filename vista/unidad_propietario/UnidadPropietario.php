<?php
/****************************************************************************************
 * @package pXP
 * @file gen-UnidadPropietario.php
 * @author  (admin)
 * @date 15-05-2024 20:44:41
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 20:44:41    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.UnidadPropietario = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.UnidadPropietario.superclass.constructor.call(this, config);
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
                        name: 'id_unidad_propietario'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_unidades'
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
                        name: 'desc_piso',
                        fieldLabel: 'Piso',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 10
                    },
                    type: 'TextField',
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'id_unidades',
                        fieldLabel: 'Unidad',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Unidades/listarUnidades',
                            id: 'id_unidades',
                            root: 'datos',
                            sortInfo: {
                                field: 'numero_unidad',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_unidades', 'numero_unidad', 'descripcion', 'desc_bloque', 'desc_piso'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'uni.numero_unidad', es_propietario: 'si'}
                        }),
                        valueField: 'id_unidades',
                        displayField: 'numero_unidad',
                        gdisplayField: 'numero_unidad',
                        tpl: '<tpl for="."><div class="x-combo-list-item"><p><b>{desc_piso}:</b> Unidad (<b style="color: darkblue">{numero_unidad}</b>) </p><p>{desc_bloque}</p> </div></tpl>',
                        hiddenName: 'id_unidades',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '100%',
                        gwidth: 100,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['numero_unidad']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'uni.numero_unidad', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'desc_espensa',
                        fieldLabel: 'Tipo Unidad',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'esp.nombre', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'importe',
                        fieldLabel: 'Importe Espensa',
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
                    form: false
                },
                {
                    config: {
                        name: 'desc_moneda',
                        fieldLabel: 'Moneda',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'mon.moneda', type: 'string'},
                    id_grupo: 1,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        name: 'informacion_adicional',
                        fieldLabel: 'Informacion Adicional',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 300,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'uni.informacion_adicional', type: 'string'},
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
                    filters: {pfiltro: 'unp.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'unp.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'unp.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'unp.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'unp.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Unidad Propietario',
            ActSave: '../../sis_condominio/control/UnidadPropietario/insertarUnidadPropietario',
            ActDel: '../../sis_condominio/control/UnidadPropietario/eliminarUnidadPropietario',
            ActList: '../../sis_condominio/control/UnidadPropietario/listarUnidadPropietario',
            id_store: 'id_unidad_propietario',
            fields: [
                {name: 'id_unidad_propietario', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_propietario', type: 'numeric'},
                {name: 'id_unidades', type: 'numeric'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'numero_unidad', type: 'string'},
                {name: 'descripcion', type: 'string'},
                {name: 'tipo_unidad', type: 'string'},
                {name: 'informacion_adicional', type: 'string'},
                {name: 'desc_piso', type: 'string'},
                {name: 'desc_espensa', type: 'string'},
                {name: 'importe', type: 'string'},
                {name: 'desc_moneda', type: 'string'},
            ],
            sortInfo: {
                field: 'id_unidad_propietario',
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
                Phx.vista.UnidadPropietario.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_propietario.setValue(this.maestro.id_propietario);
            },
            iniciarEvento: function () {
                this.Cmp.id_unidades.store.baseParams = Ext.apply(this.Cmp.id_unidades.store.baseParams, {id_condominio: this.maestro.id_condominio});
                this.Cmp.id_unidades.modificado = true;
            }
        }
    )
</script>
        
        