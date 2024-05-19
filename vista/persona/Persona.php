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
    Phx.vista.Persona = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.Persona.superclass.constructor.call(this, config);
                this.init();
                this.iniciarEventos();
                this.load({params: {start: 0, limit: 50}})
            },
            Atributos: [
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_persona'

                    },
                    type: 'Field',
                    form: true

                },
                {
                    config: {
                        fieldLabel: "Nombre",
                        gwidth: 130,
                        name: 'nombre',
                        allowBlank: false,
                        maxLength: 150,
                        minLength: 2,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true,
                    egrid: true
                },
                {
                    config: {
                        fieldLabel: "Apellido Paterno",
                        gwidth: 130,
                        name: 'ap_paterno',
                        allowBlank: false,
                        maxLength: 150,

                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.apellido_paterno', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Apellido Materno",
                        gwidth: 130,
                        name: 'ap_materno',
                        allowBlank: true,
                        maxLength: 150,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.apellido_materno', type: 'string'},//p.apellido_paterno
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Fecha de Nacimiento",
                        gwidth: 120,
                        name: 'fecha_nacimiento',
                        allowBlank: false,
                        maxLength: 100,
                        minLength: 1,
                        format: 'd/m/Y',
                        anchor: '100%',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {type: 'date'},
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'genero',
                        fieldLabel: 'Genero',
                        allowBlank: true,
                        emptyText: 'Genero...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        store: ['masculino', 'femenino']

                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {
                        type: 'list',
                        options: ['masculino', 'femenino']
                    },
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Sobre Nombre",
                        gwidth: 130,
                        name: 'sobrenombre',
                        allowBlank: false,
                        maxLength: 50,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.sobrenombre', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Cualidad 1",
                        gwidth: 130,
                        name: 'cualidad_1',
                        allowBlank: false,
                        maxLength: 50,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.cualidad_1', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Cualidad 2",
                        gwidth: 130,
                        name: 'cualidad_2',
                        allowBlank: false,
                        maxLength: 50,

                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.cualidad_2', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Foto",
                        gwidth: 130,
                        inputType: 'file',
                        name: 'foto',
                        buttonText: '',
                        maxLength: 150,
                        anchor: '100%',
                        renderer: function (value, p, record) {
                            var momentoActual = new Date();
                            var hora = momentoActual.getHours();
                            var minuto = momentoActual.getMinutes();
                            var segundo = momentoActual.getSeconds();
                            hora_actual = hora + ":" + minuto + ":" + segundo;
                            var foto = record.data['nombre_archivo_foto'];
                            return String.format('{0}', "<div style='text-align:center'><img src = '../../control/foto_persona/ActionObtenerFoto.php?file=" + foto + "' align='center'  height='70'/></div>");
                        },
                        buttonCfg: {
                            iconCls: 'upload-icon'
                        }
                    },
                    type: 'Field',
                    sortable: false,
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        name: 'tipo_documento',
                        fieldLabel: 'Tipo Documento',
                        allowBlank: true,
                        emptyText: 'Tipo Doc...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        store: ['documento_identidad', 'pasaporte', 'Ninguno']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {
                        type: 'list',
                        options: ['documento_identidad', 'pasaporte'],
                    },
                    grid: true,
                    valorInicial: 'documento_identidad',
                    form: true
                },
                {
                    config: {
                        fieldLabel: "CI",
                        gwidth: 80,
                        name: 'ci',
                        allowBlank: true,
                        maxLength: 15,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'expedicion',
                        fieldLabel: 'Expedido En',
                        allowBlank: true,
                        emptyText: 'Expedido En...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        store: ['CB', 'LP', 'BN', 'CJ', 'PT', 'CH', 'TJ', 'SC', 'OR', 'OTRO']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {
                        type: 'list',
                        options: ['CB', 'LP', 'BN', 'CJ', 'PT', 'CH', 'TJ', 'SC', 'OR', 'OTRO'],
                    },
                    grid: true,
                    valorInicial: 'expedicion',
                    form: true
                },
                {
                    config: {
                        fieldLabel: "Telefono",
                        gwidth: 120,
                        name: 'telefono1',
                        allowBlank: true,
                        maxLength: 15,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Celular",
                        gwidth: 120,
                        name: 'celular1',
                        allowBlank: true,
                        maxLength: 15,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Correo",
                        gwidth: 150,
                        name: 'correo',
                        allowBlank: true,
                        vtype: 'email',
                        maxLength: 100,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Telefono 2",
                        gwidth: 120,
                        name: 'telefono2',
                        allowBlank: true,
                        maxLength: 15,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Celular 2",
                        gwidth: 120,
                        name: 'celular2',
                        allowBlank: true,
                        maxLength: 15,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Dirección",
                        gwidth: 130,
                        name: 'direccion',
                        allowBlank: true,
                        maxLength: 150,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'p.direccion', type: 'string'},
                    bottom_filter: true,
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Matricula",
                        gwidth: 120,
                        name: 'matricula',
                        allowBlank: true,
                        maxLength: 20,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Historia Clinica",
                        gwidth: 120,
                        name: 'historia_clinica',
                        allowBlank: true,
                        maxLength: 20,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        name: 'grupo_sanguineo',
                        fieldLabel: 'Grupo Sanguineo',
                        allowBlank: true,
                        emptyText: 'Grupo Sanguineo...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        store: ['O Rh+', 'O Rh-', 'A Rh+', 'A Rh-', 'B Rh+', 'B Rh-', 'AB Rh+', 'AB Rh-']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {
                        type: 'list',
                        options: ['O Rh+', 'O Rh-', 'A Rh+', 'A Rh-', 'B Rh+', 'B Rh-', 'AB Rh+', 'AB Rh-'],
                    },
                    grid: false,
                    form: false
                },
                {
                    config: {
                        name: 'abreviatura_titulo',
                        fieldLabel: 'Titulo (abrev)',
                        allowBlank: true,
                        emptyText: 'Abreviatura de Titulo...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        store: ['Lic.', 'Ing.', 'Msc.', 'Ph.D.', 'Tec.', 'Sr.']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {
                        type: 'list',
                        options: ['Lic.', 'Ing.', 'Msc.', 'Ph.D.', 'Tec.', 'Sr.'],
                    },
                    grid: false,
                    form: false
                },
                {
                    config: {
                        fieldLabel: "Profesion",
                        gwidth: 120,
                        name: 'profesion',
                        allowBlank: true,
                        maxLength: 50,
                        minLength: 5,
                        anchor: '100%'
                    },
                    type: 'TextField',
                    filters: {type: 'string'},
                    id_grupo: 0,
                    grid: false,
                    form: false  //#88
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
            title: 'Persona',
            ActSave: '../../sis_seguridad/control/Persona/guardarPersona',
            ActDel: '../../sis_seguridad/control/Persona/eliminarPersona',
            ActList: '../../sis_seguridad/control/Persona/listarPersonaFoto',
            id_store: 'id_persona',
            fields: [
                {name: 'id_persona'},
                {name: 'nombre', type: 'string'},
                {name: 'tipo_documento', type: 'string'},
                {name: 'expedicion', type: 'string'},
                {name: 'ap_paterno', type: 'string'},
                {name: 'ap_materno', type: 'string'},
                {name: 'ci', type: 'string'},
                {name: 'correo', type: 'string'},
                {name: 'celular1'},
                {name: 'telefono1'},
                {name: 'telefono2'},
                {name: 'celular2'},
                {name: 'direccion'},
                {name: 'foto'},
                {name: 'matricula', type: 'string'},
                {name: 'historia_clinica', type: 'string'},
                {name: 'fecha_nacimiento', type: 'date', dateFormat: 'Y-m-d'},
                {name: 'genero', type: 'string'},
                {name: 'abreviatura_titulo', type: 'string'},
                {name: 'profesion', type: 'string'},
                {name: 'grupo_sanguineo', type: 'string'},
                {name: 'nombre_archivo_foto', type: 'string'},
                {name: 'sobrenombre', type: 'string'},
                {name: 'cualidad_1', type: 'string'},
                {name: 'cualidad_2', type: 'string'}
            ],
            sortInfo: {
                field: 'id_persona',
                direction: 'ASC'
            },
            bsave: false,
            iniciarEventos() {
                this.Cmp.tipo_documento.on('select', function (combo, record, index) {
                    if (combo.getValue() == 'Ninguno') {
                        this.Cmp.ci.reset();
                        this.Cmp.ci.disable();
                        this.Cmp.expedicion.reset();
                        this.Cmp.expedicion.disable();
                        this.Cmp.ci.modificado = true;
                        this.Cmp.expedicion.modificado = true;
                    } else {
                        this.Cmp.ci.enable();
                        this.Cmp.expedicion.enable();
                        this.Cmp.ci.modificado = true;
                        this.Cmp.expedicion.modificado = true;
                    }
                }, this);
            },
            /*  onSubmit: function (o, x, force) {
                  const me = this;
                  if (me.form.getForm().isValid()) {
                      Phx.CP.loadingShow();
                      Ext.apply(me.argumentSave, o.argument);
                      Ext.Ajax.request({
                          url: '../../sis_seguridad/control/Persona/validarPersona',
                          params: {
                              'id_persona': this.Cmp.id_persona.getValue(),
                              'nombre': this.Cmp.nombre.getValue() + this.Cmp.ap_paterno.getValue() + this.Cmp.ap_materno.getValue(),
                              'tipo_documento': this.Cmp.tipo_documento.getValue(),
                              'ci': this.Cmp.ci.getValue()
                          },
                          success: me.successValidar,
                          failure: me.conexionFailure,
                          timeout: me.timeout,
                          argument: {'o': o, 'x': x, 'force': false},
                          scope: me
                      });
                  }
              },
              successValidar: function (resp) {
                  var me = this;
                  var reg = Ext.util.JSON.decode(Ext.util.Format.trim(resp.responseText));
                  if (reg.ROOT.datos.tipo_mensaje == 'exito') {
                      Phx.vista.persona.superclass.onSubmit.call(this, resp.argument.o, resp.argument.x, resp.argument.force);
                  } else if (reg.ROOT.datos.tipo_mensaje == 'error') {
                      Phx.CP.loadingHide();
                      alert(reg.ROOT.datos.mensaje_error);
                  } else {
                      Phx.CP.loadingHide();
                      Ext.Msg.show({
                          title: 'ALERTA!',
                          msg: reg.ROOT.datos.mensaje_error,
                          buttons: Ext.Msg.YESNO,
                          fn: function (btn) {
                              if (btn == 'no') {

                              } else {
                                  Phx.vista.persona.superclass.onSubmit.call(me, resp.argument.o, resp.argument.x, resp.argument.force);
                              }

                          },
                          animEl: 'elId',
                          icon: Ext.MessageBox.QUESTION
                      });
                  }
              },*/
        }
    )
</script>

