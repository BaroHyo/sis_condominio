create or replace function ate.ft_condominio_sel(p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying) returns character varying
    language plpgsql
as
$$
/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_condominio_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'ate.tcondominio'
 AUTOR:          (admin)
 FECHA:            12-05-2024 03:10:00
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                12-05-2024 03:10:00    admin             Creacion
 #
 ***************************************************************************/

DECLARE

    v_consulta       VARCHAR;
    v_parametros     RECORD;
    v_nombre_funcion TEXT;
    v_resp           VARCHAR;

BEGIN

    v_nombre_funcion = 'ate.ft_condominio_sel';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************
     #TRANSACCION:  'ATE_CON_SEL'
     #DESCRIPCION:    Consulta de datos
     #AUTOR:        admin
     #FECHA:        12-05-2024 03:10:00
    ***********************************/

    IF (p_transaccion = 'ATE_CON_SEL') THEN

        BEGIN
            --Sentencia de la consulta
            v_consulta := 'SELECT con.id_condominio,
                                con.estado_reg,
                                con.id_lugar,
                                con.codigo,
                                con.nombre,
                                con.direccion,
                                con.informacion_adicional,
                                con.id_usuario_reg,
                                con.fecha_reg,
                                con.id_usuario_ai,
                                con.usuario_ai,
                                con.id_usuario_mod,
                                con.fecha_mod,
                                usu1.cuenta as usr_reg,
                                usu2.cuenta as usr_mod,
                                lug.nombre  as desc_lugar
                                FROM ate.tcondominio con
                                JOIN segu.tusuario usu1 ON usu1.id_usuario = con.id_usuario_reg
                                JOIN param.tlugar lug on lug.id_lugar = con.id_lugar
                                LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = con.id_usuario_mod
                        WHERE  ';

            --Definicion de la respuesta
            v_consulta := v_consulta || v_parametros.filtro;
            v_consulta := v_consulta || ' order by ' || v_parametros.ordenacion || ' ' || v_parametros.dir_ordenacion ||
                          ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

            --Devuelve la respuesta
            RETURN v_consulta;

        END;

        /*********************************
         #TRANSACCION:  'ATE_CON_CONT'
         #DESCRIPCION:    Conteo de registros
         #AUTOR:        admin
         #FECHA:        12-05-2024 03:10:00
        ***********************************/

    ELSIF (p_transaccion = 'ATE_CON_CONT') THEN

        BEGIN
            --Sentencia de la consulta de conteo de registros
            v_consulta := 'SELECT COUNT(id_condominio)
                         FROM ate.tcondominio con
                         JOIN segu.tusuario usu1 ON usu1.id_usuario = con.id_usuario_reg
                         JOIN param.tlugar lug on lug.id_lugar = con.id_lugar
                         LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = con.id_usuario_mod
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
$$;
