CREATE OR REPLACE FUNCTION "ate"."ft_tipo_relacion_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_tipo_relacion_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.ttipo_relacion'
 AUTOR:          (admin)
 FECHA:            14-05-2024 15:36:59
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                14-05-2024 15:36:59    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_tipo_relacion    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_tipo_relacion_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_TIP_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:36:59
    ***********************************/

    IF (p_transaccion='ATE_TIP_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.ttipo_relacion(
            estado_reg,
            tipo,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.tipo,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_tipo_relacion into v_id_tipo_relacion;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Relacion almacenado(a) con exito (id_tipo_relacion'||v_id_tipo_relacion||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_relacion',v_id_tipo_relacion::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_TIP_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:36:59
    ***********************************/

    ELSIF (p_transaccion='ATE_TIP_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.ttipo_relacion SET
            tipo = v_parametros.tipo,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_tipo_relacion=v_parametros.id_tipo_relacion;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Relacion modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_relacion',v_parametros.id_tipo_relacion::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_TIP_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:36:59
    ***********************************/

    ELSIF (p_transaccion='ATE_TIP_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.ttipo_relacion
            WHERE id_tipo_relacion=v_parametros.id_tipo_relacion;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Tipo Relacion eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_relacion',v_parametros.id_tipo_relacion::varchar);
              
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
ALTER FUNCTION "ate"."ft_tipo_relacion_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
