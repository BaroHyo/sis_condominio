CREATE OR REPLACE FUNCTION "ate"."ft_visita_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_visita_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tvisita'
 AUTOR:          (admin)
 FECHA:            21-05-2024 05:51:03
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                21-05-2024 05:51:03    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_visita    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_visita_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_VIS_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 05:51:03
    ***********************************/

    IF (p_transaccion='ATE_VIS_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tvisita(
            estado_reg,
            id_condominio,
            id_unidades,
            fecha,
            nombre,
            ap_paterno,
            tipo_documento,
            codigo_documento,
            ingreso,
            salida,
            informacion_adicional,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_condominio,
            v_parametros.id_unidades,
            v_parametros.fecha,
            v_parametros.nombre,
            v_parametros.ap_paterno,
            v_parametros.tipo_documento,
            v_parametros.codigo_documento,
            v_parametros.ingreso,
            v_parametros.salida,
            v_parametros.informacion_adicional,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_visita into v_id_visita;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Visita almacenado(a) con exito (id_visita'||v_id_visita||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_visita',v_id_visita::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_VIS_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 05:51:03
    ***********************************/

    ELSIF (p_transaccion='ATE_VIS_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tvisita SET
            id_condominio = v_parametros.id_condominio,
            id_unidades = v_parametros.id_unidades,
            fecha = v_parametros.fecha,
            nombre = v_parametros.nombre,
            ap_paterno = v_parametros.ap_paterno,
            tipo_documento = v_parametros.tipo_documento,
            codigo_documento = v_parametros.codigo_documento,
            ingreso = v_parametros.ingreso,
            salida = v_parametros.salida,
            informacion_adicional = v_parametros.informacion_adicional,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_visita=v_parametros.id_visita;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Visita modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_visita',v_parametros.id_visita::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_VIS_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 05:51:03
    ***********************************/

    ELSIF (p_transaccion='ATE_VIS_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tvisita
            WHERE id_visita=v_parametros.id_visita;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Visita eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_visita',v_parametros.id_visita::varchar);
              
            --Devuelve la respuesta
            RETURN v_resp;

        END;
         
    ELSE
     
        RAISE EXCEPTION 'Transaccion inexistente: %',p_transaccion;

    END IF;

EXCEPTION
                
    WHEN OTHERS THEN
        v_resp='';
        v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
        v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
        v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
        raise exception '%',v_resp;
                        
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "ate"."ft_visita_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
