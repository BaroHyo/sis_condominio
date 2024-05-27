CREATE OR REPLACE FUNCTION "ate"."ft_enfermedades_propietario_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_enfermedades_propietario_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tenfermedades_propietario'
 AUTOR:          (admin)
 FECHA:            27-05-2024 01:53:14
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                27-05-2024 01:53:14    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_enfermedades_propietario    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_enfermedades_propietario_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_ENF_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:53:14
    ***********************************/

    IF (p_transaccion='ATE_ENF_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tenfermedades_propietario(
            estado_reg,
            id_propietario,
            nombre,
            descripcion,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_propietario,
            v_parametros.nombre,
            v_parametros.descripcion,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_enfermedades_propietario into v_id_enfermedades_propietario;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Enfermedades Propitario almacenado(a) con exito (id_enfermedades_propietario'||v_id_enfermedades_propietario||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_enfermedades_propietario',v_id_enfermedades_propietario::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_ENF_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:53:14
    ***********************************/

    ELSIF (p_transaccion='ATE_ENF_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tenfermedades_propietario SET
            id_propietario = v_parametros.id_propietario,
            nombre = v_parametros.nombre,
            descripcion = v_parametros.descripcion,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_enfermedades_propietario=v_parametros.id_enfermedades_propietario;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Enfermedades Propitario modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_enfermedades_propietario',v_parametros.id_enfermedades_propietario::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_ENF_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:53:14
    ***********************************/

    ELSIF (p_transaccion='ATE_ENF_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tenfermedades_propietario
            WHERE id_enfermedades_propietario=v_parametros.id_enfermedades_propietario;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Enfermedades Propitario eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_enfermedades_propietario',v_parametros.id_enfermedades_propietario::varchar);
              
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
ALTER FUNCTION "ate"."ft_enfermedades_propietario_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
