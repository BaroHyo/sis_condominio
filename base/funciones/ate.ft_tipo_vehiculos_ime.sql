CREATE OR REPLACE FUNCTION "ate"."ft_tipo_vehiculos_ime"(
    p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
    RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_tipo_vehiculos_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.ttipo_vehiculos'
 AUTOR:          (admin)
 FECHA:            27-05-2024 02:00:44
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                27-05-2024 02:00:44    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento INTEGER;
    v_parametros        RECORD;
    v_id_requerimiento  INTEGER;
    v_resp              VARCHAR;
    v_nombre_funcion    TEXT;
    v_mensaje_error     TEXT;
    v_id_tipo_vehiculos INTEGER;

BEGIN

    v_nombre_funcion = 'ate.ft_tipo_vehiculos_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_TPV_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 02:00:44
    ***********************************/

    IF (p_transaccion = 'ATE_TPV_INS') THEN

        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.ttipo_vehiculos(estado_reg,
                                            tipo,
                                            id_usuario_reg,
                                            fecha_reg,
                                            id_usuario_ai,
                                            usuario_ai,
                                            id_usuario_mod,
                                            fecha_mod)
            VALUES ('activo',
                    v_parametros.tipo,
                    p_id_usuario,
                    now(),
                    v_parametros._id_usuario_ai,
                    v_parametros._nombre_usuario_ai,
                    null,
                    null)
            RETURNING id_tipo_vehiculos into v_id_tipo_vehiculos;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp, 'mensaje',
                                        'Tipo Vehículos almacenado(a) con exito (id_tipo_vehiculos' ||
                                        v_id_tipo_vehiculos || ')');
            v_resp = pxp.f_agrega_clave(v_resp, 'id_tipo_vehiculos', v_id_tipo_vehiculos::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

        /*********************************
         #TRANSACCION:  'ATE_TPV_MOD'
         #DESCRIPCION:    Modificacion de registros
         #AUTOR:        admin
         #FECHA:        27-05-2024 02:00:44
        ***********************************/

    ELSIF (p_transaccion = 'ATE_TPV_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.ttipo_vehiculos
            SET tipo           = v_parametros.tipo,
                id_usuario_mod = p_id_usuario,
                fecha_mod      = now(),
                id_usuario_ai  = v_parametros._id_usuario_ai,
                usuario_ai     = v_parametros._nombre_usuario_ai
            WHERE id_tipo_vehiculos = v_parametros.id_tipo_vehiculos;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp, 'mensaje', 'Tipo Vehículos modificado(a)');
            v_resp = pxp.f_agrega_clave(v_resp, 'id_tipo_vehiculos', v_parametros.id_tipo_vehiculos::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

        /*********************************
         #TRANSACCION:  'ATE_TPV_ELI'
         #DESCRIPCION:    Eliminacion de registros
         #AUTOR:        admin
         #FECHA:        27-05-2024 02:00:44
        ***********************************/

    ELSIF (p_transaccion = 'ATE_TPV_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE
            FROM ate.ttipo_vehiculos
            WHERE id_tipo_vehiculos = v_parametros.id_tipo_vehiculos;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp, 'mensaje', 'Tipo Vehículos eliminado(a)');
            v_resp = pxp.f_agrega_clave(v_resp, 'id_tipo_vehiculos', v_parametros.id_tipo_vehiculos::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    ELSE

        RAISE EXCEPTION 'Transaccion inexistente: %',p_transaccion;

    END IF;

EXCEPTION

    WHEN OTHERS THEN
        v_resp = '';
        v_resp = pxp.f_agrega_clave(v_resp, 'mensaje', SQLERRM);
        v_resp = pxp.f_agrega_clave(v_resp, 'codigo_error', SQLSTATE);
        v_resp = pxp.f_agrega_clave(v_resp, 'procedimientos', v_nombre_funcion);
        raise exception '%',v_resp;

END;
$BODY$
    LANGUAGE 'plpgsql' VOLATILE
                       COST 100;
ALTER FUNCTION "ate"."ft_tipo_vehiculos_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
