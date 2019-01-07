-- Table: public.cad_pessoa

-- DROP TABLE public.cad_pessoa;

CREATE TABLE public.cad_pessoa
(
  pes_codigo serial,
  cli_codigo integer NOT NULL,
  pes_nome character varying(150) NOT NULL,
  pes_cpf character varying(20),
  pes_rg character varying(20),
  pes_sexo smallint NOT NULL DEFAULT 1, -- 1 - Homem 2 Mulher
  pes_nascimento character varying(10),
  pes_telefone character varying(15),
  pes_whats character varying(15),
  pes_email character varying(150),
  cid_codigo integer,
  est_codigo integer,
  bai_codigo integer,
  pes_status smallint NOT NULL DEFAULT 1, -- 1 off 2 on
  pes_atualizacao character varying(20),
  pes_criacao character varying(20),
  pes_ip character varying(20),
  pes_autodata timestamp without time zone NOT NULL DEFAULT now(),
  CONSTRAINT cad_pessoa_pkey PRIMARY KEY (pes_codigo),
  CONSTRAINT cad_pessoa_cli_codigo_fkey FOREIGN KEY (cli_codigo)
      REFERENCES public.cliente (cli_codigo) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.cad_pessoa
  OWNER TO api;
COMMENT ON COLUMN public.cad_pessoa.pes_sexo IS '1 - Homem 2 Mulher';
COMMENT ON COLUMN public.cad_pessoa.pes_status IS '1 off 2 on';