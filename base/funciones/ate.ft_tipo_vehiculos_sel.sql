CREATE OR REPLACE FUNCTION "ate"."ft_tipo_vehiculos_sel"(
    p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
    RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_tipo_vehiculos_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'ate.ttipo_vehiculos'
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

    v_consulta       VARCHAR;
    v_parametros     RECORD;
    v_nombre_funcion TEXT;
    v_resp           VARCHAR;

BEGIN

    v_nombre_funcion = 'ate.ft_tipo_vehiculos_sel';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_TPV_SEL'
     #DESCRIPCION:    Consulta de datos
     #AUTOR:        admin    
     #FECHA:        27-05-2024 02:00:44
    ***********************************/

    IF (p_transaccion = 'ATE_TPV_SEL') THEN

        BEGIN
            --Sentencia de la consulta
            v_consulta := 'SELECT
                        tpv.id_tipo_vehiculos,
                        tpv.estado_reg,
                        tpv.tipo,
                        tpv.id_usuario_reg,
                        tpv.fecha_reg,
                        tpv.id_usuario_ai,
                        tpv.usuario_ai,
                        tpv.id_usuario_mod,
                        tpv.fecha_mod,
                        usu1.cuenta as usr_reg,
                        usu2.cuenta as usr_mod    
                        FROM ate.ttipo_vehiculos tpv
                        JOIN segu.tusuario usu1 ON usu1.id_usuario = tpv.id_usuario_reg
                        LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = tpv.id_usuario_mod
                        WHERE  ';

            --Definicion de la respuesta
            v_consulta := v_consulta || v_parametros.filtro;
            v_consulta := v_consulta || ' order by ' || v_parametros.ordenacion || ' ' || v_parametros.dir_ordenacion ||
                          ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

            --Devuelve la respuesta
            RETURN v_consulta;

        END;

        /*********************************
         #TRANSACCION:  'ATE_TPV_CONT'
         #DESCRIPCION:    Conteo de registros
         #AUTOR:        admin
         #FECHA:        27-05-2024 02:00:44
        ***********************************/

    ELSIF (p_transaccion = 'ATE_TPV_CONT') THEN

        BEGIN
            --Sentencia de la consulta de conteo de registros
            v_consulta := 'SELECT COUNT(id_tipo_vehiculos)
                         FROM ate.ttipo_vehiculos tpv
                         JOIN segu.tusuario usu1 ON usu1.id_usuario = tpv.id_usuario_reg
                         LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = tpv.id_usuario_mod
                         WHERE ';

            --Definicion de la respuesta            
            v_consulta := v_consulta || v_parametros.filtro;

            --Devuelve la respuesta
            RETURN v_consulta;

        END;

    ELSE

        RAISE EXCEPTION 'Transaccion inexistente';

    END IF;

EXCEPTION

    WHEN OTHERS THEN
        v_resp = '';
        v_resp = pxp.f_agrega_clave(v_resp, 'mensaje', SQLERRM);
        v_resp = pxp.f_agrega_clave(v_resp, 'codigo_error', SQLSTATE);
        v_resp = pxp.f_agrega_clave(v_resp, 'procedimientos', v_nombre_funcion);
        RAISE EXCEPTION '%',v_resp;
END;
$BODY$
    LANGUAGE 'plpgsql' VOLATILE
                       COST 100;
ALTER FUNCTION "ate"."ft_tipo_vehiculos_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
