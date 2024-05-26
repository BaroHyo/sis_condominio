CREATE OR REPLACE FUNCTION "ate"."ft_espensa_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_espensa_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tespensa'
 AUTOR:          (admin)
 FECHA:            25-05-2024 21:15:41
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                25-05-2024 21:15:41    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_espensa    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_espensa_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_ESP_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        25-05-2024 21:15:41
    ***********************************/

    IF (p_transaccion='ATE_ESP_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tespensa(
            estado_reg,
            id_condominio,
            nombre,
            importe,
            id_moneda,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_condominio,
            v_parametros.nombre,
            v_parametros.importe,
            v_parametros.id_moneda,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_espensa into v_id_espensa;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Espensa almacenado(a) con exito (id_espensa'||v_id_espensa||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_espensa',v_id_espensa::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_ESP_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        25-05-2024 21:15:41
    ***********************************/

    ELSIF (p_transaccion='ATE_ESP_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tespensa SET
            id_condominio = v_parametros.id_condominio,
            nombre = v_parametros.nombre,
            importe = v_parametros.importe,
            id_moneda = v_parametros.id_moneda,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_espensa=v_parametros.id_espensa;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Espensa modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_espensa',v_parametros.id_espensa::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_ESP_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        25-05-2024 21:15:41
    ***********************************/

    ELSIF (p_transaccion='ATE_ESP_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tespensa
            WHERE id_espensa=v_parametros.id_espensa;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Espensa eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_espensa',v_parametros.id_espensa::varchar);
              
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
ALTER FUNCTION "ate"."ft_espensa_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
