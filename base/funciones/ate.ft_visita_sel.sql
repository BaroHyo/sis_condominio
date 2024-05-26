CREATE OR REPLACE FUNCTION "ate"."ft_visita_sel"(    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_visita_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'ate.tvisita'
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

    v_consulta            VARCHAR;
    v_parametros          RECORD;
    v_nombre_funcion      TEXT;
    v_resp                VARCHAR;
                
BEGIN

    v_nombre_funcion = 'ate.ft_visita_sel';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_VIS_SEL'
     #DESCRIPCION:    Consulta de datos
     #AUTOR:        admin    
     #FECHA:        21-05-2024 05:51:03
    ***********************************/

    IF (p_transaccion='ATE_VIS_SEL') THEN
                     
        BEGIN
            --Sentencia de la consulta
            v_consulta:='SELECT
                        vis.id_visita,
                        vis.estado_reg,
                        vis.id_condominio,
                        vis.id_unidades,
                        vis.fecha,
                        vis.nombre,
                        vis.ap_paterno,
                        vis.tipo_documento,
                        vis.codigo_documento,
                        vis.ingreso,
                        vis.salida,
                        vis.informacion_adicional,
                        vis.id_usuario_reg,
                        vis.fecha_reg,
                        vis.id_usuario_ai,
                        vis.usuario_ai,
                        vis.id_usuario_mod,
                        vis.fecha_mod,
                        usu1.cuenta as usr_reg,
                        usu2.cuenta as usr_mod    
                        FROM ate.tvisita vis
                        JOIN segu.tusuario usu1 ON usu1.id_usuario = vis.id_usuario_reg
                        LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = vis.id_usuario_mod
                        WHERE  ';
            
            --Definicion de la respuesta
            v_consulta:=v_consulta||v_parametros.filtro;
            v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

            --Devuelve la respuesta
            RETURN v_consulta;
                        
        END;

    /*********************************    
     #TRANSACCION:  'ATE_VIS_CONT'
     #DESCRIPCION:    Conteo de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 05:51:03
    ***********************************/

    ELSIF (p_transaccion='ATE_VIS_CONT') THEN

        BEGIN
            --Sentencia de la consulta de conteo de registros
            v_consulta:='SELECT COUNT(id_visita)
                         FROM ate.tvisita vis
                         JOIN segu.tusuario usu1 ON usu1.id_usuario = vis.id_usuario_reg
                         LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = vis.id_usuario_mod
                         WHERE ';
            
            --Definicion de la respuesta            
            v_consulta:=v_consulta||v_parametros.filtro;

            --Devuelve la respuesta
            RETURN v_consulta;

        END;
                    
    ELSE
                         
        RAISE EXCEPTION 'Transaccion inexistente';
                             
    END IF;
                    
EXCEPTION
                    
    WHEN OTHERS THEN
            v_resp='';
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
            v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
            v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
            RAISE EXCEPTION '%',v_resp;
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "ate"."ft_visita_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
