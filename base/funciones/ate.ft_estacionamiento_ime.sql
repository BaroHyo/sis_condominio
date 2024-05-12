CREATE OR REPLACE FUNCTION "ate"."ft_estacionamiento_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_estacionamiento_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.testacionamiento'
 AUTOR:          (admin)
 FECHA:            12-05-2024 14:10:39
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                12-05-2024 14:10:39    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_estacionamiento    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_estacionamiento_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_EST_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 14:10:39
    ***********************************/

    IF (p_transaccion='ATE_EST_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.testacionamiento(
            estado_reg,
            id_condominio,
            numero_espacio,
            tipo_espacion,
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
            v_parametros.numero_espacio,
            v_parametros.tipo_espacion,
            v_parametros.informacion_adicional,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_estacionamiento into v_id_estacionamiento;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Estacionamiento almacenado(a) con exito (id_estacionamiento'||v_id_estacionamiento||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_estacionamiento',v_id_estacionamiento::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_EST_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 14:10:39
    ***********************************/

    ELSIF (p_transaccion='ATE_EST_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.testacionamiento SET
            id_condominio = v_parametros.id_condominio,
            numero_espacio = v_parametros.numero_espacio,
            tipo_espacion = v_parametros.tipo_espacion,
            informacion_adicional = v_parametros.informacion_adicional,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_estacionamiento=v_parametros.id_estacionamiento;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Estacionamiento modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_estacionamiento',v_parametros.id_estacionamiento::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_EST_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 14:10:39
    ***********************************/

    ELSIF (p_transaccion='ATE_EST_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.testacionamiento
            WHERE id_estacionamiento=v_parametros.id_estacionamiento;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Estacionamiento eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_estacionamiento',v_parametros.id_estacionamiento::varchar);
              
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
ALTER FUNCTION "ate"."ft_estacionamiento_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
