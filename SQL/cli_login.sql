-- Table: public.cli_login

-- DROP TABLE public.cli_login;

CREATE TABLE public.cli_login
(
  log_codigo serial,
  log_id character varying(100),
  log_senha character varying(100),
  log_status smallint, -- 1 Off...
  cli_codigo integer,
  log_atualizacao character varying(30),
  log_autodata timestamp without time zone NOT NULL DEFAULT now(),
  CONSTRAINT cli_login_pkey PRIMARY KEY (log_codigo),
  CONSTRAINT cli_login_cli_codigo_fkey FOREIGN KEY (cli_codigo)
      REFERENCES public.cliente (cli_codigo) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.cli_login
  OWNER TO api;
COMMENT ON COLUMN public.cli_login.log_status IS '1 Off
2 On';